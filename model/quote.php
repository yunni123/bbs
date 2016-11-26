<?php 
include '../init.php';
//判断用户是否登录
session_start();
if(!isset($_SESSION['userInfo'])){
   header('refresh:2;url=./login.php');
   die('请登录!');
}

//连接数据库
include DIR_CORE.'MySQLDB.php';

$num=$_GET['num'];//引用的层数 
$pub_id=$_GET['pub_id'];//楼主的ID 从这里可以得出publish= id 的表所有数据  
$rep_id=$_GET['rep_id'];//被引用回复那一篇帖子的id. 可以获得reply= id 的表中所有数据
//得到楼主的信息
$sql="select * from publish where pub_id=$pub_id";
$res=my_query($sql);
$row=mysql_fetch_assoc($res);
//得到被引用回复那一篇帖子的信息
$rep_sql="select * from reply where rep_id=$rep_id";
$rep_res=my_query($rep_sql);
$rep_row=mysql_fetch_assoc($rep_res);


include DIR_VIEW.'quote.html';

