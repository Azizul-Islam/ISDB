<?php
$db=new mysqli('localhost','root','','evidence');
	if(isset($_POST["delBtn"])){
		//print_r($_POST);
		$c_id=$_POST["cmdCategory"];
		$db->query("delete from categoris where id='$c_id'");
		echo "Deleted Successfully";
	}
?>

<form action="#" method="post">
	<div>Categoris<br>
		<select name="cmdCategory">
<?php
	$db=new mysqli('localhost','root','','evidence');
	$data=$db->query('select id,name from categoris');
	$arr=[];
	while(list($id,$name)=$data->fetch_row()){
		$arr[$id]=$name;
		echo "<option value='$id'>$name</option>";
	}
		
	?>
		</select>
	</div>
	<div><input type="submit" name="delBtn" value="Delete" /></div>
</form><br><br>

<?php
	$db=new mysqli('localhost','root','','evidence');
	$data=$db->query('select id,name,price from products');
	
	while(list($id,$name,$price)=$data->fetch_row()){
		echo $id." | ".$name." | ".$price."<br>";
	}
		
?>
<br>

<?php
	$data1=$db->query("select id,name,category from product_report");
	while(list($id,$name,$category)=$data1->fetch_row()){
		echo $id." | ".$name." | ".$category."<br>";
	}
?>