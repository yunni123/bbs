<?php 
//删除COOKIE
setcookie('user_id','',time()-1,'/');
//删除SESSION
session_start();
unset($_SESSION['userInfo']);
header('location:../index.php');
