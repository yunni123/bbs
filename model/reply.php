<?php
include '../init.php';
session_start();
if(!isset($_SESSION['userInfo'])){
	header('refresh:2;url=./login.php');
	die('请登录!');
}
include DIR_CORE.'MySQLDB.php';

$pub_id=$_GET['pub_id'];
$sql="select * from publish where pub_id=$pub_id";
$res=my_query($sql);
$row=mysql_fetch_assoc($res);
include DIR_VIEW.'reply.html';