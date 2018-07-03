<?php 

	session_start();
	$uid = $_SESSION["id"];
	//echo $uid;
	$connect = mysqli_connect("localhost","root","","soc");

	$last_tid = mysqli_query($connect,"select last_tid from users where ID=$uid");
	$last = mysqli_fetch_array($last_tid,MYSQLI_ASSOC);
	$la = (int)$last['last_tid'];
	
	//last_tid is a column in users which stores the current course u r doing!
	
	exec("Multi_param_reco.py 2>&1 $uid $la",$out);
		//output will be an array of video_ids with descending order of ratings
		//fetch that array out and show videos for the course having id
		//last_tid using video_id in $out
		//print_r($out);
		
	for ($i=0; $i < sizeof($out); $i++) { 
		$vid = $out[$i];
		$query = mysqli_query($connect,"select link from videos where VID=$vid");
		$row = mysqli_fetch_array($query,MYSQLI_ASSOC);
		echo $row['link']."\n";
	}
	//we now have indivisual links!
		

	
	

?>
