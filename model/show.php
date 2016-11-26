<?php

//加载初始化文件
include '../init.php';
//加载数据库链接文件
include DIR_CORE.'MySQLDB.php';
session_start();
//接收帖子ID
$pub_id=$_GET['pub_id'];
if(!$_GET['action']){//如果不是通过get方式action传递过来的网页则浏览量+1
	$sql="update publish set pub_hits = pub_hits +1 where pub_id=$pub_id";
	my_query($sql);
	}

//提取楼主的资源结果集,将user表和publish表连接查询
$sql="select * from publish left join user on pub_owner = user_name where pub_id=$pub_id";
$res=my_query($sql);
$row_image=mysql_fetch_assoc($res);
//提取来自发帖的结果集
$sql="select * from publish where pub_id='$pub_id'";
$res=my_query($sql);
$row=mysql_fetch_assoc($res);
//每一页的记录显示
$pageNum = isset($_GET['num']) ? $_GET['num']:1; 
$rowsPerPage=5;
$page_sql="select count(*) from reply where rep_pub_id=$pub_id";
$page_res=my_query($page_sql);
$row_num=mysql_fetch_row($page_res);
$rowCount=$row_num[0];

$pages=ceil($rowCount/$rowsPerPage);
$strPage='';
//首页
$strPage.="<a href='./show.php?pub_id=$pub_id&action=reply&num=1'>首页</a> ";
//上一页
$preNum  = $pageNum==1? $pageNum : $pageNum-1;
$strPage.="<a href='./show.php?pub_id=$pub_id&action=reply&num=$preNum'><<上一页</a> ";
//显示的初始页最小值
if($pageNum<=3){
	$startNum=1;
}else{
	$startNum=$pages-2;
}
//显示初始页的最大值
if($startNum>$pages-4){
	$startNum=$pages-4;
}
// 防止初始页越界（出现负值）
if($startNum <= 1) {
	$startNum = 1;
}
//显示的最后一页的最大值
$endNum=$startNum+4;
if($endNum>$pages){
	$endNum=$pages;
}

//中间页码
for($i=$startNum;$i<=$endNum;$i++){
	$strPage.="<a href='./show.php?pub_id=$pub_id&action=reply&num=$i'>$i</a> ";
}
//下一页
$nextpage = $pageNum==$pages? $pages : $pageNum+1;
$strPage.="<a href='./show.php?pub_id=$pub_id&action=reply&num=$nextpage'>>>下一页</a> ";
//末尾页
$strPage.="<a href='./show.php?pub_id=$pub_id&action=reply&num=$pages'>>>尾页</a> ";


$offset=($pageNum-1)*$rowsPerPage;
//提取来自回复的结果集
$rep_sql="select * from reply left join user on rep_user=user_name where rep_pub_id=$pub_id order by rep_time limit {$offset},{$rowsPerPage}";
$rep_res=my_query($rep_sql);

include DIR_VIEW.'show.html';
