<?php
namespace Admin\Controller;
use Admin\Controller\BaseController;
class AboutController extends BaseController {
    public function _initialize(){
        $this->islogin();
        $this->pic = M('pic');
        $this->getsys();
		$this->gget();
    }
    public function index(){

    	if(IS_POST){
    		$id = I('post.id');
			$data = $this->pic->create();
			$upload = new \Think\Upload();//文件实例化上传
			$upload->maxSize = 3145728;
			$upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型    
			$upload->savePath  =      '/pic/'; // 设置附件上传目录 相对于/Uploads
			$info   =   $upload->upload();
			if($info){
				$data['picurl'] = '/Uploads'.$info["picurl"]["savepath"].$info["picurl"]["savename"];
			}
			if($id){
				$saveid = $this->pic->save($data);
			}else{
				$saveid = $this->pic->add($data);
			}
			
			if($saveid){
				$this->success("编辑成功",U('about/index',array('list'=>8,'cla'=>1)));
			}else{
				$this->error("编辑失败");
			}
		}else{
			$where['type'] = 13;
			$proD = $this->pic->where($where)->find();
			$this->assign('pro',$proD);
			$this->display();
		}
    }
    

    //	定制开发介绍列表
    public function lists(){
    	$where['type'] = 14;
    	$p_data = $this->get_pic_data($where);
    	$this->assign('page',$p_data['show']);
        $this->assign('projD',$p_data['p_data']);

    	$this->display();
    }
    public function listsadd(){
    	if(IS_POST){
    		$data = $this->pic->create();
			

			$upload = new \Think\Upload();//文件实例化上传
			$upload->maxSize = 3145728;
			$upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型    
			$upload->savePath  =      '/pic/'; // 设置附件上传目录 相对于/Uploads
			$info   =   $upload->upload();
			if($info["picurl"]){
				$data['picurl'] = '/Uploads'.$info["picurl"]["savepath"].$info["picurl"]["savename"];
			}else{
				$this->error("请添加pc端图片");
			}
			if($info["picurl_small"]){
				$data['picurl_small'] = '/Uploads'.$info["picurl_small"]["savepath"].$info["picurl_small"]["savename"];
			}else{
				$this->error("请添加移动端图片");
			}

			$insertid = $this->pic->add($data);
			if($insertid){
				$this->success("添加成功",U('about/lists',array('list'=>8,'cla'=>2)));
			}else{
				$this->error("添加失败");
			}
    	}else{
    		$this->display();
    	}
    }
    public function listsedit(){
    	if(IS_POST){
			$data = $this->pic->create();
			$upload = new \Think\Upload();//文件实例化上传
			$upload->maxSize = 3145728;
			$upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型    
			$upload->savePath  =      '/pic/'; // 设置附件上传目录 相对于/Uploads
			$info   =   $upload->upload();
			if($info["picurl"]){
				$data['picurl'] = '/Uploads'.$info["picurl"]["savepath"].$info["picurl"]["savename"];
			}
			if($info["picurl_small"]){
				$data['picurl_small'] = '/Uploads'.$info["picurl_small"]["savepath"].$info["picurl_small"]["savename"];
			}


			$saveid = $this->pic->save($data);
			if($saveid){
				$this->success("编辑成功",U('about/lists',array('list'=>8,'cla'=>2)));
			}else{
				$this->error("编辑失败");
			}
		}else{
			$id = I('get.id');

			$where['id'] = $id;
			$where['type'] = 14;
			$proD = $this->pic->where($where)->find();
			$this->assign('pro',$proD);
			$this->display();
		}
    }
    public function introdel(){
		$id = I('get.id');
		$delid = $this->pic->where("id = $id")->delete();
		if($delid){
			$this->success("删除成功",U('about/lists',array('list'=>8,'cla'=>2)));
		}else{
			$this->error("删除失败");
		}
	}
	
}