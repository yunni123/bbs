<?php

// 加载项目初始化文件
include './init.php';
session_start();
if(isset($_COOKIE['user_id'])){
	include DIR_CORE . 'MySQLDB.php';
	$user_id=$_COOKIE['user_id'];
	$sql="select * from user where user_id='$user_id'";
	$result=mysql_query($sql);
	$row=mysql_fetch_assoc($result);
	
	$_SESSION['userInfo']=$row;
}

// 加载视图文件
include DIR_VIEW . 'index.html';