<?php
namespace Admin\Controller;
use Admin\Controller\BaseController;
class AdminController extends BaseController {
    public function _initialize(){
        $this->islogin();
        $this->adminM = M('admin');
        if($_SESSION['group'] != 1){
            $this->redirect('index/index');
        }
        $this->getsys();
        $this->gget();
    }
    public function index(){
    	$keyword = I('post.keyword');
    	if($keyword !=''){
    		$map['username|nickname|email'] = array('like', "%$keyword%");
    	}
    	$count = $this->adminM->where($map)->count();
		
		$getpage = $this->getpage($count,10);
        $show = $getpage->show();    	
    	
    	$adminD = $this->adminM->where($map)->limit($getpage->firstRow.','.$getpage->listRows)->order("id desc")->select();
    	$this->assign('adminD',$adminD);
    	$this->assign('page',$show);
    	$this->display();
    }
    public function add(){

    	$this->display();
    }
    public function insert(){
    	$data['username'] = I('post.adname');
        $data['nickname'] = I('post.nickname');
        $data['email'] = I('post.email');
        $data['userpsw'] = md5(I('post.conpsw'));
        $data['group'] = I('post.group');
        $data['islock'] = I('post.islock');
        $data['isreg'] = 1;
        $data['addtime'] = time();
        $ins = $this->adminM->add($data);
        if($ins){
            $this->success('添加成功',U('Admin/index',array('list'=>4,'cla'=>1)));
        }else{
            $this->error('添加失败');
        }
    }
    public function edit(){
    	if(IS_POST){
    		$id = I('post.id');
    		$data['nickname'] = I('post.nickname');
	        $data['email'] = I('post.email');
	        $data['group'] = I('post.group');
	        $data['islock'] = I('post.islock');
	        $data['isreg'] = I('post.isreg');
	        $saveid = $this->adminM->where("id = $id")->save($data);
	        if($saveid){
	        	$this->success('修改成功',U('Admin/index',array('list'=>4,'cla'=>1)));
	        }else{
	        	$this->error('修改失败');
	        }
    	}else{
    		
    		$id = I('get.id');
    		$adminD = $this->adminM->field('id,username,nickname,group,islock,email,isreg')->find($id);
    		$this->assign('ad',$adminD);
    		$this->display();
    	}
    }
    public function del(){
    	$id = I('get.id');
    	$user = $this->adminM->find($id);
    	$lock = $user['islock'];
    	if($lock){
    		$this->error('该用户被锁定，不能删除');
    	}else{
    		$delid = $this->adminM->delete($id);
    		if($delid){
    			$this->success('删除成功',U('Admin/index',array('list'=>4,'cla'=>1)));
    		}else{
    			$this->error('删除失败');
    		}
    	}
    }
    public function batch_del(){
    	$id = I('post.id');
    	if($id){
    		$check_arr = explode(',', $id);

    		foreach ($check_arr as $v) {
    			$user = $this->adminM->find($v);
    			$lock = $user['islock'];
    			if($lock){
    				echo 3;
    			}else{
    				$delid = $this->adminM->delete($v);
    				echo 1;
    			}

	    	}
    	}else{
    		echo 2;
    	}
    }
    public function lock(){
    	$id = I('get.id');
    	$data['islock'] = 1;
    	$setlock = $this->adminM->where("id = $id")->save($data);
    	if($setlock){
    		$this->success('锁定成功',U('Admin/index',array('list'=>4,'cla'=>1)));
    	}else{
    		$this->error('锁定失败');
    	}
    }
    public function unlock(){
    	$id = I('get.id');
    	$data['islock'] = 0;
    	$setlock = $this->adminM->where("id = $id")->save($data);
    	if($setlock){
    		$this->success('解锁成功',U('Admin/index',array('list'=>4,'cla'=>1)));
    	}else{
    		$this->error('解锁失败');
    	}
    }
    public function batch_lock(){
    	$id = I('post.id');
    	if($id){
			$lock_arr = explode(',', $id);
			// echo json_encode($lock_arr);
	    	foreach ($lock_arr as $v) {
	    		$data['islock'] = 1;
	    		$setlock = $this->adminM->where("id = $v")->save($data);
	    	}
	    	echo 1;
			
    	}else{
    		echo 2;
    	}
	    	
    }
    public function batch_unlock(){
    	$id = I('post.id');
    	if($id){
			$unlock_arr = explode(',', $id);
			// echo json_encode($lock_arr);
	    	foreach ($unlock_arr as $v) {
	    		$data['islock'] = 0;
	    		$setlock = $this->adminM->where("id = $v")->save($data);
	    	}
	    	echo 1;
			
    	}else{
    		echo 2;
    	}

    }
    public function batch_check(){
    	$id = I('post.id');
    	if($id){
			$check_arr = explode(',', $id);
	    	foreach ($check_arr as $v) {
	    		$data['isreg'] = 1;
	    		$checked = $this->adminM->where("id = $v")->save($data);
	    	}
	    	echo 1;
    	}else{
    		echo 2;
    	}
    }

}