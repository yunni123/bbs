
-- 创建数据库
create database bbs;

-- 选择默认的数据库
use bbs;

-- 创建用户表
create table user(
	user_id int unsigned primary key auto_increment comment '主键ID',
	user_name varchar(20) not null unique key comment '用户名',
	user_password char(32) not null comment '用户密码'
)engine InnoDB default charset utf8;


-- 创建帖子表
create table publish(
	pub_id int unsigned primary key auto_increment comment '主键ID',
	pub_title varchar(50) not null comment '帖子标题',
	pub_content text not null comment '帖子内容',
	pub_owner varchar(20) not null comment '楼主(发帖者)',
	pub_time int not null comment '发帖的时间',
	pub_hits int unsigned not null default 0 comment '浏览次数'
)engine InnoDB default charset utf8;

-- 创建回帖表
create table reply(
	rep_id int unsigned primary key auto_increment comment '主键ID',
	rep_pub_id int unsigned not null comment '楼主的帖子的ID',
	rep_user varchar(20) not null comment '回复者的姓名',
	rep_content text not null comment '回复内容',
	rep_time int not null comment '回帖的时间'
)engine InnoDB default charset utf8;

alter table reply add rep_flag tinyint(4) not null default 0;  --判断是否为引用层或直接回复层
alter table reply add rep_flag_num int unsigned ;  --引用回复的编号
alter table reply add rep_flag_user varchar(20) ;  --引用回复的用户名
alter table reply add rep_flag_content text ;      --引用回复的内容
alter table user add user_image varchar(100) not null default 'default.jpg';
