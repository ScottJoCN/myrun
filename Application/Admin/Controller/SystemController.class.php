<?php
namespace Admin\Controller;
use Admin\Controller\BaseController;
class SystemController extends BaseController {
    public function _initialize(){
        $this->islogin();
        if($_SESSION['group'] != 1){
            $this->redirect('index/index');
        }
        $this->assign('auth',$_SESSION['auth']);
        $this->gget();
        $this->sys = M('sys');
        $this->find = $this->sys->where('id=1')->find();
        $this->assign('sys',$this->find);
        
    }
    public function index(){
        $msg = I('get.msg');
        $sys = M('sys');
        $find = $sys->where('id=1')->find();
        $this->assign('sys',$find);
        $this->assign('msg',$msg);
        $this->display();
    }
    public function insert(){
        $sys = M('sys');
        $data = $sys->create();
        
        // 上传图片
        $upload = new \Think\Upload();//文件实例化上传
        $upload->maxSize = 3145728;
        $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型    
        $upload->savePath  =      '/pic/'; // 设置附件上传目录 相对于/Uploads
        $info   =   $upload->upload();
        // if(!$info) {
        //     // 上传错误提示错误信息        
        //     $this->error($upload->getError());   
        // }
        if($info['weblogo'] !=''){
            $data['weblogo'] = '/Uploads'.$info["weblogo"]["savepath"].$info["weblogo"]["savename"];
        }
        if($info['lp_pic'] !=''){
            $data['lp_pic'] = '/Uploads'.$info["lp_pic"]["savepath"].$info["lp_pic"]["savename"];
        }
        if($info['art_pic'] !=''){
            $data['art_pic'] = '/Uploads'.$info["art_pic"]["savepath"].$info["art_pic"]["savename"];
        }

        

        $find = $sys->where('id=1')->find();
        if($find){
            $insert = $sys->where('id=1')->save($data);
        }else{
            $insert = $sys->add($data);
        }
        
        if($insert){
            $this->redirect('System/index',array('list'=>6,'cla'=>1,'msg'=>1));
        }else{
            $this->redirect('System/index',array('list'=>6,'cla'=>1,'msg'=>2));
        }
    }
}