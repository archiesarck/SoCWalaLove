<?php
	
	session_start();
	$uid = $_SESSION["id"];
	//echo $uid;
	$connect = mysqli_connect("localhost","root","","soc");

	$last_tid = mysqli_query($connect,"select last_tid from users where ID=$uid");
	$last = mysqli_fetch_array($last_tid,MYSQLI_ASSOC);
	$la = (int)$last['last_tid'];

	// child courses

	$query = mysqli_query($connect,"select TID from topics where PID=$la");
	$suggestions = array();
	while($row = mysqli_fetch_array($query,MYSQLI_ASSOC)){
		$suggestions[] = $row;
	}
	foreach($suggestions as $s){
		echo $s['TID'];
	}

	//brother courses

	$bro = mysqli_query($connect,"select PID from topics where TID=$la");
	$bro_row = mysqli_fetch_array($bro,MYSQLI_ASSOC);
	$pid = (int)$bro_row['PID'];
	$b = mysqli_query($connect,"select TID from topics where PID=$pid");
	while($row = mysqli_fetch_array($b,MYSQLI_ASSOC)){
		$suggested[] = $row;
	}
	foreach($suggested as $s){
		if((int)$s['TID']!=$la){
			echo $s['TID'];
		}
	}

?>