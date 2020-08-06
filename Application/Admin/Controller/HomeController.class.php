<?php
namespace Admin\Controller;
use Admin\Controller\BaseController;
class HomeController extends BaseController {
    public function _initialize(){
        $this->islogin();
        $this->pic = M('pic');
        $this->getsys();
		$this->gget();
    }
    public function piclist(){

    	$where['type'] = array('in','1,15');
    	$p_data = $this->get_pic_data($where);
    	$this->assign('page',$p_data['show']);
        
        $this->assign('projD',$p_data['p_data']);
		
    	$this->display();
    }
    


    public function add(){
    	$this->display();
    }
    public function addpic(){
    	if(IS_POST){
    		$data = $this->pic->create();
			$upload = new \Think\Upload();//文件实例化上传
			$upload->maxSize = 3145728;
			$upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型    
			$upload->savePath  =      '/pic/'; // 设置附件上传目录 相对于/Uploads
			$info   =   $upload->upload();
			if($info['picurl']){
				$data['picurl'] = '/Uploads'.$info["picurl"]["savepath"].$info["picurl"]["savename"];
			}else{
				$this->error("请添加轮播图片");
			}
			
			
			$insertid = $this->pic->add($data);
			if($insertid){
				$this->success("添加成功",U('Home/piclist',array('list'=>1,'cla'=>1)));
			}else{
				$this->error("添加失败");
			}
    	}else{
    		$this->display();
    	}
    }
    public function editpic(){
    	if(IS_POST){
			$data = $this->pic->create();
			$upload = new \Think\Upload();//文件实例化上传
			$upload->maxSize = 3145728;
			$upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型    
			$upload->savePath  =      '/pic/'; // 设置附件上传目录 相对于/Uploads
			$info   =   $upload->upload();
			if($info['picurl']){
				$data['picurl'] = '/Uploads'.$info["picurl"]["savepath"].$info["picurl"]["savename"];
			}

			$saveid = $this->pic->save($data);
			if($saveid){
				$this->success("编辑成功",U('Home/piclist',array('list'=>1,'cla'=>1)));
			}else{
				$this->error("编辑失败");
			}
		}else{
			$id = I('get.id');

			$where['id'] = $id;
			$proD = $this->pic->where($where)->find();
			$this->assign('pro',$proD);
			$this->display();
		}
    }
    public function del(){
		$id = I('get.id');
		$delid = $this->pic->where("id = $id")->delete();
		if($delid){
			$this->success("删除成功",U('Home/piclist',array('list'=>1,'cla'=>1)));
		}else{
			$this->error("删除失败");
		}
	}
	// 首页功能
	public function attr(){
		$where['type'] = 2;
    	$p_data = $this->get_pic_data($where);
    	$this->assign('page',$p_data['show']);
        $this->assign('projD',$p_data['p_data']);

		$this->display();
	}

	public function addattr(){
    	if(IS_POST){
    		$data = $this->pic->create();
    		$data['pic_content'] = strip_tags(htmlspecialchars_decode($data['pic_content']));
			$data['pic_content'] = mb_substr($data['pic_content'],0,100,'utf-8');
			
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
				$this->success("添加成功",U('Home/attr',array('list'=>1,'cla'=>2)));
			}else{
				$this->error("添加失败");
			}
    	}else{
    		$this->display();
    	}
    }
    public function editattr(){
    	if(IS_POST){
			$data = $this->pic->create();
			$data['pic_content'] = strip_tags(htmlspecialchars_decode($data['pic_content']));
			$data['pic_content'] = mb_substr($data['pic_content'],0,100,'utf-8');
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
				$this->success("编辑成功",U('Home/attr',array('list'=>1,'cla'=>2)));
			}else{
				$this->error("编辑失败");
			}
		}else{
			$id = I('get.id');
			$where['id'] = $id;
			$where['type'] = 2;
			$proD = $this->pic->where($where)->find();
			$proD['pic_content'] = htmlspecialchars_decode($proD['pic_content']);
			$this->assign('pro',$proD);
			$this->display();
		}
    }
    public function delattr(){
		$id = I('get.id');
		$delid = $this->pic->where("id = $id")->delete();
		if($delid){
			$this->success("删除成功",U('Home/attr',array('list'=>1,'cla'=>2)));
		}else{
			$this->error("删除失败");
		}
	}

	// 行业
	public function company(){
		$where['type'] = 3;
    	$p_data = $this->get_pic_data($where,1);
    	$this->assign('page',$p_data['show']);
        $this->assign('projD',$p_data['p_data']);

		$this->display();
	}

	public function addcompany(){
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
				$this->success("添加成功",U('Home/company',array('list'=>1,'cla'=>3)));
			}else{
				$this->error("添加失败");
			}
    	}else{
    		$this->display();
    	}
    }
    public function editcompany(){
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
				$this->success("编辑成功",U('Home/company',array('list'=>1,'cla'=>3)));
			}else{
				$this->error("编辑失败");
			}
		}else{
			$id = I('get.id');
			$where['id'] = $id;
			$where['type'] = 3;
			$proD = $this->pic->where($where)->find();
			$this->assign('pro',$proD);
			$this->display();
		}
    }
    public function delcompany(){
		$id = I('get.id');
		$delid = $this->pic->where("id = $id")->delete();
		if($delid){
			$this->success("删除成功",U('Home/company',array('list'=>1,'cla'=>3)));
		}else{
			$this->error("删除失败");
		}
	}

// 行业
	public function caselist(){
		$where['type'] = 4;
    	$p_data = $this->get_pic_data($where);
    	$this->assign('page',$p_data['show']);
        $this->assign('projD',$p_data['p_data']);

		$this->display();
	}

	public function addcase(){
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
				$this->success("添加成功",U('Home/caselist',array('list'=>1,'cla'=>4)));
			}else{
				$this->error("添加失败");
			}
    	}else{
    		$this->display();
    	}
    }
    public function editcase(){
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
				$this->success("编辑成功",U('Home/caselist',array('list'=>1,'cla'=>4)));
			}else{
				$this->error("编辑失败");
			}
		}else{
			$id = I('get.id');
			$where['id'] = $id;
			$where['type'] = 4;
			$proD = $this->pic->where($where)->find();
			$this->assign('pro',$proD);
			$this->display();
		}
    }
    public function delcase(){
		$id = I('get.id');
		$delid = $this->pic->where("id = $id")->delete();
		if($delid){
			$this->success("删除成功",U('Home/caselist',array('list'=>1,'cla'=>4)));
		}else{
			$this->error("删除失败");
		}
	}
}