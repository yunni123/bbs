<?php
include '../init.php';
session_start();
if(!isset($_SESSION['userInfo'])){
   header("refresh:2;url=./login.php");
   die("请登录再上传头像!");
}
include DIR_VIEW.'upload_image.html';