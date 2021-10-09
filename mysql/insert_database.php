<?php
	require_once("db_config.php");
	
	if(isset($_POST["insertBtn"])){
		$title=$_POST["txtTitle"];
		$price=$_POST["txtPrice"];
		
		$query=$db->query("insert into courses(title,price)values('$title','$price')");
		echo "Success";
	}

?>
<form action="#" method="post">
	<div>Title<br>
		<input type="text" name="txtTitle" />
	</div>
	<div>Price<br>
		<input type="text" name="txtPrice" />
	</div>
	<div>
		<input type="submit" name="insertBtn" value="Insert" />
	</div>
</form>

<?php
	$query=$db->query("select * from courses");
	while(list($id,$title,$user_id,$price)=$query->fetch_row()){
		echo $id." | ".$title." | ".$price."<br>";
	}
?>