<meta charset="utf-8">
<form action="index.php?url=calc_score.php" method="post">
	<br/>请输入关键字:<input type="text" name="keyword" value="学号或姓名">
	<input type="submit" value="检索">	
</form>
<?php
	 include_once("database.php");
	 $con = get_connection( );
	 $sql = "select st.s_no, st.s_name, max(ch.score) 最高分," .
			"min(ch.score) 最低分,avg(ch.score) 平均分,count(*) 选课门数 " .
			"from students st left join choose ch on st.s_no=ch.s_no " . 
			"group by st.s_no " ;
	if(isset($_SESSION["account_no"]))
					 $sql=$sql." having st.s_no= '".$_SESSION["account_no"]."'" ;

		 // 检索关键字
		 if(isset($_POST["keyword"])){
			 $keyword = $_POST["keyword"];
		$sql = "select st.s_no, st.s_name, max(ch.score) 最高分," .
			"min(ch.score) 最低分,avg(ch.score) 平均分,count(*) 选课门数 " .
			"from students st left join choose ch on st.s_no=ch.s_no " . 
			"group by st.s_no " ;

		 if(!empty($keyword) and $keyword != '学号或姓名' )
		 	{	$sql = $sql . " having st.s_no like '%$keyword%' or " .
							"st.s_name like '%$keyword%' " ;
			}
		 elseif(isset($_SESSION["account_no"]))
				 $sql=$sql." having st.s_no= '".$_SESSION["account_no"]."'" ;
  		}
	 $results = @$con->query($sql."order by st.s_no" ) or 
	 				die("执行'" . $sql . "'错误！"); 
	 $rows = @$results->num_rows;
	 if($rows==0)
	 	{	echo "暂无统计信息！";
			return;
	 	}
	 echo "<table border='1'>",
	 		"<tr><th>学号</th> <th>姓名</th> <th>最高分</th>" ,
			" <th>最低分</th> <th>平均分</th> <th>选课门数</th> </tr>" ;
	 while($row = @$results->fetch_array( ) ) //遍历结果集，类似于遍历游标
	  { echo "<tr>" ;
		echo "<td>$row[0]  </td>" ;
		echo "<td>$row[1]  </td>" ;
		echo "<td>$row[2]  </td>" ;
		echo "<td>$row[3]  </td>" ;
		echo "<td>$row[4]  </td>" ;
		echo "<td>$row[5]  </td>" ;		
		echo "</tr>" ;
	  }
	  echo "</table>";
	  close_connection($con);
?>
