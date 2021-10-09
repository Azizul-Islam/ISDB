<?php
	require_once("db_config.php");
	if(isset($_POST["deleteBtn"])){
		$id=$_POST["txtId"];
		
		$table=$db->query("delete from courses where id='$id'");
		echo "Deleted";
	}

?>
<form action="#" method="post">
	<input type="text" name="txtId" />
	<input type="submit" name="deleteBtn" value="Delete" />
	
</form>

<?php 
	$query=$db->query("select * from courses");
	while(list($id,$title,$user_id,$price)=$query->fetch_row()){
		echo $id." | ".$title." | ".$price."<br>";
	}

?>