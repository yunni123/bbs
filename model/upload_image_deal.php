<?php 
include '../init.php';
include DIR_CORE.'MySQLDB.php';
include DIR_CORE.'upload.php';

//为函数实参添加相应的值
$files=$_FILES['image'];
$allow = array('image/jpg','image/jpeg','image/gif','image/png');
$path= DIR_ROOT.'uploads/images';
//调用上传函数
$result=upload($files,$allow,$path,$error);
	if(!$result){
		echo $error;
		header("refresh:2;url=./upload_image.php");
		die();
	}else{
		session_start();
		$user_name=$_SESSION['userInfo']['user_name'];
		$sql="update user set user_image='$result' where user_name='$user_name'";
		$res=my_query($sql);
		if($res){
			echo "<script>alert('上传成功！');</script>";
			header("refresh:0;url=./list_father.php");
		}else{
			header("refresh:0;url=./upload_image.php");
			die("发生未知错误，请重新上传");
		}
	 }