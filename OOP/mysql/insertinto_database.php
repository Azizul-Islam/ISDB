<?php

	class MyDatabase{
		
		public function db_insert($title,$price,$db){
			
			$db->query("insert into courses(title,price)values('$title','$price')");
			echo "Insert Success";
		}
		
		public function show(){
			require_once("db_config.php");
			$table=$db->query("select * from courses");
			while(list($id,$title,$price)=$table->fetch_row()){
				echo $id." | ".$title." ".$price."<br>";
			}
		}
		
	}
	$ob1=new MyDatabase;
	$ob1->show();
	if(isset($_POST["insertBtn"])){
		$title=$_POST["txtTitle"];
		$price=$_POST["txtPrice"];
		
		require_once("db_config.php");
		$db=new mysqli(SERVER,USER,PWD,DATABASE);
		
		$ob1->db_insert($title,$price,$db);
		
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
