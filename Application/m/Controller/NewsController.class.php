<?php
namespace m\Controller;
use m\Controller\BaseController;
class NewsController extends BaseController {
    public function index(){
        
        $this->display();
    }
    public function detail(){
        $id = I('get.id');
        $article = M('article');
        $a = $article->where("aid = $id")->find();
        $a['contents'] = htmlspecialchars_decode($a['contents']);
        // 更新浏览量
        $this->skimno($id);
        $this->assign('news',$a);
        $this->display();
    }
    // 更新浏览量
    public function skimno($aid){
        $article = M('article');
        $a = $article->where("aid = $aid")->setInc("skimno",1);
        $supnum = $article->where("aid = $aid")->getField('skimno');

    }
    public function getArtList(){
        $cur_page = I('get.cur_page');
        $count = I('get.count');
        
        $artM = M('article');
        $sys = M('sys');
        $find = $sys->where('id=1')->find();
        
        $artD = $artM->page("$cur_page,$count")->order('is_top desc,sort desc,aid desc')->select();
        
        foreach ($artD as $key => $v) {
            $artD[$key]['time'] = date('Y-m-d',$v['time']);
            if($v['pic'] == ''){
                $artD[$key]['pic'] = $find['art_pic'];
            }else{
                $artD[$key]['pic'] = $v['pic'];
            }
            
        }
        echo json_encode($artD);        
    }    

    
}