<form action="process_login.php" method="post">
账号：<input type="text" name="account_no"/><br/>
密码：<input type="password" name="password"/><br/>
角色：<select name="role" size="3">
<option value="student" selected>学生</option>
<option value="teacher">教师</option>
<option value="admin">管理员</option>
</select>
<br/>
<input type="submit" value="登录"/>
<input type="reset" value="重填"/>
</form>
