<?php
namespace Admin\Controller;
use Admin\Controller\BaseController;
class ArtController extends BaseController {
    public function _initialize(){
        $this->islogin();
        $this->article = M('article');
        $this->getsys();
		$this->gget();
    }
    public function index(){

    	$source = I('get.kws');
    	if($source!=''){
    		$where['atitle'] = array('like',"%$source%");
	    	$where['txtorigin'] = array('like',"%$source%");
	    	$where['_logic'] = 'or';
	    	$map['_complex'] = $where;
    	}
    	$count = $this->article->where($map)->count();
    	$getpage = $this->getpage($count,15);
        $show = $getpage->show();
        if ($source) {
        	$artD = $this->article->where($map)->order("aid desc")->select();
        }else{
        	$artD = $this->article->where($map)->limit($getpage->firstRow.','.$getpage->listRows)->order("aid desc")->select();
        	$this->assign('page',$show);
        }
        $this->assign('artD',$artD);
		
    	$this->display();
    }
    public function add(){
		

    	$this->display();
    }


	public function insert(){
		$data = $this->article->create();
		$upload = new \Think\Upload();//文件实例化上传
		$upload->maxSize = 3145728;
		$upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型    
		$upload->savePath  =      '/pic/'; // 设置附件上传目录 相对于/Uploads
		$info   =   $upload->upload();
		if($info['pic']!=''){
			$data['pic'] = '/Uploads'.$info["pic"]["savepath"].$info["pic"]["savename"];
			
		}
		if($info['title_pic']!=''){
			$data['title_pic'] = '/Uploads'.$info["title_pic"]["savepath"].$info["title_pic"]["savename"];
		}
		
		$edittime = strtotime(I('post.edittime'));
		$editskim = I('post.editskim');
		if($edittime == ''){
			$data['time'] = time();
		}else{
			$data['time'] = $edittime;
		}
		if($editskim != ''){
			$data['skimno'] = $editskim;
		}
		
		$insertid = $this->article->add($data);
		if($insertid){
			$this->success("添加成功",U('Art/index',array('list'=>2,'cla'=>3)));
		}else{
			$this->error("添加失败");
		}
	}
	public function edit(){
		if(IS_POST){
			$data = $this->article->create();
			// $data['aid'] = I('post.aid');
			$edittime = strtotime(I('post.edittime'));
			$editskim = I('post.editskim');
			if($edittime == ''){
				$data['time'] = time();
			}else{
				$data['time'] = $edittime;
			}
			if($editskim != ''){
				$data['skimno'] = $editskim;
			}
			$upload = new \Think\Upload();//文件实例化上传
			$upload->maxSize = 3145728;
			$upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型    
			$upload->savePath  =      '/pic/'; // 设置附件上传目录 相对于/Uploads
			$info   =   $upload->upload();
			if($info['pic']!=''){
			$data['pic'] = '/Uploads'.$info["pic"]["savepath"].$info["pic"]["savename"];
			
			}
			if($info['title_pic']!=''){
				$data['title_pic'] = '/Uploads'.$info["title_pic"]["savepath"].$info["title_pic"]["savename"];
			}
			$saveid = $this->article->save($data);
			if($saveid){
				$this->success("编辑成功",U('Art/index',array('list'=>2,'cla'=>3)));
			}else{
				$this->error("编辑失败");
			}
		}else{
			$id = I('get.id');		
			
			$artD = $this->article->where("aid = $id")->find();
			$artD['contents'] = htmlspecialchars_decode($artD['contents']);
			$artD['edittime'] = date("Y-m-d H:i:s",$artD['time']);
			$this->assign('lp',$communityD);
			$this->assign('art',$artD);
			$this->display();
		}
	}
	public function del(){
		$id = I('get.id');
		$delid = $this->article->where("aid = $id")->delete();
		if($delid){
			$this->success("删除成功",U('Art/index',array('list'=>2,'cla'=>3)));
		}else{
			$this->error("删除失败");
		}
	}
	// 一键置顶
	public function set_top(){
		$id = I('post.id');
    	if($id){
			$lock_arr = explode(',', $id);
	    	foreach ($lock_arr as $v) {
	    		$data['is_top'] = 1;
	    		$setlock = $this->article->where("aid = $v")->save($data);
	    	}
	    	echo 1;
			
    	}else{
    		echo 2;
    	}
	}
	// 取消置顶
	public function unset_top(){
		$id = I('post.id');
    	if($id){
			$lock_arr = explode(',', $id);
	    	foreach ($lock_arr as $v) {
	    		$data['is_top'] = 0;
	    		$setlock = $this->article->where("aid = $v")->save($data);
	    	}
	    	echo 1;
			
    	}else{
    		echo 2;
    	}
	}
	// 一键推荐
	public function set_recom(){
		$id = I('post.id');
    	if($id){
			$lock_arr = explode(',', $id);
	    	foreach ($lock_arr as $v) {
	    		$data['is_recom'] = 1;
	    		$setlock = $this->article->where("aid = $v")->save($data);
	    	}
	    	echo 1;
			
    	}else{
    		echo 2;
    	}
	}
	// 取消推荐
	public function unset_recom(){
		$id = I('post.id');
    	if($id){
			$lock_arr = explode(',', $id);
	    	foreach ($lock_arr as $v) {
	    		$data['is_recom'] = 0;
	    		$setlock = $this->article->where("aid = $v")->save($data);
	    	}
	    	echo 1;
    	}else{
    		echo 2;
    	}
	}
	// 设置热门
	public function set_hot(){
		$id = I('post.id');
    	if($id){
			$lock_arr = explode(',', $id);
	    	foreach ($lock_arr as $v) {
	    		$data['is_hot'] = 1;
	    		$setlock = $this->article->where("aid = $v")->save($data);
	    	}
	    	echo 1;
			
    	}else{
    		echo 2;
    	}
	}
	// 取消热门
	public function unset_hot(){
		$id = I('post.id');
    	if($id){
			$lock_arr = explode(',', $id);
	    	foreach ($lock_arr as $v) {
	    		$data['is_hot'] = 0;
	    		$setlock = $this->article->where("aid = $v")->save($data);
	    	}
	    	echo 1;
    	}else{
    		echo 2;
    	}
	}
	public function set_modify(){
		$artid = I('post.artid');
		if(I('post.acid') !=''){
			$data['acid'] = I('post.acid');
		}
		if(I('post.is_recom') !=''){
			$data['is_recom'] = I('post.is_recom');
		}
		if(I('post.is_hot')!=''){
			$data['is_hot'] = I('post.is_hot');
		}
		if(I('post.is_top')!=''){
			$data['is_top'] = I('post.is_top');
		}
		$artid_arr = explode(',', $artid);
		foreach ($artid_arr as $v) {
			$saveid[] = $this->article->where("aid = $v")->save($data);
		}
		if($saveid){
			$this->success("更新成功",U('Art/index',array('list'=>2,'cla'=>3)));
		}else{
			$this->error("更新失败");
		}
	}
}