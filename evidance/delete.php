<?php
	$db=new mysqli('localhost','root','','evidence');
	$data=$db->query("select * from categoris");
	while(list($id,$name)=$data->fetch_row()){
		echo $id." | ".$name."<br>";
	}
?>
<?php 
	if(isset($_POST["delete"])){
		$id=$_POST["textId"];
		$db->query("delete from categoris where id='$id'");
		echo "Deleted";
	}
?>
<form action="#" method="post">
	<input type="text" name="textId" />
	<input type="submit" name="delete" value="Delete" />
</form>
<?php 
	$data=$db->query("select * from products");
	while(list($id,$name,$category_id)=$data->fetch_row()){
		echo $id." | ".$name." | ".$category_id."<br>";
	}


?>