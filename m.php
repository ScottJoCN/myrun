<?php
	/*
		前台入口文件
	*/
// 检测PHP环境
if(version_compare(PHP_VERSION,'5.3.0','<'))  die('require PHP > 5.3.0 !');
define('APP_DEBUG',True);
define('BIND_MODULE', 'm');
define('_PHP_FILE_',$_SERVER['SCRIPT_NAME']);
// 定义应用目录
define('APP_PATH','./Application/');
define("RUNTIME_PATH","./Cache/");
define('THINK_PATH',"./Frame/");
// 引入ThinkPHP入口文件
require THINK_PATH.'Frame.php';