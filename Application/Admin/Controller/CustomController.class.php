<?php
namespace Admin\Controller;
use Admin\Controller\BaseController;
class CustomController extends BaseController {
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
				$this->success("编辑成功",U('custom/pp',array('list'=>7,'cla'=>1)));
			}else{
				$this->error("编辑失败");
			}
		}else{
			$where['type'] = 9;
			$proD = $this->pic->where($where)->find();
			$this->assign('pro',$proD);
			$this->display();
		}
    }
    

    //	定制开发介绍列表
    public function intro(){
    	$where['type'] = 10;
    	$p_data = $this->get_pic_data($where);
    	$this->assign('page',$p_data['show']);
        $this->assign('projD',$p_data['p_data']);

    	$this->display();
    }
    public function introadd(){
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
				$this->success("添加成功",U('custom/intro',array('list'=>7,'cla'=>2)));
			}else{
				$this->error("添加失败");
			}
    	}else{
    		$this->display();
    	}
    }
    public function introedit(){
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
				$this->success("编辑成功",U('custom/intro',array('list'=>7,'cla'=>2)));
			}else{
				$this->error("编辑失败");
			}
		}else{
			$id = I('get.id');

			$where['id'] = $id;
			$where['type'] = 10;
			$proD = $this->pic->where($where)->find();
			$this->assign('pro',$proD);
			$this->display();
		}
    }
    public function introdel(){
		$id = I('get.id');
		$delid = $this->pic->where("id = $id")->delete();
		if($delid){
			$this->success("删除成功",U('custom/intro',array('list'=>7,'cla'=>2)));
		}else{
			$this->error("删除失败");
		}
	}
	//服务流程
	public function service(){
    	$where['type'] = 11;
    	$p_data = $this->get_pic_data($where);
    	$this->assign('page',$p_data['show']);
        $this->assign('projD',$p_data['p_data']);

    	$this->display();
    }
    public function serviceadd(){
    	if(IS_POST){
    		$data = $this->pic->create();
    		$data['pic_content'] = strip_tags(htmlspecialchars_decode($data['pic_content']));
			$data['pic_content'] = mb_substr($data['pic_content'],0,30,'utf-8');
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
				$this->success("添加成功",U('custom/service',array('list'=>7,'cla'=>3)));
			}else{
				$this->error("添加失败");
			}
    	}else{
    		$this->display();
    	}
    }
    public function serviceedit(){
    	if(IS_POST){
			$data = $this->pic->create();
			$data['pic_content'] = strip_tags(htmlspecialchars_decode($data['pic_content']));
			$data['pic_content'] = mb_substr($data['pic_content'],0,30,'utf-8');
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
				$this->success("编辑成功",U('custom/service',array('list'=>7,'cla'=>3)));
			}else{
				$this->error("编辑失败");
			}
		}else{
			$id = I('get.id');

			$where['id'] = $id;
			$where['type'] = 11;
			$proD = $this->pic->where($where)->find();
			$this->assign('pro',$proD);
			$this->display();
		}
    }
    public function servicedel(){
		$id = I('get.id');
		$delid = $this->pic->where("id = $id")->delete();
		if($delid){
			$this->success("删除成功",U('custom/service',array('list'=>7,'cla'=>3)));
		}else{
			$this->error("删除失败");
		}
	}

	// 客户案例
	public function cases(){
    	$where['type'] = 12;
    	$p_data = $this->get_pic_data($where);
    	$this->assign('page',$p_data['show']);
        $this->assign('projD',$p_data['p_data']);

    	$this->display();
    }
    public function casesadd(){
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
				$this->success("添加成功",U('custom/cases',array('list'=>7,'cla'=>4)));
			}else{
				$this->error("添加失败");
			}
    	}else{
    		$this->display();
    	}
    }
    public function casesedit(){
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
				$this->success("编辑成功",U('custom/cases',array('list'=>7,'cla'=>4)));
			}else{
				$this->error("编辑失败");
			}
		}else{
			$id = I('get.id');

			$where['id'] = $id;
			$where['type'] = 12;
			$proD = $this->pic->where($where)->find();
			$this->assign('pro',$proD);
			$this->display();
		}
    }
    public function casesdel(){
		$id = I('get.id');
		$delid = $this->pic->where("id = $id")->delete();
		if($delid){
			$this->success("删除成功",U('custom/cases',array('list'=>7,'cla'=>4)));
		}else{
			$this->error("删除失败");
		}
	}
}