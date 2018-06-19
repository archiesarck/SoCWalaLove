<?php
	$connect = mysqli_connect("localhost","root","","soc");
	session_start();
?>

<html>
<body>
	<?php
	$fname = $_POST['fname'];
	$uname = $_POST['uname'];
	$email = $_POST['email'];
	$age = $_POST['date'];
	$pass1 = $_POST['pwd1'];
	$pass2 = $_POST['pwd2'];
	$std_String = $_POST['std'];

	if ($std_String=="hs") $std = 0;					//high school
	elseif ($std_String=="twelve") $std = 1;			//10 +2
	elseif ($std_String=="bt") $std = 2;				//B.Tech/BS
	elseif ($std_String=="js") $std = 3;				//Job Seeker
	elseif ($std_String=="prof") $std = 4;				//Proffesor
	?>

	<?php
	if($pass1==$pass2){
		//echo $pass1;
		$result = mysqli_query($connect,"insert into users (FullName,Username,DOB,Email,Password,std) values ('$fname','$uname','$age','$email','$pass1','$std')");
		$s = mysqli_query($connect,"select * from users where Username='$uname' ");
		$row = mysqli_fetch_array($s,MYSQLI_ASSOC);
		$_SESSION["id"] = $row['ID'];
		//echo $_SESSION["id"];


		header("Location:signup2.php");
	}

	else echo "Renter the correct password!";
	?>
	
</body>
</html>
