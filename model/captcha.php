<?php 
//创建画布
$img=imagecreatetruecolor(170,40);
//创建背景颜色
$bgcolor=imagecolorallocate ($img,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255));
//填充背景颜色
imagefill($img, 0, 0, $bgcolor);

//产生随机验证码
$arr=array_merge(range('a', 'z'),range('A','Z'),range(0,9));
shuffle($arr);
$rand_key=array_rand($arr,4);
$str='';
 foreach ($rand_key as $value) {
 	$str.=$arr[$value];	
 }
 //开启session将产生的验证码存进去
 session_start();
 $_SESSION['captcha']=$str;

 $span = ceil(170/(4+1)); // 注意除以字符的个数加1
    for($i=1;$i<=4;$i++) {
    $stringcolor=imagecolorallocate($img, mt_rand(0,150),mt_rand(0,150), mt_rand(0,150));
    imagestring($img, 5, $i*$span, 12, $str[$i-1],$stringcolor);
    }
  // 添加干扰线（直线）
// imageline(img,x1,y1,x2,y2,color);
for($i=1;$i<=6;$i++) {
	// 创建干扰线颜色
	$linecolor = imagecolorallocate($img,mt_rand(120,200),mt_rand(120,200),mt_rand(0,200));
	//干扰线的坐标随机的起始点,注意
	imageline($img,mt_rand(0,169),mt_rand(0,29),mt_rand(0,169),mt_rand(0,29),$linecolor);
}
header('Content-type:image/png');
ob_clean();
imagepng($img);
