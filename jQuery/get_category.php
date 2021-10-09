<?php
	if(isset($_GET["id"])){
		//print($_GET);
		echo $id=$_GET["txtId"];
	}
	
	$db=new mysqli('localhost','root','','evidence');
	$sql=$db->query("select id,name from categoris");
	$data=[];
	while(list($id,$name)=$sql->fetch_row()){
		array_push($data,["id"=>$id,"name"=>$name]);
	}
	echo json_encode(["data"=>$data]);

?>