<?php 
function get_connection(){
	$hostname = "localhost"; //���ݿ������������,������IP����
	$username = "root"; 	//MySQL�˻���
	$password = ""; 	//root�˺ŵ�����
	$database = "choose"; 	//���ݿ���
	$connection = @mysql_connect($hostname, $username, $password)
		or die('Could not connect: ' . mysql_error()); //�������ݿ������
	mysql_query("set names 'gbk'", $connection);//�����ַ���
	@mysql_select_db($database, $connection) or die('Could not select database.');
	return $connection;
}
function close_connection($connection){
	mysql_close($connection);		// �ر����ݿ����������
}
?>
