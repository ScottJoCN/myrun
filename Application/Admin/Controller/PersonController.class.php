<?php
namespace Admin\Controller;
use Admin\Controller\BaseController;
class PersonController extends BaseController {
    public function _initialize(){
        $this->islogin();
        $this->adminM = M('admin');
        $this->getsys();
        $this->gget();
    }
    public function index(){
    	$id = $_SESSION['df_system_id'];
    	$user = $this->adminM->where("id = $id")->find();
    	
    	$this->assign('user',$user);
    	$this->display();
    }
    public function psw(){
    	if(IS_POST){

    	}else{
    		$this->display();
    	}
    }
    public function regname(){
    	$id = I('post.id');
    	$uname = I('post.uname');
    	$find = $this->adminM->where("id = $id and username= '".$uname."'")->find();
    	if($find){
    		echo 1;
    	}else{
    		echo 0;
    	}
    }
    public function confirm(){
        $uid = $_SESSION["df_system_id"];
    	$old_psw = md5(I('post.old_psw'));
    	$psw = $this->adminM->field('userpsw')->where("id=$uid")->find();

    	if($old_psw == $psw['userpsw']){
        	$this->redirect('Person/next');
        }else{
        	$this->msg('输入有误，请重新输入',U('Person/index',array('list'=>5,'cla'=>1)));
        }
    }
    public function next()
    {
    	$this->display();
    }
    public function setpsw()
    {
    	$uid = $_SESSION["df_system_id"];
        $data['userpsw'] = md5(I('post.new_psw'));
        $setid = $this->adminM->where("id=$uid")->save($data);
        if($setid){
        	$this->success("重置成功",U('Person/index',array('list'=>5,'cla'=>1)));
        }else{
        	$this->error("重置密码失败");
        }
    }
    public function msgboard(){
        $msgb = M('msgboard');
        
        $count = $msgb->count();
        $page = new \Think\Page($count,15);
        $page -> setConfig('prev','<<');
        $page -> setConfig('next','>>');
        $page -> setConfig('first','1...');
        $page -> setConfig('last','...%TOTAL_PAGE%');
        $page -> setConfig('theme',' <div class="col-md-12 text-center clearfix">
                                <ul class="pagination">
                                    <li>%UP_PAGE%</li>
                                    <li>%LINK_PAGE%</li>
                                    <li>%DOWN_PAGE%</li>
                                </ul>
                            </div>');
        $show = $page->show();

        $mgsdata = $msgb->limit($page->firstRow.','.$page->listRows)->order('id desc')->select();
        $this->assign('mgsdata',$mgsdata);
        $this->assign('page',$show);
        $this->display();
    }
}