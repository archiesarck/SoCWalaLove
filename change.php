<?php
	session_start();

	$connect = mysqli_connect("localhost","root","","soc");
	$id = $_SESSION["id"];
	//echo $id;
	$result = mysqli_query($connect,"select * from users where ID=$id ");
	$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
	//echo $row['Username'];
	$old = $_POST['old'];
	$new1 = $_POST['new1'];
	$new2 = $_POST['new2'];

	if($row['Password']==$old){
		$query = mysqli_query($connect,"update users set Password='$new2' where ID=$id ");
		header("Location: timeline.php");
	}
	else{
		header("Location: timeline.php");
	}
?>