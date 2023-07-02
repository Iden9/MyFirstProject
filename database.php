<?php 
function get_connection(){
	$hostname = "localhost"; //数据库服务器主机名,可以用IP代替
	$username = "root"; 	//MySQL账户名
	$password = ""; 	//root账号的密码
	$database = "choose"; 	//数据库名
	$connection = @mysql_connect($hostname, $username, $password)
		or die('Could not connect: ' . mysql_error()); //连接数据库服务器
	mysql_query("set names 'gbk'", $connection);//设置字符集
	@mysql_select_db($database, $connection) or die('Could not select database.');
	return $connection;
}
function close_connection($connection){
	mysql_close($connection);		// 关闭数据库服务器连接
}
?>
