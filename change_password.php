/*This file is to be called from a change_password.html file that uses the
method "Post". We expect the following database to exist : Database SOC with
table USERS containing attributes username and password*/
<?php


$user=_POST['username'];//username of current user
$current_password=_POST['curr_pass'];
$new_password=_POST['new_pass'];

//new password and old password have to be different
if ($new_password===$current_password)
{
  die("New password and Old password can't be the same!");
}



$servername = "localhost";//servername, change if different
$username = "root";//username of local mysql
$password = "password";//password of local mysql
$dbname = "SOC";

//first check if the current_password is the actual password

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT password FROM USERS WHERE username=".$user;
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc())
    {if($row['password']!==$current_password) die("Incorrect Password!");}

} else {
    die("FATAL ERROR");
}
$conn->close();

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "UPDATE USERS SET password=".$new_password." WHERE username=".$user;

if (mysqli_query($conn, $sql)) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . mysqli_error($conn);
}

$conn->close();




?>
