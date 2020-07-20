<?php
/*
	后台公共控制器
*/

namespace m\Controller;
use Think\Controller;
class BaseController extends Controller{
	public function _initialize(){
        
        //系统参数
        $this->sys = M('sys');
        $this->find = $this->sys->where('id=1')->find();
        $this->find['aboutus'] = htmlspecialchars_decode($this->find['aboutus']);
        $this->assign('sys',$this->find);
    }
    
    public function msg($messager,$url){
        echo "<script>
            alert('$messager ');
            location.href = '$url ';
        </script>";
    }
    public function verify(){
        ob_clean();
        $config = array('fontSize'    =>30,    // 验证码字体大小    
                        'length'      =>4,     // 验证码位数    
                        'useCurve'    =>false,
                        );
        $Verify = new \Think\Verify($config);
        $Verify->entry();
    }   

    // 获得用户访问ip函数
    public function insertip(){
        $getip = M('getip');
        $data['ip'] = get_client_ip();
                $data['skimtime'] = date("Y-m-d H:i:s");
        $data['from']= "移动端";
        $getip->add($data);
    }
}
?>