<?php
namespace Admin\Controller;
use Admin\Controller\BaseController;
class IndexController extends BaseController {
    public function _initialize(){
        $this->islogin();
        $this->gget();
        $this->getsys();
    }
    public function index(){
    	

    	$this->display();
    }
    public function sidebar(){
    	$this->display();
    }
    public function booking(){
        $msgboard = M('msgboard');

        $count = $msgboard->count();
        $getpage = $this->getpage($count,15);

        $show = $getpage->show();
        $p_data = $msgboard->limit($getpage->firstRow.','.$getpage->listRows)->order("id desc")->select();
        
        $this->assign('page',$show);
        $this->assign('booking',$p_data);

        $this->display();
    }
}
