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
}
