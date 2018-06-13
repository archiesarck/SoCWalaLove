<?php 

	$connect = mysqli_connect("localhost","root","","soc");
	session_start();


	$uname = $_POST['uname'];
	$pass = $_POST['pwd'];
	$result =mysqli_query($connect,"select * from users where Username = '$uname' && Password = '$pass' ")or die(mysqli_error());
	$row=mysqli_fetch_array($result,MYSQLI_ASSOC);

 ?>
 
		<?php 
 			if($uname==$row['Username'] && $pass==$row['Password']){
 				$_SESSION["id"] = $row['ID'];
				header("Location:timeline.php");
			}
			else echo "Wrong Credentials provided";

 		?>