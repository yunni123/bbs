<?php

// 加载项目初始化文件
//include_once '../init.php';
// 加载配置文件
$config = include DIR_CONFIG . 'config.php';
/**
 * 用来连接数据库
 */
function my_connect($config) {
	$host = isset($config['db']['host']) ?  $config['db']['host'] : 'localhost';
	$port = isset($config['db']['port']) ?  $config['db']['port'] : '3306';
	$user = isset($config['db']['user']) ?  $config['db']['user'] : 'root';
	$pass = isset($config['db']['pass']) ?  $config['db']['pass'] : '';

	$link = @ mysql_connect("$host:$port","$user","$pass");
	if(!$link) {
		// 数据库连接失败
		echo "数据库连接失败！<br/>";
		echo "错误编号：",mysql_errno(),'<br />';
		echo "错误信息：",mysql_error(),'<br />';
		
		// 终止脚本运行
		die;
	}
}
/**
 * 用来判断sql语句执行成功
 * @param string $sql
 * @return resource|bool $res
 */
function my_query($sql) {
	// 先执行sql语句
	$res = mysql_query($sql);
	if(!$res) {
		// 执行失败
		echo "SQL语句执行失败！<br/>";
		echo "错误编号：",mysql_errno(),'<br />';
		echo "错误信息：",mysql_error(),'<br />';
		//echo "错误的sql语句为" .$sql;
		// 终止脚本运行
		die;
	}
	return $res;
}
/**
 * 选择默认的数据库
 * @param string $dbname 数据库名称
 */
function my_db($dbname='bbs') {
	$sql = "use $dbname";
	my_query($sql);
}

/**
 * 选择默认的字符集
 * @param string $charset 数据库名称
 */
function my_charset($charset='utf8') {
	$sql = "set names $charset";
	my_query($sql);
}
// 连接数据库
my_connect($config);
// 设置字符集
my_charset($config['db']['charset']);
// 设置默认的数据库
my_db($config['db']['dbname']);