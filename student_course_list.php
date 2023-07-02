<?php
include_once("permission.php");
include_once("database.php");
if(!is_student()){
	$message = "您不是学生！";
	header("Location:index.php?message=$message");
	return;
}else{
	$account_no = $_SESSION["account_no"];
	$link=get_connection();
	
	// 查询学生选修的课程，连接choose, course和teacher查询
	$sql = "select choose.course_no,course_name,teacher_name,teacher_contact, description ".
			"from choose join course on course.course_no=choose.course_no ".
			"join teacher on teacher.teacher_no=course.teacher_no ".
			"where student_no='$account_no'";

	$result_set = mysql_query($sql);
	$rows = mysql_num_rows($result_set);
	if($rows==0){
		$message = "您暂时没有选课！";
		header("Location:index.php?message=$message");
		return;
	}else{
		echo "<table><tr><th>课号</th><th>课程名</th><th>任课教师</th><th>联系方式</th><th>操作</th></tr>";
		while($course_student=mysql_fetch_array($result_set)){
			echo "<tr>";
			$course_no = $course_student["course_no"];
			$course_name = $course_student["course_name"];
			$description = $course_student["description"];
			echo "<td>".$course_no."</td>";
			echo "<td><a href='#' title=$description>".$course_name."</a></td>";
			echo "<td>".$course_student["teacher_name"]."</td>";
			echo "<td>".$course_student["teacher_contact"]."</td>";
			echo "<td><a href='index.php?url=quit_course.php&course_no=$course_no'>取消选修该课程</a>";
			echo "</tr>";
		}
	}
	close_connection($link);
}	
?>
