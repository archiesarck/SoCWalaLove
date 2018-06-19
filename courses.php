<?php
	session_start();

	$connect = mysqli_connect("localhost","root","","soc");
	$id = $_SESSION["id"];
	//echo $id;
	$result = mysqli_query($connect,"select * from users where ID=$id ");
	$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
	$file = "courses\\".$row['Username'].".txt";
	$fp = fopen($file,"r");
	
	

?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<?php  echo "<title>" . $row['FullName'] . ": Courses </title>"  ?>
</head>
<body>
	<div style="width: 100%; background-color: #f2f2f2; border-radius: 8px;">
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
	<p></p>
	<div>
		<div style="width: 78%; border-radius: 8px; float: right; background-color: #f2f2f2;">
		<ul>
			<?php
			

			while (!feof($fp)) {
				echo "<li>";
				$data = fgets($fp);
				echo $data;
				echo "</li>";
			}
			

			?>
		</ul>
		</div>
	<div style="width: 20%; background-color: #78300f; border-radius: 8px; float: left;">
		<table style="width: 100%; padding: 1px;" cellpadding="20px">
			<tr style="text-align: center; font-size: 15px; padding-top: 10px;"><td><a href="courses.php">My Courses</a></td></tr>
			<tr style="text-align: center; font-size: 15px; padding-top: 10px;"><td><a href="ratings.php">Show Ratings</a></td></tr>
			<tr style="text-align: center; font-size: 15px; padding-top: 10px;"><td><a href="signup2.php">Set Preferences</a></td></tr>
			<tr style="text-align: center; font-size: 15px; padding-top: 10px;"><td><a href="logout.php">Change Password</a></td></tr>
			<tr style="text-align: center; font-size: 15px; padding-top: 10px;"><td><a href="remove.php">Remove Account</a></td></tr>
			<tr style="text-align: center; font-size: 15px; padding-top: 10px;"><td><a href="logout.php">Logout</a></td></tr>
		</table>
	</div>
</div>
</body>
</html>
