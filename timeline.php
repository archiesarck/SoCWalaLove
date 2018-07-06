<?php
//Block 1 ===============================================================================================
	session_start();

	$connect = mysqli_connect("localhost","root","","soc");
	$uid = $_SESSION["id"];
	//echo $id;
	$result = mysqli_query($connect,"select * from users where ID=$uid ");
	$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
	//echo $row['Username'];
	$last_tid = mysqli_query($connect,"select last_tid from users where ID=$uid");
	$last = mysqli_fetch_array($last_tid,MYSQLI_ASSOC);
	$la = (int)$last['last_tid'];

//=======================================================================================================
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
		//Block 2 =========================================================================================================================

			$sum = 0;
			$num_videos_query = mysqli_query($connect,"select count(*) as num from videos");
			$num_videos_row = mysqli_fetch_array($num_videos_query,MYSQLI_ASSOC);
			$num_videos = (int)$num_videos_row['num'];
			for($i=1;$i<=$num_videos;$i++){
				$x = "`".$i."`";
				$ratings_query = mysqli_query($connect,"select $x as rate from ratings where UID=$uid");
				$ratings_row = mysqli_fetch_array($ratings_query,MYSQLI_ASSOC);
				$sum = $sum + (int)$ratings_row['rate'];
			}
			//echo $la;
			if($sum!=0){
				exec("reg.py 2>&1 $uid",$useless);
				//print_r($useless);
				//********************loop it for all current topics!
				//there can be more than 1 non-related current topics
				exec("Multi_param_reco.py 2>&1 $uid $la",$out);
				for ($i=0; $i < sizeof($out); $i++) { 
					$vid = $out[$i];
					$query = mysqli_query($connect,"select link from videos where VID=$vid");
					$row = mysqli_fetch_array($query,MYSQLI_ASSOC);
					echo "<td style=\"width: 30%; text-align: center;\"><iframe src=\"" . trim($row['link']) . "\" width=\"90%\" style=\"border-radius: 10px; border-width: 0px;\" allowfullscreen></iframe></td>";
				}
			}
			else{

				//*************loop it for all current topics!
				//there can be more than 1 non-related current topics
				exec("Multi_param_reco.py 2>&1 $uid $la",$out);
				//print_r($out);
				for ($i=0; $i < sizeof($out); $i++) { 
					$vid = $out[$i];
					$query = mysqli_query($connect,"select link from videos where VID=$vid");
					$row = mysqli_fetch_array($query,MYSQLI_ASSOC);
					echo "<td style=\"width: 30%; text-align: center;\"><iframe src=\"" . trim($row['link']) . "\" width=\"90%\" style=\"border-radius: 10px; border-width: 0px;\" allowfullscreen></iframe></td>";
				}
			}
			
		
//======================================================================================================================
?>
		
		
		</div>
	<div style="width: 20%; background-color: #78300f; border-radius: 8px; float: left; position: fixed;">
		<table style="width: 100%; padding: 1px;" cellpadding="20px">
			<tr style="text-align: center; font-size: 15px; padding-top: 10px;"><td><a href="courses.php">My Courses</a></td></tr>
			<tr style="text-align: center; font-size: 15px; padding-top: 10px;"><td><a href="recommend.php">Show Ratings</a></td></tr>
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
