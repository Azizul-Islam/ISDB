<?php session_start();
	if(isset($_POST["subBtn"])){
		//print_r($_POST);
		$name=$_POST["txtName"];
		$password=md5($_POST["pwdPass"]);
		
		$db=new mysqli('localhost','root','','users');
		$sql=$db->query("select id,name from users where name='$name' and password='$password'");
		if($db->affected_rows>0){
			list($id,$name,$password)=$sql->fetch_row();
			$_SESSION["s_id"]=$id;
			$_SESSION["s_name"]=$name;
			header("location:home.php");
		}else{
			echo "Username or Password is invalid";
		}
	}

?>

<form action="#" method="post">
	<div>Name<br>
		<input type="text" name="txtName" />
	</div>
	<div>Password<br>
		<input type="password" name="pwdPass" />
	</div>
	<div>
		<input type="submit" name="subBtn" value="Login" />
	</div>

</form>