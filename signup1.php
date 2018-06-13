<html>
<head>
<title>User Registration</title>
<link rel="stylesheet" type="text/css" href="style.css">

</head>
<body>
<div class="head"><h2>Learn Easy, Stay Ahead</h2></div>
<div style= " height: 100px; padding-top: 20px; padding-left: 20px; font-size: 20px; margin-top: 0px;" id="myDiv">
	<h2>Step 1: Please provide your required details</h2>
</div>
<p></p>
<center>
	<div id="p21" align="left">
		<form onsubmit="return check()" method="post" action="action_signup.php">
			<label>Full Name</label>
			<p></p>
			<input type="text" name="fname" id="fname">
			<p></p>
			<label>Username</label>
			<p></p>
			<input type="text" name="uname" id="uname">
			<p></p>
			<label>Date of Birth</label>
			<p></p>
			<input type="date" name="date" id="date">
			<p></p>
			<label>Standard</label>
			<p></p>
			<select name="std" id="std">
				<option value="hs">High School</option>
				<option value="twelve">10 +2</option>
				<option value="bt">B.Tech.</option>
				<option value="js">Job Seeker</option>
				<option value="prof">Proffesor</option>
			</select>
			<p></p>
			<label>Email</label>
			<p></p>
			<input type="text" name="email" id="email">
			<p></p>
			<label>Password</label>
			<p></p>
			<input type="Password" name="pwd1" id="pwd1">
			<p></p>
			<label>Confirm Password</label>
			<p></p>
			<input type="Password" name="pwd2" id="pwd2">
			<p></p>
			<input type="submit" name="submit" value="Proceed">
		</form>
	</div>
</center>
</center>
<script>
window.onscroll = function() {myFunction()};

var header = document.getElementById("myDiv");
var sticky = header.offsetTop;

function myFunction() {
  if (window.pageYOffset >= sticky) {
    header.classList.add("sticky");
  } else {
    header.classList.remove("sticky");
  }
}


</script>
<script type="text/javascript">
	
	function check(){
		var email = document.getElementById("email").value;
		var pass1 = document.getElementById("pwd1").value;
		var pass2 = document.getElementById("pwd2").value;
		var fname = document.getElementById("fname").value;
		var date = document.getElementById("date").value;
		if((email == "")||(pass1 == "")||(pass2 == "")||(fname == "")){
			 alert("Please Enter Credentials");
			 return false;
		}
	}

</script>
</body>
</html>