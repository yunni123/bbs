<?php 
include '../init.php';
//加载初始化文件
if(isset($_COOKIE['user_id']) && isset($_SESSION['userInfo'])){
	if($_GET['list']){
		header('location:./list_father.php');
	}
	else{
		header('location:../index.php');
    }
}

$list=@ $_GET['list'];

include DIR_VIEW .'login.html';
//加载视图化文件
