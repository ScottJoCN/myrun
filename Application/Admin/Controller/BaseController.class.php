<?php
/*
	公共控制器
*/

namespace Admin\Controller;
use Think\Controller;
header("Content-type: text/html; charset=utf-8"); 
class BaseController extends Controller{
	public function _initialize(){

        $this->islogin();
        $this->assign('auth',$_SESSION['auth']);
        $this->getsys();
        $this->gget();
    }
	public function index(){
		/*if(!isset($_SESSION['username'])){
			$this->redirect('Login/index');
		}*/

	}
    public function getsys(){
        //系统参数
        $this->sys = M('sys');
        $this->find = $this->sys->where('id=1')->find();
        $this->find['aboutus'] = htmlspecialchars_decode($this->find['aboutus']);
        $this->assign('sys',$this->find);
    }
	public function add(){

        $this->display();
    }
	
	public function msg($messager,$url){
		echo "<script>
            alert('$messager ');
            location.href = '$url ';
        </script>";
	}
	public function islogin(){
		if(!isset($_SESSION['df_system_id'])){
			$this->redirect('Login/index');
		}
		$this->assign('nickname',$_SESSION['nickname']);
	}
	public function gget(){

        // $list = I('get.list');
        // $cla = I('get.cla');
        // $this->assign(array('list'=>$list,'cla'=>$cla));
        
		$list = I('get.list');
        $cla = I('get.cla');
        $msg = I('get.msg');

        $this->assign(array('list'=>$list,'cla'=>$cla,'msg'=>$msg));
	}
	public function getpage($count,$num){
        $page = new \Think\Page($count,$num);
        $page -> setConfig('prev','<<');
        $page -> setConfig('next','>>');
        $page -> setConfig('first','1...');
        $page -> setConfig('last','...%TOTAL_PAGE%');
        $page -> setConfig('theme',' <div class="col-md-12 text-center clearfix"><ul class="pagination"><li>%UP_PAGE%</li><li >%LINK_PAGE%</li><li>%DOWN_PAGE%</li></ul></div>');
        return $page;

    }
    public function operateActive($lpid,$msg){
        $operateM = M('operate');
        $adminid = session('df_system_id');
        if($lpid !=''){
            $data['lpid'] = $lpid;
            $data['active'] = $msg;
            $data['logtime'] = time();
            $data['adminid'] = $adminid;
            $ins = $operateM->add($data);
        }
        
    }
    public function get_pic_data($where){
        $count = $this->pic->where($where)->count();
        $getpage = $this->getpage($count,15);
        $show = $getpage->show();
        $p_data = $this->pic->where($where)->limit($getpage->firstRow.','.$getpage->listRows)->order("id desc")->select();
        $pic_data['show'] = $show;
        $pic_data['p_data'] = $p_data;
        return $pic_data;
    }
    
}
