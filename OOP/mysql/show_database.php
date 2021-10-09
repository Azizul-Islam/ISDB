<?php
	
	class MyDatabase{
		
		public function show_database(){
		require_once("db_config.php");
		$table=$db->query("select * from courses");
		while(list($id,$title,$price)=$table->fetch_row()){
			echo $id." | ".$title." ".$price."<br>";
			}
		}
	}
	$db=new MyDatabase;
	$db->show_database();
	
	

?>