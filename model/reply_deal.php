<?php 
include '../init.php';
include DIR_CORE.'MySQLDB.php';
//开启session
session_start();
$rep_pub_id=$_POST['pub_id'];
$rep_user = $_SESSION['userInfo']['user_name'];
//接收回复内容
$rep_content=strip_tags(trim($_POST['content']));
$rep_time=time();

if ($rep_content==''){
	header('refresh:2;url=./reply.php?pub_id=$rep_pub_id');
	die('回复的内容不能为空');
}

$sql="insert into reply values(null,$rep_pub_id,'$rep_user','$rep_content',$rep_time,default,null,null,null)";
$res=my_query($sql);
if($res){                                       
//&通过传递一个action过去让show。php网页判断是不是回复跳转过去的网页
	

	header("location:show.php?pub_id=$rep_pub_id&action=reply");
}else{
	header('refresh:2;url=./reply.php?pub_id=$rep_pub_id');
	die('回复失败发生未知错误！');
}
