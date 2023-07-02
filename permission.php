<?php
function is_login(){//判断用户是否登录
	if(empty($_SESSION["role"])){
		return false;
	}else{
		return true;
	}
}
function is_student(){//判断登录用户是否是学生
	if(is_login() && $_SESSION["role"]=="student"){
		return true;
	}else{
		return false;
	}
}
function is_teacher(){//判断登录用户是否是教师
	if(is_login() && $_SESSION["role"]=="teacher"){
		return true;
	}else{
		return false;
	}
}
function is_admin(){//判断登录用户是否是管理员
	if(is_login() && $_SESSION["role"]=="admin"){
		return true;
	}else{
		return false;
	}
}
?>
