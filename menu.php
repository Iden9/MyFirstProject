<?php
	if(is_teacher()){//为教师提供的功能
?>
	<a href="index.php?url=course_list.php">浏览通过审核的课程</a>
	<a href="index.php?url=teacher_course_list.php">浏览自己申报的课程</a>
	<a href="index.php?url=add_course.php">申报课程</a>
	<a href="index.php?url=logout.php">注销</a>
<?php
	echo "欢迎您，教师：".$_SESSION["account_name"]."！<br/>";
}elseif(is_student()){//为学生提供的功能
?>
	<a href="index.php?url=course_list.php">浏览通过审核的课程</a>
	<a href="index.php?url=student_course_list.php">查看自己选修的课程</a>
	<a href="index.php?url=logout.php">注销</a>
<?php
	echo "欢迎您，学生：".$_SESSION["account_name"]."！<br/>";
}elseif(is_admin()){//为管理员提供的功能
?>
	<a href="index.php?url=course_list.php">浏览所有课程</a>
	<a href="index.php?url=add_class.php">添加班级</a>
	<a href="index.php?url=less_course_list.php">浏览选课人数少于30人的课程</a>
	<a href="index.php?url=reset_password.php">重置教师或者学生的密码</a>
	<a href="index.php?url=logout.php">注销</a>
<?php
	echo "欢迎您，".$_SESSION["account_name"]."！<br/>";
}else{//为游客提供的功能
?>
	<a href="index.php?url=course_list.php">浏览课程</a>
<?php
	//	<a href="index.php?url=add_student.php">学生注册</a> </-->
	//	<a href="index.php?url=add_teacher.php">教师注册</a> 
?>
	<a href="index.php?url=login.php">登录</a>
<?php
	echo "您的身份是游客！<br/>";
}
?>