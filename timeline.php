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
		<?php 
	$id = $_SESSION["id"];
	$connection = mysqli_connect("localhost","root","","soc");
	$arr = mysqli_query($connection,"select * from users where Id=$id");
	$r = mysqli_fetch_array($arr,MYSQLI_ASSOC);

	$file = "courses\\".$r['Username'].".txt";
	$fp = fopen($file, "r");
	//echo $file;
	while(!feof($fp)){
		$data = fgets($fp);
		if (ord($data)!=10) {
			echo "<table style=\"width: 100%;\"><tr><td><h3>Recommended for you in ". $data."</h3></td></tr><tr>";
			$link = "links\\".trim($data).".txt";
			//echo $link."<br>";
			$f = fopen($link,"r");
			while(!feof($f)){
				$l = fgets($f);
				//echo $l."<br>";
				if (ord($l)!=10){
					echo "<td style=\"width: 30%; text-align: center;\"><iframe src=\"" . trim($l) . "\" width=\"90%\" style=\"border-radius: 10px; border-width: 0px;\" allowfullscreen></iframe></td>";
				}
			}
			fclose($f);
			echo "</tr></table>";
		}
	}
	fclose($fp);

?>
		
		
		</div>
	<div style="width: 20%; background-color: #78300f; border-radius: 8px; float: left; position: fixed;">
		<table style="width: 100%; padding: 1px;" cellpadding="20px">
			<tr style="text-align: center; font-size: 15px; padding-top: 10px;"><td><a href="courses.php">My Courses</a></td></tr>
			<tr style="text-align: center; font-size: 15px; padding-top: 10px;"><td><a href="#">Show Ratings</a></td></tr>
			<tr style="text-align: center; font-size: 15px; padding-top: 10px;"><td><a href="signup2.php">Set Preferences</a></td></tr>
			<tr style="text-align: center; font-size: 15px; padding-top: 10px;"><td><a href="chng_pwd.php">Change Password</a></td></tr>
			<tr style="text-align: center; font-size: 15px; padding-top: 10px;"><td><a href="remove.php">Remove Account</a></td></tr>
			<tr style="text-align: center; font-size: 15px; padding-top: 10px;"><td><a href="logout.php">Logout</a></td></tr>
		</table>
	</div>
</div>
</td></tr></table>
</body>
</html>
