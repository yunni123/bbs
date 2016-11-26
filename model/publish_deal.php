<?php 
include "../init.php";
include DIR_CORE.'MySQLDB.php';
//接受数据
	$title=strip_tags(trim($_POST['title']));
	$content=strip_tags(trim($_POST['content']));
		if($title=='' || $content==''){
			header('refesh:2;./publish.php');
			die('内容和标题不能为空');
		}

session_start();
$pub_owner = $_SESSION['userInfo']['user_name'];

$pub_time=time();		
$sql="insert into publish values(null,'$title','$content','$pub_owner','$pub_time', default)";
$res=my_query($sql);
if($res){//成功跳转的页面 
	header('location:./list_father.php');
	}else{//失败跳转的页面
	header('refesh:2;./publish.php');	
	    die('发生未知错误');
}
/*-- 创建帖子表
create table publish(
	pub_id int unsigned primary key auto_increment comment '主键ID',
	pub_title varchar(50) not null comment '帖子标题',
	pub_content text not null comment '帖子内容',
	pub_owner varchar(20) not null comment '楼主(发帖者)',
	pub_time int not null comment '发帖的时间',
	pub_hits int unsigned not null default 0 comment '浏览次数'
)engine InnoDB default charset utf8;*/