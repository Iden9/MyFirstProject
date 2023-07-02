<?php
include_once("permission.php");
include_once("database.php");
if(is_student() || is_teacher()){
	$link=get_connection();
	$course_no = $_GET["course_no"];
	if(isset($_GET["student_no"])){//老师取消学生的选课
		$student_no = $_GET["student_no"];
		//获取教师的工号
		$teacher_no = $_SESSION["account_no"];
		//判断该教师是否任教这门课程
		$select_sql = "select course_no from course where course_no=$course_no and teacher_no='$teacher_no'"; 
		$result_set = mysql_query($select_sql);
		if(mysql_num_rows($result_set)==0){
			$message = "您不是任课教师！";
			header("Location:index.php?message=$message");
			return;	// 这里的return很重要，不可或缺
		}
	}else{//学生取消自己的选课
		$student_no = $_SESSION["account_no"];
	}
	$sql = "delete from choose where student_no=$student_no and course_no=$course_no";
	mysql_query($sql);
	$affected_rows = mysql_affected_rows();
	$sql = "update course set available=available + 1 where course_no=$course_no";
	mysql_query($sql);
	
	close_connection($link);
	if($affected_rows>0){
		$message = "成功退选该课程！";
	}else{
		$message = "退选该课程失败！";
	}
	header("Location:index.php?message=$message");
}else{
	$message = "您不是学生或者任课教师！";
	header("Location:index.php?message=$message");
}
?>
