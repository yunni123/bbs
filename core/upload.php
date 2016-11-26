<?php

# 文件上传函数
/**
 * 文件上传
 * @param array $file 上传文件的信息（是一个数组，有5个元素）
 * @param array $allow 文件上传的类型
 * @param string & $error 引用传递，用来记录错误信息
 * @param string $path 文件上传的路径
 * @param int $maxsize = 2*1024*1024 允许上传的文件的大小
 * @return false|$newname 如果上传失败就返回false，成功就返回新名字
 */
function upload($file,$allow,$path,& $error,$maxsize=2097152) {
	// 1, 判断系统错误
	switch($file['error']) {
		case 1 : $error = '上传错误，超出了文件限制的大小！';
				return false;
		case 2 : $error = '上传错误，超出了表单允许的大小！';
				return false;
		case 3 : $error = '上传错误，文件上传不完整！';
				return false;
		case 4 : $error = '请先选择要上传的文件！';
				return false;
		case 6 :
		case 7 : $error = '对不起，服务器繁忙，请稍后再试！';
				return false;
	}
	// 2, 判断逻辑错误
	// 2.1 判断文件大小
	if($file['size'] > $maxsize) {
		$error = '超出文件大小，允许的最大值为：' . $maxsize . '字节';
		return false;
	}
	// 2.2 判断文件类型
	if(!in_array($file['type'],$allow)) {
		// 文件类型非法
		$error = '上传的文件类型不正确，允许的类型有：'. implode(',',$allow);
		return false;
	}
	// 3,得到文件的新名字
	$newname = randName($file['name']);
	// 4,移动文件
	$target = $path . '/' . $newname;
	if(move_uploaded_file($file['tmp_name'], $target)) {
		// 移动成功
		return $newname;
	}else {
		// 移动失败
		$error = '发生未知错误，上传失败！';
		return false;
	}
}


/**
 * 生成一个随机名字的函数  文件名=当前时间 + 随机6位数字
 * @param string $filename 文件的旧名字
 * @return string $newname 文件的新名字
 */
function randName($filename) {
	// 生成文件名的时间部分
	$newname = date('YmdHis');
	// 加上随机的6位数
	$str = "0123456789";
	for($i=0;$i<6;$i++) {
		$newname .= $str[mt_rand(0,strlen($str) - 1)];
	}
	// 加上后缀名
	$newname .= strrchr($filename,'.');
	return $newname;
}
