<?php
	session_start();
	$id = $_SESSION["id"];
	//echo $id;
	$connect = mysqli_connect("localhost","root","","soc");
	$result = mysqli_query($connect,"select * from users where ID=$id");
	$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
	$file = "courses\\" . $row['Username'] . ".txt";
	echo $file;
	$fp = fopen($file,"w");

	foreach($_GET['course'] as $var) {
		$data = $var . "\n";
		fwrite($fp,$data);
	}
	fclose($fp);
	header("Location:timeline.php");
?>