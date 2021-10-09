<?php
	require_once("db_config.php");
	$query=$db->query("select id,title,price from courses");
	while(list($id,$title,$price)=$query->fetch_row()){
		echo $id." | ".$title." | ".$price."<br>";
	}

?>