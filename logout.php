<?php
session_unset();//删除WEB服务器内存的SESSION信息以及SESSION文件中的SESSION信息
session_destroy();//删除WEB服务器的SESSION文件
header("Location:index.php?message=注销成功！");//将页面重定向到首页
?>
