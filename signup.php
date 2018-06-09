<html>
<head>
<title>User Registration</title>
</head>
<body>
<p><h2><font face=Consolas>User Registration</font></h2></p>
<form action="action_signup.php" method="POST">
	<table>
	<tr>
	<td>Name :</td>
	<td><input type="text" name="username" value=""></td>	
	</tr>
	
	<tr>
	<td>E-Mail :</td>
	<td><input type="text" name="user_mail" value=""></td>	
	</tr>

	<tr>
	<td>Gender :</td>
	<td><input type="text" name="user_g" value=""></td>	
	</tr>

	<tr>
	<td>Age :</td>
	<td><input type="text" name="user_age" value=""></td>	
	</tr>

	<tr>
	<td>Password :</td>
	<td><input type="password" name="pwd" value=""></td>	
	</tr>

	<tr>
	<td>Re-enter Password :</td>
	<td><input type="password" name="r_pwd" value=""></td>	
	</tr>

	<tr><td>
	<input type="submit" name="submit" value="Create User">
	</td></tr>
	</table>
</form>
</body>
</html>