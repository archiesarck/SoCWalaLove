<?php
//assume SOC database in mysql with User table with attribute Name and Username
//the username is requested  as user by post
//$name="Alan";//comment out this line... just for testing purposes
//$user=_POST['username'];
$user="alannair";
$servername = "localhost";
$username = "root";//username of local mysql - root
$password = "opeth666";//password of local mysql
$dbname = "SOC";


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT name AND topics FROM USER WHERE username='".$user."'" ;
$result = $conn->query($sql);
$row=$result->fetch_assoc();
$name=$row["name"];
$topics=$row["topics"];//topics is a link to a txt file containing list of topics.

$conn->close();
 ?>
 <head>
 <title>Home</title>
 <link rel="stylesheet" href="homepage.css">
</head>
  <body>
    <div align="Right" class="welcome_bar">Welcome <?php echo $name ?>
      <div class="dropdown">
        <button class="dropbtn">Dropdown</button>
        <div class="dropdown-content">
          <a href="#">Account Settings</a>
          <a href="#">Topics List</a>
          <a href="#">Progress</a>
        </div>
      </div>
      <a href="#"><img src="logout.jpg" height="50"; width="50";></a>
    </div>

<?php
/*read file whose link is stored in topics
topics list will be in the form of ids*/
?>
  </body>
