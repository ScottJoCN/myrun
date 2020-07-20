<?php
namespace Admin\Controller;
use Admin\Controller\BaseController;
class ProjectController extends BaseController {
    public function _initialize(){
        $this->islogin();
        $this->pic = M('pic');
        $this->getsys();
		$this->gget();
    }
    public function pp(){

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
				$this->success("编辑成功",U('project/pp',array('list'=>2,'cla'=>1)));
			}else{
				$this->error("编辑失败");
			}
		}else{
			$where['type'] = 5;
			$proD = $this->pic->where($where)->find();
			$this->assign('pro',$proD);
			$this->display();
		}
    }
    

    //	产品列表
    public function prolist(){
    	$where['type'] = 6;
    	$p_data = $this->get_pic_data($where);
    	$this->assign('page',$p_data['show']);
        $this->assign('projD',$p_data['p_data']);

    	$this->display();
    }
    public function proadd(){
    	if(IS_POST){
    		$data = $this->pic->create();
			
			$insertid = $this->pic->add($data);
			if($insertid){
				$this->success("添加成功",U('project/prolist',array('list'=>2,'cla'=>2)));
			}else{
				$this->error("添加失败");
			}
    	}else{
    		$this->display();
    	}
    }
    public function proedit(){
    	if(IS_POST){
			$data = $this->pic->create();
			$saveid = $this->pic->save($data);
			if($saveid){
				$this->success("编辑成功",U('project/prolist',array('list'=>2,'cla'=>2)));
			}else{
				$this->error("编辑失败");
			}
		}else{
			$id = I('get.id');

			$where['id'] = $id;
			$where['type'] = 6;
			$proD = $this->pic->where($where)->find();
			$this->assign('pro',$proD);
			$this->display();
		}
    }
    public function prodel(){
		$id = I('get.id');
		$delid = $this->pic->where("id = $id")->delete();
		if($delid){
			$this->success("删除成功",U('project/prolist',array('list'=>2,'cla'=>2)));
		}else{
			$this->error("删除失败");
		}
	}
	//服务优势
	public function advantage(){
    	$where['type'] = 7;
    	$p_data = $this->get_pic_data($where);
    	$this->assign('page',$p_data['show']);
        $this->assign('projD',$p_data['p_data']);

    	$this->display();
    }
    public function advadd(){
    	if(IS_POST){
    		$data = $this->pic->create();
			$upload = new \Think\Upload();//文件实例化上传
			$upload->maxSize = 3145728;
			$upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型    
			$upload->savePath  =      '/pic/'; // 设置附件上传目录 相对于/Uploads
			$info   =   $upload->upload();
			if($info){
				$data['picurl'] = '/Uploads'.$info["picurl"]["savepath"].$info["picurl"]["savename"];
			}else{
				$this->error("请添加图片");
			}
			$insertid = $this->pic->add($data);
			if($insertid){
				$this->success("添加成功",U('project/advantage',array('list'=>2,'cla'=>3)));
			}else{
				$this->error("添加失败");
			}
    	}else{
    		$this->display();
    	}
    }
    public function advedit(){
    	if(IS_POST){
			$data = $this->pic->create();
			$upload = new \Think\Upload();//文件实例化上传
			$upload->maxSize = 3145728;
			$upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型    
			$upload->savePath  =      '/pic/'; // 设置附件上传目录 相对于/Uploads
			$info   =   $upload->upload();
			if($info){
				$data['picurl'] = '/Uploads'.$info["picurl"]["savepath"].$info["picurl"]["savename"];
			}
			$saveid = $this->pic->save($data);
			if($saveid){
				$this->success("编辑成功",U('project/advantage',array('list'=>2,'cla'=>3)));
			}else{
				$this->error("编辑失败");
			}
		}else{
			$id = I('get.id');

			$where['id'] = $id;
			$where['type'] = 7;
			$proD = $this->pic->where($where)->find();
			$this->assign('pro',$proD);
			$this->display();
		}
    }
    public function advdel(){
		$id = I('get.id');
		$delid = $this->pic->where("id = $id")->delete();
		if($delid){
			$this->success("删除成功",U('project/advantage',array('list'=>2,'cla'=>3)));
		}else{
			$this->error("删除失败");
		}
	}

	// 适用行业
	public function industry(){
    	$where['type'] = 8;
    	$p_data = $this->get_pic_data($where);
    	$this->assign('page',$p_data['show']);
        $this->assign('projD',$p_data['p_data']);

    	$this->display();
    }
    public function indadd(){
    	if(IS_POST){
    		$data = $this->pic->create();
			$upload = new \Think\Upload();//文件实例化上传
			$upload->maxSize = 3145728;
			$upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型    
			$upload->savePath  =      '/pic/'; // 设置附件上传目录 相对于/Uploads
			$info   =   $upload->upload();
			if($info){
				$data['picurl'] = '/Uploads'.$info["picurl"]["savepath"].$info["picurl"]["savename"];
			}else{
				$this->error("请添加图片");
			}
			$insertid = $this->pic->add($data);
			if($insertid){
				$this->success("添加成功",U('project/industry',array('list'=>2,'cla'=>4)));
			}else{
				$this->error("添加失败");
			}
    	}else{
    		$this->display();
    	}
    }
    public function indedit(){
    	if(IS_POST){
			$data = $this->pic->create();
			$upload = new \Think\Upload();//文件实例化上传
			$upload->maxSize = 3145728;
			$upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型    
			$upload->savePath  =      '/pic/'; // 设置附件上传目录 相对于/Uploads
			$info   =   $upload->upload();
			if($info){
				$data['picurl'] = '/Uploads'.$info["picurl"]["savepath"].$info["picurl"]["savename"];
			}
			$saveid = $this->pic->save($data);
			if($saveid){
				$this->success("编辑成功",U('project/industry',array('list'=>2,'cla'=>4)));
			}else{
				$this->error("编辑失败");
			}
		}else{
			$id = I('get.id');

			$where['id'] = $id;
			$where['type'] = 8;
			$proD = $this->pic->where($where)->find();
			$this->assign('pro',$proD);
			$this->display();
		}
    }
    public function inddel(){
		$id = I('get.id');
		$delid = $this->pic->where("id = $id")->delete();
		if($delid){
			$this->success("删除成功",U('project/industry',array('list'=>2,'cla'=>4)));
		}else{
			$this->error("删除失败");
		}
	}
}