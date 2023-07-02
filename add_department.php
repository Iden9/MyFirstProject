<html>
	<head><title>添加院系</title></head>
	<body>
	<h2>添加院系信息</h2>
	<form action="process_add_department.php" method="post">
		<p>院系编号：<input type="text" name="d_no" 
			value="1"> *不能为空</p>
		<p>院系名称：<input type="text" name="d_name" 
			value="机电学院"> *不能为空</p><br/>
		<input type="submit" value="添加">	
		<input type="reset" value="重填">
	</form>
	</body>
</html>