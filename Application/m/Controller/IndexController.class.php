<?php
namespace m\Controller;
use m\Controller\BaseController;
class IndexController extends BaseController {
    public function index(){
        //系统参数
        $sys = M('sys');
        $find = $sys->where('id=1')->find();
        $find['aboutus'] = htmlspecialchars_decode($find['aboutus']);
        $this->assign('sys',$find);
        // 头图
        $top_pic_where['type'] = 1;
        $top_pic = $this->get_pic_list($top_pic_where);

        // 中间介绍
        $intro_pic_where['type'] = 2;
        $intro_pic = $this->get_pic_list($intro_pic_where,'',1);

        // 行业都使用
        $industry = $this->pic_class();
        // 他们都用
        $they_use_where['type'] = 4;
        $they_use = $this->they_use($they_use_where);
        // var_dump($they_use);
        // exit();
        
        $this->assign('top_pic',$top_pic);
        $this->assign('intro',$intro_pic);
        $this->assign('industry',$industry);
        $this->assign('they_use',$they_use);
        $this->display();

    }
    public function exp(){
        $project = M('proj');
        $projD = $project->where("is_show=1")->order('sort desc,id desc')->select();
        $this->assign('projD',$projD);
        $this->display();
    }
    public function product(){
        // 头图
        $top_pic_where['type'] = 5;
        $top_pic = $this->get_pic_one($top_pic_where);
        
        // 产品介绍
        $introduct_where['type'] = 6;
        $introduct_pic = $this->get_pic_list($introduct_where,'',1);
        
        // 服务优势
        $service_where['type'] = 7;
        $service_pic = $this->get_pic_list($service_where,'',1);

        // 适用行业
        $company_where['type'] = 8;
        $company_pic = $this->get_pic_list($company_where,'',1);
        
        $this->assign('top_pic',$top_pic);
        $this->assign('introduct_pic',$introduct_pic);
        $this->assign('service_pic',$service_pic);
        $this->assign('company_pic',$company_pic);
        $this->display();
    }
    public function kf(){
        // 头图
        $top_pic_where['type'] = 9;
        $top_pic = $this->get_pic_one($top_pic_where);

        // 开发介绍
        $kf_where['type'] = 10;
        $kf_data = $this->get_pic_list($kf_where,'',1);

        // 服务流程
        $service_where['type'] = 11;
        $service_data = $this->get_pic_list($service_where,'',1);

        // 客户案例
        $case_where['type'] = 12;
        $case_data = $this->get_pic_list($case_where,10,1);

        $this->assign('top_pic',$top_pic);
        $this->assign('kf_data',$kf_data);
        $this->assign('service_data',$service_data);
        $this->assign('case_data',$case_data);

        $this->display();
    }
    public function about(){
        // 头图
        $top_pic_where['type'] = 13;
        $top_pic = $this->get_pic_one($top_pic_where);

        // 介绍
        $service_where['type'] = 14;
        $service_data = $this->get_pic_list($service_where,'',1);

        $this->assign('top_pic',$top_pic);
        $this->assign('service_data',$service_data);
        

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
    public function get_pic_list($where,$limit,$order){
        $pic = M('pic');
        if($limit){
            if($order){
                $p_data = $pic->where($where)->limit($limit)->select();
            }else{
                $p_data = $pic->where($where)->limit($limit)->order("id desc")->select();
            }
        }else{
            if($order){
                $p_data = $pic->where($where)->select();
            }else{
                $p_data = $pic->where($where)->order("id desc")->select();
            }
        }
        foreach ($p_data as $k => $v) {
            $p_data[$k]['pic_content'] = htmlspecialchars_decode($v['pic_content']);
        }
        return $p_data;
    }
    public function get_pic_one($where){
        $pic = M('pic');
        $p_data = $pic->where($where)->find();
        return $p_data;
    }
    public function pic_class(){
        $where['type'] = 3;
        $intro_pic = $this->get_pic_list($where,'',1);
        $count = count($intro_pic);

        $last = $count / 3;
        $line = floor($last);
        $mod = $count % 3;


        $line_data_temp = array();
        $line_data = array_slice($intro_pic,0,$count - $mod);
        for($i=0;$i<$line;$i++){
            $line_data_temp[] = array_slice($line_data, $i*3 ,3);
        }
        $mod_data = array();
        if($mod){
            $mod_data = array_slice($intro_pic,$count - $mod,$mod);
        }
        $return_data['line_data'] = $line_data_temp;
        $return_data['mod_data'] = $mod_data;

        return $return_data;

    }
    public function they_use($where,$num = 2){
        $intro_pic = $this->get_pic_list($where,'',1);

        $line_data_temp = array();
        for($i=0;$i<ceil(count($intro_pic));$i++){
            $line_data_temp[] = array_slice($intro_pic, $i* $num ,$num);
        }
        $line_data_temp=array_filter($line_data_temp);
        return $line_data_temp;

    }

}