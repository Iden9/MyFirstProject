<?php
	if(is_teacher()){//Ϊ��ʦ�ṩ�Ĺ���
?>
	<a href="index.php?url=course_list.php">���ͨ����˵Ŀγ�</a>
	<a href="index.php?url=teacher_course_list.php">����Լ��걨�Ŀγ�</a>
	<a href="index.php?url=add_course.php">�걨�γ�</a>
	<a href="index.php?url=logout.php">ע��</a>
<?php
	echo "��ӭ������ʦ��".$_SESSION["account_name"]."��<br/>";
}elseif(is_student()){//Ϊѧ���ṩ�Ĺ���
?>
	<a href="index.php?url=course_list.php">���ͨ����˵Ŀγ�</a>
	<a href="index.php?url=student_course_list.php">�鿴�Լ�ѡ�޵Ŀγ�</a>
	<a href="index.php?url=logout.php">ע��</a>
<?php
	echo "��ӭ����ѧ����".$_SESSION["account_name"]."��<br/>";
}elseif(is_admin()){//Ϊ����Ա�ṩ�Ĺ���
?>
	<a href="index.php?url=course_list.php">������пγ�</a>
	<a href="index.php?url=add_class.php">��Ӱ༶</a>
	<a href="index.php?url=less_course_list.php">���ѡ����������30�˵Ŀγ�</a>
	<a href="index.php?url=reset_password.php">���ý�ʦ����ѧ��������</a>
	<a href="index.php?url=logout.php">ע��</a>
<?php
	echo "��ӭ����".$_SESSION["account_name"]."��<br/>";
}else{//Ϊ�ο��ṩ�Ĺ���
?>
	<a href="index.php?url=course_list.php">����γ�</a>
<?php
	//	<a href="index.php?url=add_student.php">ѧ��ע��</a> </-->
	//	<a href="index.php?url=add_teacher.php">��ʦע��</a> 
?>
	<a href="index.php?url=login.php">��¼</a>
<?php
	echo "����������οͣ�<br/>";
}
?>