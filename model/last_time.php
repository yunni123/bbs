<?php 
include '../init.php';
//设置cookie
setcookie('last_login_time',time(),PHP_INT_MAX);
//判断cookie是否存在
if(isset($_COOKIE['last_login_time'])){
	echo "上次访问的IP为:",date('Y-m-d H:i:s',$_COOKIE['last_login_time']);
}else{
	echo '欢迎光临!';
}

