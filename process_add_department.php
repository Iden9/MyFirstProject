<meta charset="utf-8">
<?php
	include_once("database.php");
	$con = get_connection( );
	$d_no = $_POST["d_no"];
	$d_no = trim($d_no);	
	$d_name = $_POST["d_name"];
	$d_name = trim($d_name);
	if(empty($d_name) or empty($d_no) )
		{ 	$msg="<br/>院系编号：$d_no <br/>院系名称：$d_name<br/>" .
				"<p><b> 因院系编号或名称为空，添加失败！ </b></p>";
			header("Location:index.php?message=$msg");
			return;
		}	 			
	else 
		{	 $sql = "select * from department where" 
			 		. " d_name='$d_name'" ;
			 if(!empty($d_no) )
			 	$sql = $sql . " or d_no='$d_no'";  
			 $result=$con->query($sql) or 
			 			die("数据库查询失败！" . $con->error( ) );
			 if( $result->num_rows > 0)
			  	{$msg="<p>院系编号：$d_no <br/>院系名称：$d_name<br/>"
				 . "<p><b> 因院系编号或名称已经存在，添加失败！" 
				 . "</b></p>";
	  			}
		 	else
				{$sql = "insert into department "
				 		. " values('$d_no','$d_name');";
				 $result=$con->query($sql) or 
			 			die("数据库查询失败！" . $con->error( ) );
				 $msg="<br/>院系编号：$d_no <br/>院系名称：$d_name<br/>"
				 		. "<p><b> 院系添加成功！ </b></p>";
				}
		}
	header("Location:index.php?message=$msg");	
?>