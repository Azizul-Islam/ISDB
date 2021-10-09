<?php
	require_once("db_config.php");
	if(isset($_POST["update"])){
		$id=$_POST["txtId"];
		$title=$_POST["txtTitle"];
		$price=$_POST["txtPrice"];
		
		$table=$db->query("update courses set title='$title',price='$price' where id='$id'");
		echo "Update";
	}
	

?>
<form action="#" method="post">
	<div>Id<br>
		<input type="text" name="txtId" />
	</div>
	<div>Title<br>
		<input type="text" name="txtTitle" />
	</div>
	<div>Price<br>
		<input type="text" name="txtPrice" />
	</div>
	<div>
		<input type="submit" name="update" value="Update" />
	</div>
</form>

<?php 
	$query=$db->query("select * from courses");
	while(list($id,$title,$user_id,$price)=$query->fetch_row()){
		echo $id." | ".$title." | ".$price."<br>";
	}

?>