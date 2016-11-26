<?php 
//加载初始化和数据连接文件
include '../init.php';
include DIR_CORE.'MySQLDB.php';

$keyword=strip_tags(trim($_GET['keyword']));

//分页：
$pageNum = isset($_GET['num']) ? $_GET['num']:1;
$rowsPerPage=5;
$sql="select count(*) from publish where pub_title like '%{$keyword}%'";
$res=my_query($sql);
$row=mysql_fetch_row($res);
$rowCount=$row[0];//总个数
//计算总页数 总个数/每页个数
$pages=ceil($rowCount/$rowsPerPage);
//开始第一页
$strPage='';
$strPage.="<a href='./list_father.php?num=1'>首页</a>";
//显示的初始页
//上一页
$preNum = $pageNum==1 ? $pageNum : $pageNum-1;
$strPage.="<a href='./list_father.php?num=$preNum'><<上一页</a>";
//拼凑中间页码
/*for($i=1;$i<$pages;$i++){
	$strPage.="<a href='./list_father.php?num=$i'>$i</a>";
}
*/
//确定显示的初始页
if($pageNum<=3){
	$startNum=1;
}else{
	$startNum=$pageNum-2;
}
//确定显示初始页的最大值
if($startNum>=$pages-4){
	$startNum=$pages-4;
}

//防止初始页出现负值
if($startNum<=1){
  $startNum=1;
}
//确定显示的最后一页
$endNum=$startNum+4;
//防止最后一页越界
if($endNum>$pages){
	$endNum=$pages;
}
//中间页码
for($i=$startNum;$i<=$endNum;$i++){
	if($i==$pageNum){
		$strPage.="<a href='./list_father.php?num=$i'><font color='green'>$i</font></a>";
	}else{
	$strPage.="<a href='./list_father.php?num=$i'>$i</a>";
    }
}
//下一页
$nextNum=$pageNum==$pages? $pageNum: $pageNum+1;
$strPage.="<a href='./list_father.php?num=$nextNum'>>>下一页</a>";
//尾页
$strPage.="<a href='./list_father.php?num=$pages'>>>尾页</a>";

//按照时间降序排列从数据库获得结果集
$offset=($pageNum-1)*$rowsPerPage;
$sql="select * from publish where pub_title like '%{$keyword}%' order by pub_time desc limit {$offset},{$rowsPerPage} ";
$res=my_query($sql);
//加载视图化文件

include DIR_VIEW.'list_father.html';
//判断是否登录才能发帖
session_start();
if(!isset($_SESSION['userInfo'])){
 header('refresh:2;url=./login.php');
 die('未登录，请登录!');
}
