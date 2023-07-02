<?php
session_start();
include_once("database.php");
$account_no = $_POST["account_no"];// 获取表单中的账号信息
$password = $_POST["password"]; // 获取表单中的密码信息
$role = $_POST["role"];			// 获取表单中的角色信息
$conn = get_connection();		// PHP程序连接MySQL服务器
// 构造select语句，按照角色的不同查询的表不同
$sql = "select * from $role where {$role}_no='$account_no' and password=md5('$password')";
// 提交select语句，将select语句的结果集赋值给$result_set变量
$result_set = mysql_query($sql);
$rows = mysql_num_rows($result_set);//查看查询结果集的行数
if($rows==0){
	//登录失败，将页面重定向到首页，并传递登录失败的消息
	header("Location:index.php?message=账号、密码有误！");
}else{
	// 从查询结果集中取出第一行记录
	$account = mysql_fetch_array($result_set);
	// 将角色、账号、账号名等信息放入session会话中
	$_SESSION["role"] = $role;
	$_SESSION["account_no"] = $account[0];
	$_SESSION["account_name"] = $account[2];
	// 登录成功，将页面重定向到首页，并传递登录成功的消息
	header("Location:index.php?message=登录成功！");
}
close_connection($conn);//关闭MySQL服务器连接（该PHP代码不是必须的）
?>
