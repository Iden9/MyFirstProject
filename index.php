<?php
session_start();//����һ���Ự����ʹ��ͬһ���Ự����Ҫ��
include_once("permission.php"); // ���ü��Ȩ�޵ĺ���
include_once("menu.php");		// ������ʾ�˵��Ĵ���
?>
<hr>
<?php
if(isset($_GET["message"])){	// ��ʾ������
	echo "<font color='red'>".$_GET["message"]."</font>";
}
if(isset($_GET["url"])){		// ��ʾ�����ҳ��
	include_once($_GET["url"]);
}else{							// Ĭ����ʾ�γ��б�ҳ��
	include_once("course_list.php");
}
?>
