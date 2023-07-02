<?php
include_once("database.php");
include_once("permission.php");
if(!is_student()){
	$message = "您无权选修课程！<br/>";
	header("Location:index.php?message=$message");	
	return;
}else{
	$account_no = $_SESSION["account_no"];
	$course_no = $_GET["course_no"];
	$conn = get_connection();

	$sql = "select * from choose where student_no='$account_no' and course_no='$course_no'";
	$result = mysql_query($sql);
	if (!$result) {
		die('Invalid query: ' . mysql_error());
	} else {
		if (mysql_num_rows($result) > 0) {
			$message = "您已经选修过这门课程！";
		} else {
			$sql = "insert into choose values(null,$account_no,$course_no,null,now())";
			$result = mysql_query($sql);
			$sql = "update course set available = available - 1 where course_no='$course_no'";
			$result = mysql_query($sql);
			if ($result) {
				$message = "您已经成功地选修了这门课程！";
			} else {
				die('Invalid query: ' . mysql_error());
			}
		}
	}
	
	close_connection($conn);
	
	header("Location:index.php?message=$message");
}
?>
