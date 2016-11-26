<?php  
//每页输出的行数
$rowsPerpage=5;
//总数量
$sql=select count(*) from tb_name where xxid=$xxid;
$res=mysql_query($sql);
$rows=mysql_fetch_row($res);
$rowCount=$rows[0];
//总页数
$pages= ceil($rowCount/$rowsPerpage);
//确定当前页面
$pageNum=isset($_GET['num'])? $_GET['num'] : 1;
//首页
$strPage.="<a href='./xx.php?num=1'>首页</a>";
//上一页
$preNum=$pageNum==1? $pageNum : $pageNum-1;
$strPage.="<a href='./xx.php?num=$preNum'><<上一页</a>";
		for ($i=$startPage;$i<=$endPage;$i++){
			$strPage.="<a href='./xx.php?num=$i'>$i页</a>";
		}
//显示初始页的最小页数
if($pageNum<=3){
	$startPage=1;
}else{
	$startPage=$pageNum-2;
}
//显示初始页的最大值
if($startPage>$pages-4){
	$startPage=$page-4;
}
//防止越界出现负数
if($startPage<=1){
	$startPage=1;
}
//最尾页的最大值
$endPage=$startPage+4;
if($endPage>$pages){
	$endPage=$pages;
}
//下一页
$nextNum=$nextNum==$pages ? $pages : $pageNum+1;
$strPage.="<a href='./xx.php?num=$nextNum'>>>下一页</a>";
//尾页
$strPage.="<a href='./xx.php?num=$pages'><<上一页</a>";


//获得结果集
$offset=($pageNum-1)*$rowsPerpage;
$sql="select * from tb_name where xx_id=$xx_id order by  time desc limit {$offset},{$rowsPerpage}";