<form action="index.php?url=course_list.php" method="post">
������ؼ���:<input type="text" name="keyword">
<input type="submit" value="����"></form>
<?php
include_once("permission.php");
include_once("database.php");
$conn = get_connection();
// �����ؼ���
if(!empty($_POST["keyword"])){
	$keyword = $_POST["keyword"];
}
if(!is_login() || is_student() || is_teacher()){
	//�������ο͡�ѧ������ʦ������ʾ�Ѿ���˵Ŀγ���Ϣ
	$sql = "select course_no,course_name,up_limit, description, teacher.teacher_no,teacher_name,teacher_contact,status ".
		"from course join teacher on course.teacher_no=teacher.teacher_no where status='�����'";
	if(!empty($keyword)){//���������select���
		$sql = $sql." and course_name like '%$keyword%' or description like '%$keyword%'";
	}
}else if(is_admin()){
	//�����ǹ���Ա������ʾ���пγ���Ϣ
	$sql = "select * from course";
	if(!empty($keyword)){//���������select���
		$sql = $sql." and course_name like '%$keyword%' or description like '%$keyword%'";
	}
}
$result_set = mysql_query($sql, $conn);
$rows = @mysql_num_rows($result_set);
if($rows==0){
	echo "���޿γ̼�¼��";
	return;
}
echo "<table><tr><th>�κ�</th><th>�γ���</th><th>��������</th><th>�ον�ʦ</th><th>��ϵ��ʽ</th><th>��ѡ����</th><th>�γ�״̬</th><th>����</th></tr>";
while($row=mysql_fetch_array($result_set)){//����������������ڱ����α�
	echo "<tr>";
	$course_no = $row["course_no"];
	echo "<td>$course_no</td>";
	echo "<td><a href='#' title=$row[description]>$row[course_name]</a></td>";
	echo "<td>$row[up_limit]</td><td>$row[teacher_name]</td>";
	echo "<td>$row[teacher_contact]</td><td>$row[status]</td>";
	if(is_admin()){
		if($row["status"]=="δ���"){
			echo "<td bgcolor='#F0F0F0'><a href=index.php?url=check_course.php&course_no=$course_no>ͨ�����</a> <a href=index.php?url=delete_course.php&course_no=$course_no>ɾ���ÿγ�</a></td>";
		}else{
			echo "<td><a href=index.php?url=quit_check_course.php&course_no=$course_no>ȡ�����</a> <a href=index.php?url=course_student_list.php&course_no=$course_no>�鿴ѧ����Ϣ</a></td>";
		}
	}elseif(is_student()){
		$account_no = $_SESSION["account_no"];
		echo "<td><a href='index.php?url=choose_course.php&course_no=$course_no'>ѡ�޸ÿγ�</a></td>";
	}else{
		echo "<td>��ʱ�޷�����</td>";
	}	
	echo "</tr>";
}
close_connection($conn);
?>
