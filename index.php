<?php
session_start();//开启一个会话或者使用同一个会话（重要）
include_once("permission.php"); // 引用检查权限的函数
include_once("menu.php");		// 引用显示菜单的代码
?>
<hr>
<?php
if(isset($_GET["message"])){	// 显示处理结果
	echo "<font color='red'>".$_GET["message"]."</font>";
}
if(isset($_GET["url"])){		// 显示请求的页面
	include_once($_GET["url"]);
}else{							// 默认显示课程列表页面
	include_once("course_list.php");
}
?>
