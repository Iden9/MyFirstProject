<?php
include_once("permission.php");
include_once("database.php");
if(!is_student()){
	$message = "������ѧ����";
	header("Location:index.php?message=$message");
	return;
}else{
	$account_no = $_SESSION["account_no"];
	$link=get_connection();
	
	// ��ѯѧ��ѡ�޵Ŀγ̣�����choose, course��teacher��ѯ
	$sql = "select choose.course_no,course_name,teacher_name,teacher_contact, description ".
			"from choose join course on course.course_no=choose.course_no ".
			"join teacher on teacher.teacher_no=course.teacher_no ".
			"where student_no='$account_no'";

	$result_set = mysql_query($sql);
	$rows = mysql_num_rows($result_set);
	if($rows==0){
		$message = "����ʱû��ѡ�Σ�";
		header("Location:index.php?message=$message");
		return;
	}else{
		echo "<table><tr><th>�κ�</th><th>�γ���</th><th>�ον�ʦ</th><th>��ϵ��ʽ</th><th>����</th></tr>";
		while($course_student=mysql_fetch_array($result_set)){
			echo "<tr>";
			$course_no = $course_student["course_no"];
			$course_name = $course_student["course_name"];
			$description = $course_student["description"];
			echo "<td>".$course_no."</td>";
			echo "<td><a href='#' title=$description>".$course_name."</a></td>";
			echo "<td>".$course_student["teacher_name"]."</td>";
			echo "<td>".$course_student["teacher_contact"]."</td>";
			echo "<td><a href='index.php?url=quit_course.php&course_no=$course_no'>ȡ��ѡ�޸ÿγ�</a>";
			echo "</tr>";
		}
	}
	close_connection($link);
}	
?>
