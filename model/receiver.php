<?php

// 1,加载项目初始化文件
include '../init.php';

// 2,加载数据库连接文件
include DIR_CORE . 'MySQLDB.php';

// 3,接收数据
$username = trim($_POST['username']);
$password1 = trim($_POST['password1']);
$password2 = trim($_POST['password2']);
$vcode = trim($_POST['vcode']);
//!导入sql文件到MYsql
//判断验证码是否输入正确
session_start();
if(strtolower($vcode)!=strtolower($_SESSION['captcha'])){
	header("refresh:2;url=./register.php");
	die("验证码输入错误!");
}
// 4,判断用户名的数据是否合法
// 4.1 判断账号和密码是否为空
if($username == '' || $password1 == '' || $password2 == '') {
	// 非法，跳转
	header('refresh:2;url = ./register.php');
	die('用户名和密码都不能为空');
}

// 4.2 判断两个密码是否一致
if($password1 !== $password2) {
	// 非法，跳转
	header('refresh:2;url = ./register.php');
	die('两次输入的密码不一致');
}

// 4.3 判断用户名是否已经存在
$sql = "select * from user where user_name='$username'";
my_query($sql);
if(mysql_affected_rows() > 0) {
	//说明用户名已经存在
	// 非法，跳转
	header('refresh:2;url = ./register.php');
	die('您输入的用户名已经存在！');
}
// 5,验证结束，将用户信息写入数据库
$password = md5($password1);
$sql = "insert into user values(null,'$username','$password',default)";
$result = my_query($sql);

if($result) {
	// 注册成功，跳转到首页
	header('refresh:2;url = ./login.php');
	die('注册成功，2秒后自动跳转到登录！');
}else {
	// 跳转
	header('refresh:2;url = ./register.php');
	die('注册失败，发生未知错误！');
}