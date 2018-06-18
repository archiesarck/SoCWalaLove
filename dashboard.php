<!--17/6 only backend for now. add frontend later-->
<!-- username requested by method POST. -->
<?php

$username=_POST['username'];
$filename="Users/"$username.".txt";

$myfile = fopen($filename, "r") or die("Unable to open file!");

while(!feof($myfile))
{
  $line=fgets($myfile);
  $words = explode(" ", $str);//converts line into an array of words
  $topicname = $words[0];
  $topicprogress = $words[1];

  if($topicprogress==1)// if the topic is in progress
  {
    $topic_filename="Videos/".$topicname.".txt";
    $topicfile = fopen($topic_filename, "r");//add error message later
    $topic_video_id_array=explode("-",$words[2]);
    //echo "<div>".$topicname."</div>";    
    while(!feof($topicfile))
    {
      $video=fgets($topicfile);//fgets returns next line
      $video_data=explode(" ", $video);
      $video_link=$video_data[1];
      $video_embed='<iframe width="560" height="315" src="'.$video_link.'start=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>';
      //use above code to embed. adjust player size as needed.
    }
  }

  fclose($topicfile);
}

fclose($myfile);

?>
