<?php

# 项目初始化文件
// 1,定义文件编码(设置响应头信息)
header('Content-Type:text/html;Charset=utf-8');

// 2,定义目录常量
// 定义根目录常量
define('DIR_ROOT',str_replace('\\','/',__DIR__) . '/');

// 定义model目录常量
define('DIR_MODEL',DIR_ROOT . 'model/');
// 定义view目录常量
define('DIR_VIEW',DIR_ROOT . 'view/');
// 定义controller目录常量
define('DIR_CON',DIR_ROOT . 'controller/');
// 定义config目录常量
define('DIR_CONFIG',DIR_ROOT . 'config/');
// 定义core文件目录
define('DIR_CORE',DIR_ROOT . 'core/');
// 定义public目录常量
define('DIR_PUBLIC','/public'); //这里的/代表根目录
