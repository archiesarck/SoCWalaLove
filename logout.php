<?php 
unset($_SESSION['id']);
 session_destroy();
 session_unset();
 header("Location: index.php");
 ?>