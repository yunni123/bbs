<?php 
//登录页面的验证
 //1.加载初始化信息
 include "../init.php";
//2.连接数据库寻找匹配信息
 include DIR_CORE . 'MySQLDB.php';

//3.接收数据
 $username=strip_tags(trim($_POST['username']));
 $password=strip_tags(trim(md5($_POST['password'])));
 //4.判断接收的账号密码是否和数据库中账号密码匹配
 //sql注入 万能账号 ' or num=num#
 $sql ="select * from user where user_name='$username' and user_password='$password'";
 $res=my_query($sql);
 $row=mysql_fetch_assoc($res);
 //用错误抑制符是因为如果在数据库中查不到匹配的用户名和密码导致$res无法取回关联数组，返回布尔值0 此时会弹出警告
   //用md5把输入的密码进行转换
    if($username == '' || $password == '') {
	// 判断为空
	 header('refresh:2;url = ./login.php');
	    die('用户名和密码不能为空');
    }elseif(mysql_affected_rows()==0){
       header('refresh:3;url = ./login.php');
       die('登录失败，用户名或密码错误！');	
    }elseif(mysql_affected_rows() > 0){
    //登录成功跳转首页
      if(isset($_POST['remember'])){
      setcookie('user_id',$row['user_id'],time() + 604800,'/');
      }
      session_start();
      $_SESSION['userInfo'] = $row;
      if($_GET['list']){
         header('refresh:1;url=./list_father.php');
         die;}
      else{
       header('refresh:2;url = ../index.php');
         die('登录成功，2秒后自动跳转到首页！');
          }
         
      }



 