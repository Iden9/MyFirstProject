<?php
session_start();
include_once("database.php");
$account_no = $_POST["account_no"];// ��ȡ���е��˺���Ϣ
$password = $_POST["password"]; // ��ȡ���е�������Ϣ
$role = $_POST["role"];			// ��ȡ���еĽ�ɫ��Ϣ
$conn = get_connection();		// PHP��������MySQL������
// ����select��䣬���ս�ɫ�Ĳ�ͬ��ѯ�ı�ͬ
$sql = "select * from $role where {$role}_no='$account_no' and password=md5('$password')";
// �ύselect��䣬��select���Ľ������ֵ��$result_set����
$result_set = mysql_query($sql);
$rows = mysql_num_rows($result_set);//�鿴��ѯ�����������
if($rows==0){
	//��¼ʧ�ܣ���ҳ���ض�����ҳ�������ݵ�¼ʧ�ܵ���Ϣ
	header("Location:index.php?message=�˺š���������");
}else{
	// �Ӳ�ѯ�������ȡ����һ�м�¼
	$account = mysql_fetch_array($result_set);
	// ����ɫ���˺š��˺�������Ϣ����session�Ự��
	$_SESSION["role"] = $role;
	$_SESSION["account_no"] = $account[0];
	$_SESSION["account_name"] = $account[2];
	// ��¼�ɹ�����ҳ���ض�����ҳ�������ݵ�¼�ɹ�����Ϣ
	header("Location:index.php?message=��¼�ɹ���");
}
close_connection($conn);//�ر�MySQL���������ӣ���PHP���벻�Ǳ���ģ�
?>
