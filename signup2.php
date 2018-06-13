<!DOCTYPE html>
<html>
<head>
	<title>Setup your page</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="head"><h2>Learn Easy, Stay Ahead</h2></div>
	<div style= " height: 100px; padding-top: 20px; padding-left: 20px; font-size: 20px; margin-top: 0px;">
	<h2>Step 2: Please set your course choices. You can also change it later.</h2>
</div>
<p></p>
	<center>
	<div id="effect">
		<form method="get" action="setup.php">
		<table style="width: 100%; padding: 20px;" cellpadding="20px">
			<tr>
				<td style="width: 30%">
					<img src="images\coding.png" class="imgbtn">
				</td>
				<td style="width: 30%">
					<img src="images\physics.jpg" class="imgbtn">
				</td>
				<td style="width: 30%">
					<img src="images\guitar.jpg" class="imgbtn">
				</td>
			</tr>
			<tr>
				<td style="width: 30%; text-align: center;">
					<label><input type="checkbox" name="course[]" value="code">&nbsp<b>Coding</b></label>

				</td>
				<td style="width: 30%; text-align: center;">
					<label><input type="checkbox" name="course[]" value="phy">&nbsp<b>Physics</b></label>

				</td>
				<td style="width: 30%; text-align: center;">
					<label><input type="checkbox" name="course[]" value="music">&nbsp<b>Music</b></label>

				</td>
			</tr>
			<tr>
				<td style="width: 30%">
					<img src="images\maths.jpeg" class="imgbtn">
				</td>
				<td style="width: 30%">
					<img src="images\dance.jpg" class="imgbtn">
				</td>
				<td style="width: 30%">
					<img src="images\chem.jpg" class="imgbtn">
				</td>
			</tr>
			<tr>
				<td style="width: 30%; text-align: center;">
					<label><input type="checkbox" name="course[]" value="maths">&nbsp<b>Maths</b></label>

				</td>
				<td style="width: 30%; text-align: center;">
					<label><input type="checkbox" name="course[]" value="dance">&nbsp<b>Dance</b></label>

				</td>
				<td style="width: 30%; text-align: center;">
					<label><input type="checkbox" name="course[]" value="chem">&nbsp<b>Chemistry</b></label>

				</td>
			</tr>
			<tr>
				<td style="width: 30%">
					<img src="images\bio.png" class="imgbtn">
				</td>
				<td style="width: 30%">
					<img src="images\eco.jpg" class="imgbtn">
				</td>
				<td style="width: 30%">
					<img src="images\history.jpg" class="imgbtn">
				</td>
			</tr>
			<tr>
				<td style="width: 30%; text-align: center;">
					<label><input type="checkbox" name="course[]" value="bio">&nbsp<b>Biology</b></label>

				</td>
				<td style="width: 30%; text-align: center;">
					<label><input type="checkbox" name="course[]" value="eco">&nbsp<b>Economics</b></label>

				</td>
				<td style="width: 30%; text-align: center;">
					<label><input type="checkbox" name="course[]" value="history">&nbsp<b>History</b></label>

				</td>
			</tr>
			<tr>
				<td style="width: 30%; text-align: center;"></td>
				<td style="width: 30%; text-align: center;"><input type="submit" name="submit" value="Proceed"></td>
				<td style="width: 30%; text-align: center;"></td>
			</tr>
		</table>
	</form>
	<form onsubmit="return check();" method="post" action="search.php">
		<center>
			<div id="effect">
				<table style="width: 100%;">
					<tr>
					<td style="width: 80%;">
					<input type="text" name="search" id="I" placeholder="Looking for more..search here!"></td><td style="width: 20%;">
					<button type="submit" style="height: 40px; border-radius: 3px; border-width: 0px; background-color: #ccc;"><i class="fa fa-search"></i></button>
					</td>
			</tr>
				</table>
			</div>
		</center>
	</form>
	</div>
</center>
<script type="text/javascript">
	function check(){
		var s = document.getElementById("I").value;
		if(s==""){
			return false;
		}
	}
</script>
</body>
</html>