<?php
	$db=new mysqli('localhost','root','','evidence');
	
	if(isset($_POST["subBtn"])){
		//print_r($_POST);
		$name=$_POST["txtName"];
		$price=$_POST["txtPrice"];
		$category_id=$_POST["txtCategory"];
	
	if(isset($_FILES["photo"])){
		//print_r($_FILES);
		$file_name=$_FILES["photo"]["name"];
		$file_temp_name=$_FILES["photo"]["tmp_name"];
		move_uploaded_file($file_temp_name,"img/".$file_name);
		//echo "done";
		
	}
	$db->query("insert into products(name,price,photo,category_id)values('$name','$price','$file_name','$category_id')");
	echo "Success";
	
	}

?>

<form action="#" method="post" enctype="multipart/form-data">
	<div>Product Name<br>
		<input type="text" name="txtName" />
	</div>
	<div>Product Price<br>
		<input type="text" name="txtPrice" />
	</div>
	<div>Select Category<br>
		<select name="txtCategory">
			<?php
				$data1=$db->query("select id,name from categoris");
				$arr=[];
				while(list($id,$name)=$data1->fetch_row()){
					$arr[$id]=$name;
					echo "<option value='$id'>$name</option>";
				}
			?>
		</select>
	</div>
	<div>Photo<br>
		<input type="file" name="photo" />
	</div>
	<div>
		<input type="submit" name="subBtn" value="Insert" />
	</div>
	
</form>


<?php
	$data=$db->query("select id,name,price,photo,category_id from products");
	while(list($id,$name,$price,$photo,$category_id)=$data->fetch_row()){
		echo $id." | ".$name." | ".$price." | "."<img src='img/$photo' width='150' />"."<br>";
	}

?>