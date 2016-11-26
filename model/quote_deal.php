<?php 
include '../init.php';
include DIR_CORE.'MySQLDB.php';
$num=$rep_flag_num=$_GET['num'];
$pub_id=$rep_pub_id=$_GET['pub_id'];//帖子ID等于回复帖子的ID 等于楼主帖子的ID
$rep_id=$_GET['rep_id'];//回复帖子ID
$content=$rep_content=strip_tags(trim($_POST['content']));
 //判断引用回复的内容是否为空
if(empty($content)){
	header('refresh:2;url=./quote.php?num=$num&pub_id=$pub_id&rep_id=$rep_id');
	die('回复内容不能为空');
}
//被引用回复帖子的信息
$rep_sql="select * from reply where rep_id=$rep_id";
$rep_res=my_query($rep_sql);
$rep_row=mysql_fetch_assoc($rep_res);
$rep_flag_user=$rep_row['rep_owner'];
$rep_flag_content=$rep_row['content'];
$rep_time= time();
session_start();
$rep_user=$_SESSION['userInfo']['user_name'];
$sql="insert into reply values(null,$pub_id,'$rep_user','$rep_content',$rep_time,1,$num,'$rep_flag_user','$rep_flag_content')";
$res=my_query($sql);
if($res){
	header("location:./show.php?pub_id=$pub_id&action=reply");
}else{
	header("refresh:2;url=./quote.php?num=$num&pub_id=$pub_id&rep_id=$rep_id");
	die('发生未知错误！');
}




