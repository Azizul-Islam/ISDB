<?php
	if(isset($_POST["subBtn"])){
		$u_name=$_POST["txtName"];
		$pass=$_POST["pwd"];
		
		$db=new mysqli('localhost','root','','users');
		$db->query("call add_user('$u_name','$pass')");
		echo 'success';
	}

?>


<form action="#" method="post">
	<div>
		<input type="text" name="txtName" />
	<div>
	<div>
		<input type="password" name="pwd" />
	<div>
	<div>
		<input type="submit" name="subBtn" value="Insert" />
	<div>

</form>

delimiter //
create function count_user() returns int
begin
declare total int;
select count(*) into total from users;
return int;
end//