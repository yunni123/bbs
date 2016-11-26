<?php 
include '../init.php';

session_start();
if(!isset($_SESSION['userInfo'])){
	header('refresh:2;url=./login.php');
	die('请登录!');
}
include  DIR_VIEW . 'publish.html';
