<?php
include_once("permission.php");
include_once("database.php");
if(is_student() || is_teacher()){
	$link=get_connection();
	$course_no = $_GET["course_no"];
	if(isset($_GET["student_no"])){//��ʦȡ��ѧ����ѡ��
		$student_no = $_GET["student_no"];
		//��ȡ��ʦ�Ĺ���
		$teacher_no = $_SESSION["account_no"];
		//�жϸý�ʦ�Ƿ��ν����ſγ�
		$select_sql = "select course_no from course where course_no=$course_no and teacher_no='$teacher_no'"; 
		$result_set = mysql_query($select_sql);
		if(mysql_num_rows($result_set)==0){
			$message = "�������ον�ʦ��";
			header("Location:index.php?message=$message");
			return;	// �����return����Ҫ�����ɻ�ȱ
		}
	}else{//ѧ��ȡ���Լ���ѡ��
		$student_no = $_SESSION["account_no"];
	}
	$sql = "delete from choose where student_no=$student_no and course_no=$course_no";
	mysql_query($sql);
	$affected_rows = mysql_affected_rows();
	$sql = "update course set available=available + 1 where course_no=$course_no";
	mysql_query($sql);
	
	close_connection($link);
	if($affected_rows>0){
		$message = "�ɹ���ѡ�ÿγ̣�";
	}else{
		$message = "��ѡ�ÿγ�ʧ�ܣ�";
	}
	header("Location:index.php?message=$message");
}else{
	$message = "������ѧ�������ον�ʦ��";
	header("Location:index.php?message=$message");
}
?>
