<?php session_start();
	unset($SESSION["s_id"]);
	session_destroy();
	header("location:index.php");
?>