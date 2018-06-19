<!DOCTYPE html>
<html>
<head>
	<title></title>
	
</head>
<body>
<?php 
session_start();
$id = $_SESSION["id"];
$connect = mysqli_connect("localhost","root","","soc");
$query = mysqli_query($connect,"delete from users where ID=$id");
?>
<?php header("Location:index.php");  ?>
</body>
<script type="text/javascript">
		alert("You have been successfully logged out");
	</script>
</html>