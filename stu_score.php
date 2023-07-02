<meta charset="utf-8">
<form action="index.php?url=stu_score.php" method="post">
	<br/>请输入关键字:<input type="text" name="keyword" value="学号或姓名">
	<input type="submit" value="检索成绩"></p>	
</form>
<?php
	 include_once("database.php");
	 $con = get_connection( );
	 $sql = "select st.s_no, st.s_name, ch.c_no, co.c_name, ch.score " .
			"from students st left join choose ch on st.s_no=ch.s_no " . 
			"join course co on ch.c_no=co.c_no " ;
	if(isset($_SESSION["account_no"]))
		 	$sql = $sql." where st.s_no ='".$_SESSION['account_no']. "'";

	 // 检索关键字
	 if(isset($_POST["keyword"]) ){
		 $keyword = $_POST["keyword"];
	$sql = "select st.s_no, st.s_name, ch.c_no, co.c_name, ch.score " .
			"from students st left join choose ch on st.s_no=ch.s_no " . 
			"join course co on ch.c_no=co.c_no " ;

		 if(!empty($keyword) and $keyword != '学号或姓名' )
		 	{	$sql = $sql . " where st.s_no like '%$keyword%' or " .
							"st.s_name like '%$keyword%' " ;
			}
		 elseif(isset($_SESSION["account_no"]))
		 	$sql = $sql." where st.s_no ='".$_SESSION['account_no']. "'";

		
		}
	 $results = @$con->query($sql."order by st.s_no" ) or 
	 				die("执行'" . $sql . "'错误！");
	 $rows = @$results->num_rows;
	 if($rows==0)
	 	{	echo "暂无学生信息！";
			return;
	 	}
	 echo "<table border='1'> <tr> <th>学号</th> <th>姓名</th> " ,
			"<th>课号</th> <th>课程名</th> <th>成绩</th> </tr>" ;
	 while($row = @$results->fetch_array( ) ) //遍历结果集，类似于遍历游标
	  { echo "<tr>" ;
		echo "<td>$row[0]</td>" ;
		echo "<td>$row[1]</td>" ;
		echo "<td>$row[2]</td>" ;
		echo "<td>$row[3]</td>" ;
		echo "<td>$row[4]</td>" ;
		echo "</tr>" ;
	  }
	  echo "</table>";	 
	  close_connection($con);
?>
