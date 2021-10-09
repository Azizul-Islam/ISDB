<?php
$db=new mysqli('localhost','root','','evidence');
	if(isset($_POST["subBtn"])){
		//print_r($_POST);
		$id=$_POST["cmbCategory"];
		
		$db->query("delete from categoris where id='$id'");
		echo "Deleted";
	}
?>

<form action="#" method="post">
	<select name="cmbCategory">
		<?php
			$db=new mysqli('localhost','root','','evidence');
			$data=$db->query("select id,name from categoris");
			$arr=[];
			while(list($id,$name)=$data->fetch_row()){
				$arr[$id]=$name;
				echo "<option value='$id'>$name</option>";
			}
		?>
	</select><br>
	<input type="submit" name="subBtn" value="Delete" />
	
</form>

<?php
	$data=$db->query("select * from products");
	while(list($id,$name,$price,$photo,$category_id)=$data->fetch_row()){
		echo $id." | ".$name." | ".$price." | ".$category_id."<br>";
	}

?>
delimiter //
drop trigger if exists del_category//
create trigger del_category after delete on categoris
for each row
begin
delete from products where category_id=old.id;
end;
//