<?php
include_once("database.php");
include_once("permission.php");
if(!is_student()){
	$message = "����Ȩѡ�޿γ̣�<br/>";
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
			$message = "���Ѿ�ѡ�޹����ſγ̣�";
		} else {
			$sql = "insert into choose values(null,$account_no,$course_no,null,now())";
			$result = mysql_query($sql);
			$sql = "update course set available = available - 1 where course_no='$course_no'";
			$result = mysql_query($sql);
			if ($result) {
				$message = "���Ѿ��ɹ���ѡ�������ſγ̣�";
			} else {
				die('Invalid query: ' . mysql_error());
			}
		}
	}
	
	close_connection($conn);
	
	header("Location:index.php?message=$message");
}
?>
