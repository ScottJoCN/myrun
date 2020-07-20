<?php
namespace Admin\Controller;
use Think\Controller;
class LoginController extends Controller {
    public function _initialize(){
        $this->adminM = M('admin');
        $this->getsys();
    }
    public function index(){
       $this->display();
    }
    public function dologin(){
        header("Content-Type:text/html;charset=utf-8");
        $username = trim(I('post.adname'));
        $password = trim(I('post.adpsw'));
        $code = I('post.verifyCode');
        if(empty($username) || empty($password)){
            $this->msg("用户名或密码不能为空!",U('Login/index'));
        }
        $verify = new \Think\Verify();
        
        $this->adminM = M('admin');
        $condition = array();
        $condition['username'] =array('eq',$username);
        $authInfo =$this->adminM->where($condition)->find();
        
        
        // exit;
        if(!$authInfo){
            $this->msg("用户名不存在!",U('Login/index'));
        }else{
            if($authInfo['userpsw'] != md5($password)) {
                $this->msg("密码错误!",U('Login/index'));
            }else{
                if(!$verify->check($code)){
                    $this->msg("验证码错误!",U('Login/index'));
                }else{
                    if($authInfo['isreg'] == 0){
                        $this->msg("用户未通过审核",U('Login/index'));
                    }else{
                        session('username',$authInfo['user']);
                        session('df_system_id',$authInfo['id'],3600);
                        session('group',$authInfo['group']);
                        session('nickname',$authInfo['nickname']);
                        $id = $authInfo['id'];
                        $data['loginno'] = $authInfo['loginno'] + 1;
                        $data['lastip'] = get_client_ip();
                        $data['lasttime'] = time();

                        $save = $this->adminM->where("id = $id")->save($data);
                        
                        // $this->assign('jumpUrl',U('Index/index'));
                        
                        // $this->assign('jumpUrl',U('Index/index'));
                        $this->success("登录成功!",U('Index/index'));
                    }
                }
            }
        }


    }
    public function verify(){
        $config = array('fontSize'    =>30,    // 验证码字体大小    
                        'length'      =>4,     // 验证码位数    
                        'useCurve'    =>false,
                        );
        $Verify = new \Think\Verify($config);
        $Verify->entry();
    }
    public function msg($messager,$url){
        echo "<script>
            alert('$messager ');
            location.href = '$url ';
        </script>";
    }
    public function logout(){
        $admin = M('admin');
        if(isset($_SESSION['df_system_id'])){
            $id = $_SESSION['df_system_id'];
            $data['lastouttime'] = time();
            $saveid = $admin->where("id = $id")->save($data);
            session_destroy();
            $this->success("用户退出成功",U('Login/index'));
        }else {
            //$this->assign('jumpUrl',U('Index/index'));
            $this->msg("用户并未登录",U('Login/index'));
        }
    }
    public function reg(){
        if(IS_POST){
            $data['username'] = I('post.adname');
            $data['nickname'] = I('post.nickname');
            $data['email'] = I('post.email');
            $data['userpsw'] = md5(I('post.conpsw'));
            $data['group'] = 2;
            $data['addtime'] = time();
            // var_dump($data);
            $ins = $this->adminM->add($data);
            if($ins){
                $this->success('注册成功，通过管理员确认后可登陆',U('Login/index'));
            }else{
                $this->error('用户注册失败');
            }
        }else{
            $this->display();
        }
        
    }
    // 验证邮箱是否存在
    public function regemail(){
        $email = I('post.email');
        // return ;
        $res = $this->adminM->where("email = '".$email."'")->find();
        
        if($res){
            echo '1';
        }else{
            echo '2';
        }

    }
    // 验证用户名是否存在
    public function regadmin(){
        $adminname = I('post.admin');
        // return ;
        $res = $this->adminM->where("username = '".$adminname."'")->find();
        
        if($res){
            echo '1';
        }else{
            echo '2';
        }

    }
    public function getsys(){
        //系统参数
        $this->sys = M('sys');
        $this->find = $this->sys->where('id=1')->find();
        $this->find['aboutus'] = htmlspecialchars_decode($this->find['aboutus']);
        $this->assign('sys',$this->find);
    }
}