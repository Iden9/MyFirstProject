<form action="index.php?url=course_list.php" method="post">
请输入关键字:<input type="text" name="keyword">
<input type="submit" value="检索"></form>
<?php
include_once("permission.php");
include_once("database.php");
$conn = get_connection();
// 检索关键字
if(!empty($_POST["keyword"])){
	$keyword = $_POST["keyword"];
}
if(!is_login() || is_student() || is_teacher()){
	//假如是游客、学生、教师，则显示已经审核的课程信息
	$sql = "select course_no,course_name,up_limit, description, teacher.teacher_no,teacher_name,teacher_contact,status ".
		"from course join teacher on course.teacher_no=teacher.teacher_no where status='已审核'";
	if(!empty($keyword)){//构造检索的select语句
		$sql = $sql." and course_name like '%$keyword%' or description like '%$keyword%'";
	}
}else if(is_admin()){
	//假如是管理员，则显示所有课程信息
	$sql = "select * from course";
	if(!empty($keyword)){//构造检索的select语句
		$sql = $sql." and course_name like '%$keyword%' or description like '%$keyword%'";
	}
}
$result_set = mysql_query($sql, $conn);
$rows = @mysql_num_rows($result_set);
if($rows==0){
	echo "暂无课程记录！";
	return;
}
echo "<table><tr><th>课号</th><th>课程名</th><th>人数上限</th><th>任课教师</th><th>联系方式</th><th>可选人数</th><th>课程状态</th><th>操作</th></tr>";
while($row=mysql_fetch_array($result_set)){//遍历结果集，类似于遍历游标
	echo "<tr>";
	$course_no = $row["course_no"];
	echo "<td>$course_no</td>";
	echo "<td><a href='#' title=$row[description]>$row[course_name]</a></td>";
	echo "<td>$row[up_limit]</td><td>$row[teacher_name]</td>";
	echo "<td>$row[teacher_contact]</td><td>$row[status]</td>";
	if(is_admin()){
		if($row["status"]=="未审核"){
			echo "<td bgcolor='#F0F0F0'><a href=index.php?url=check_course.php&course_no=$course_no>通过审核</a> <a href=index.php?url=delete_course.php&course_no=$course_no>删除该课程</a></td>";
		}else{
			echo "<td><a href=index.php?url=quit_check_course.php&course_no=$course_no>取消审核</a> <a href=index.php?url=course_student_list.php&course_no=$course_no>查看学生信息</a></td>";
		}
	}elseif(is_student()){
		$account_no = $_SESSION["account_no"];
		echo "<td><a href='index.php?url=choose_course.php&course_no=$course_no'>选修该课程</a></td>";
	}else{
		echo "<td>暂时无法操作</td>";
	}	
	echo "</tr>";
}
close_connection($conn);
?>
