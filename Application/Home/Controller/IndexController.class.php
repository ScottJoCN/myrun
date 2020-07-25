<?php
namespace Home\Controller;
use Home\Controller\BaseController;
class IndexController extends BaseController {
    public function index(){
        //系统参数
        $sys = M('sys');
        $find = $sys->where('id=1')->find();
        $find['aboutus'] = htmlspecialchars_decode($find['aboutus']);
        $this->assign('sys',$find);
        $this->display();

    }
    public function exp(){
        $project = M('proj');
        $projD = $project->where("is_show=1")->order('sort desc,id desc')->select();
        $this->assign('projD',$projD);
        $this->display();
    }
    public function product(){

        $this->display();
    }
    public function kf(){
        $this->display();
    }
    public function about(){
        $this->display();
    }
    public function contact(){
        $this->display();
    }
    public function booking(){
        $booking = M('msgboard');
        if(IS_POST){
            $data['myname'] = I('post.myname');
            $data['mytel'] = I('post.mytel');
            $data['myemail'] = I('post.myemail');
            $data['adtime']=time();
            $insert = $booking->add($data);
            if($insert){
                echo "2";
            }else{
                echo "1";
            }
        }
    }

}