<?php
	session_start();

	$connect = mysqli_connect("localhost","root","","soc");
	$id = $_SESSION["id"];
	//echo $id;
	$result = mysqli_query($connect,"select * from users where ID=$id ");
	$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
	//echo $row['Username'];

?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<?php  echo "<title>" . $row['FullName'] . ": Homepage </title>"  ?>
</head>
<body>

	<div style="width: 100%; background-color: #f2f2f2; border-radius: 8px; top: 0px; position: sticky;">
		<table style="width: 100%;">
			<tr>
				<td style="width: 50%; text-align: left; padding-left: 10px;"><h2>
					<?php echo $row['FullName']; ?></h2>
				</td>
				<td style="width: 50%; text-align: right; padding-right: 10px;">
				<div style="width: 60%; background-color: #f2f2f2; float: right;">
					<form method="post" action="search.php">
					<input type="text" name="search" placeholder="Search..." style="width: 90%;">
					<button type="submit" style="height: 30px; border-radius: 30%; border-width: 0px; background-color: #ccc;"><i class="fa fa-search"></i></button></form>
				</div>

				</td>
			</tr>
		</table>
	</div>
<table style="width: 100%;">
<tr style="height: 20px;"><td>
</td></tr>
<tr><td>
	
	<div style="">
		<div style="width: 78%; border-radius: 8px; float: right; background-color: #f2f2f2; overflow: auto; ">
				
				<center><div id="p21" align="left">
					<form onsubmit="return pwd()" method="post" action="change.php">
						
						<label>Old Password</label><p></p>
						<input type="password" name="old" id="old"><p></p>
						<label>New Password</label><p></p>
						<input type="password" name="new1" id="new1"><p></p>
						<label>Confirm New Password</label><p></p>
						<input type="password" name="new2" id="new2"><p></p>
						<input type="submit" name="submit" value="Proceed">
					</form></div>
				</center>
		
		</div>
	<div style="width: 20%; background-color: #78300f; border-radius: 8px; float: left; position: fixed;">
		<table style="width: 100%; padding: 1px;" cellpadding="20px">
			<tr style="text-align: center; font-size: 15px; padding-top: 10px;"><td><a href="courses.php">My Courses</a></td></tr>
			<tr style="text-align: center; font-size: 15px; padding-top: 10px;"><td><a href="logout.php">Show Ratings</a></td></tr>
			<tr style="text-align: center; font-size: 15px; padding-top: 10px;"><td><a href="signup2.php">Set Preferences</a></td></tr>
			<tr style="text-align: center; font-size: 15px; padding-top: 10px;"><td><a href="chng_pwd.php">Change Password</a></td></tr>
			<tr style="text-align: center; font-size: 15px; padding-top: 10px;"><td><a href="remove.php">Remove Account</a></td></tr>
			<tr style="text-align: center; font-size: 15px; padding-top: 10px;"><td><a href="logout.php">Logout</a></td></tr>
		</table>
	</div>
</div>
</td></tr></table>
<script type="text/javascript">
	function pwd(){
		var old = document.getElementById("old").value;
		var new1 = document.getElementById("new1").value;
		var new2 = document.getElementById("new2").value;
		if((old == "")||(new1 == "")||(new2 == "")){
			alert("Please provide correct information");
			return false;
		}
		else if(new1 != new2){
			alert("New password and confirm password is not same");
			return false;
		}
	}
</script>
</body>
</html>
