/*set character_set_server=gbk;
set character_set_database=gbk;
SET NAMES gbk; 
<==>
set character_set_client=gbk;
set character_set_result=gbk;
set character_set_connection=gbk;
*/


#先创建“学生选课”数据库：xsxk
create database if not exists xsxk;
#选定“xsxk”为当前数据库
use xsxk;


#院系表department是教师表teacher和学生表students的父表，先创建父表
create table department(
d_no varchar(5) primary key COMMENT '院系编号',
d_name varchar(10) COMMENT '院系名称'
)engine=InnoDB default charset=gbk;


#创建子表students之前，必须先创建父表department
create table students(
s_no char(12) primary key COMMENT '学生学号',
s_name varchar(4) not null COMMENT '学生姓名',
gender enum('男','女') not null default '男'  COMMENT '学生性别',
d_no varchar(5) not null  COMMENT '学生院系',
birthday date not null  COMMENT '学生生日',
phone varchar(12) not null  COMMENT '学生电话',
address varchar(20) not null COMMENT '学生家庭住址',
constraint d_s_fk foreign key (d_no) references department(d_no)
)engine=InnoDB default charset=gbk;


#创建子表teacher之前，必须先创建父表department
create table teacher(
t_no char(4) primary key  COMMENT '教师工号',
t_name varchar(4) not null COMMENT '教师姓名',
d_no varchar(5) COMMENT '教师所属院系',
constraint d_t_fk foreign key(d_no) references department(d_no)
)engine=InnoDB default charset=gbk;


#创建子表course之前，必须先创建父表teacher
create table course(
c_no char(4) primary key COMMENT '课程编号',
c_name varchar(10) not null COMMENT '课程名',
period tinyint(2) default 40 COMMENT '学时数',
credit tinyint(2) default 2 not null COMMENT '学分',
c_type char(3) default '必修' not null  COMMENT '课程类型',
t_no char(4) not null COMMENT '任课教师编号',
constraint t_c_fk foreign key(t_no) references teacher(t_no)
)engine=InnoDB default charset=gbk;


#创建子表choose之前，必须先创建父表course、students
create table choose(
id int auto_increment primary key COMMENT '选课号',
s_no char(12) not null COMMENT '学号',
c_no char(4) not null COMMENT '课程号',
score tinyint(3) unsigned COMMENT '成绩',
constraint s_c_fk foreign key(s_no) references students(s_no),
constraint c_c_fk foreign key(c_no) references course(c_no)
)engine=InnoDB default charset=gbk;


/*
以下命令分别向5个表中插入测试数据：
因为5个表中存在外键约束，插入数据时必须：
先插入父表的数据，然后才插入子表数据，所以在表中插入数据的顺序如下：
院系表department —> 
—> 教师表teacher、学生表students—> 
—> 课程表course —> 选课表choose
*/
insert into department(d_no,d_name)
values ('计算机系','信自学院') ,
('会计系','管理学院') ,
('经济系','管理学院') ,
('英语系','外文学院') ,
('工商管理系','管理学院') ,
('数学系','理学院') ;


insert into teacher(t_no,t_name,d_no)
values ('2001','张华','计算机系') ,
('2002','王明','会计系') ,
('2003','李萍','经济系') ,
('2004','田野','英语系') ,
('2005','赵瑾','工商管理系') ,
('2006','胡一民','数学系') ;


insert into students(s_no,s_name, gender,d_no,birthday,phone,address)
values ('201510101101','刘晓东','男','计算机系','1999-5-10','11000000001','昆明') ,
('201510101102','林慧','女','计算机系','1999-12-15','11000000002','上海') ,
('201511101103','李远鹏','男','会计系','1998-10-25','11000000003','北京') ,
('201511101104','吴娜文','女','会计系','1999-8-10','11000000004','昆明') ,
('201512101105','刘智','男','经济系','1999-5-8','11000000005','北京') ,
('201512101106','赵立民','男','经济系','1999-2-25','11000000006','上海') ,
('201513101111','张亮亮','男','英语系','1998-9-5','11000000007','上海') ,
('201513101116','王丽萍','女','工商管理系','1998-6-3','11000000008','重庆') ;


insert into course(c_no,c_name,period,credit,c_type,t_no)
values ('1001','高等数学',90,6,'必修','2006') ,
('1002','英语',90,6,'必修','2004') ,
('1003','计算机基础',70,4.5,'必修','2001') ,
('1004','数据库应用',60,4,'必修','2001') ,
('1005','会计学',100,6.5,'必修','2002') ,
('1006','经济学',80,5,'必修','2003') ,
('2001','网页设计',32,1,'选修','2001') ;


insert into choose(id, s_no, c_no, score)
values (1,'201510101101','1001',50) ,
(2,'201510101101','1002',55) ,
(3,'201510101102','1001',60) ,
(4,'201510101102','1002',65) ,
(5,'201511101103','1001',67) ,
(6,'201511101103','1005',70) ,
(7,'201511101104','1001',80) ,
(8,'201511101104','1005',78) ,
(9,'201512101105','1001',75) ,
(10,'201512101105','1006',82) ,
(11,'201512101106','1006',90) ,
(12,'201513101111','1004',null) ,
(13,'201513101116','2001',null) ;

