<?php session_start();
	if(!isset($_SESSION["s_id"])){
		header("location:index.php");
	}

?>

<h1>Welcome to home page</h1>
<a href="logout.php">Logout</a>