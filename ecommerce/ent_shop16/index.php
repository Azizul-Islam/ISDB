<?php   require_once("db_config.php"); ?>
<?php session_start();

if(isset($_POST["subBtn"])){
  $name=$_POST["txtName"];
  $password=md5($_POST["pwdPass"]);
	$query=$db->query("select id,name from {$ex}users where name='$name' and password='$password'");
	if($db->affected_rows>0){
	  list($id,$name,$photo,$role_id,$password,$active_status)=$query->fetch_row();
	  $_SESSION["s_id"]=$id;
	  $_SESSION["s_name"]=$name;
	  $_SESSION["s_photo"]=$photo;
	  header("location:home.php");
	}else{
	  //$error="<p class='login__signup alert alert-danger'><strong>Username or password is invalid</strong></p>";
	  $error="<div class='alert alert-warning alert-dismissible show' role='alert'>
	  Username or password is invalid
	  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
		<span aria-hidden='true'>&times;</span>
	  </button>
	</div>";
	}
}
?>
<!--user register -->
<?php

    if(isset($_POST["regBtn"])){
       // print_r($_POST);
        $name=$_POST["txtName"];
        $password=$_POST["pwdPass"];
        $re_password=$_POST["pwdRePass"];
        $role_id=$_POST["cmbRole"];
		//$active_status=$_POST["active_status"];
		
        if($password==$re_password){
			$pass=md5($password);
            $db->query("insert into {$ex}users(name,role_id,password)values('$name','$role_id','$pass')");
            $message="<p class='alert alert-success'>User added successfully</p>";
        }else{
			$error="<p class='alert alert-danger'>Password did not match</p>";
			
        }
    }

?>



<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login V1</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/login_util.css">
	<link rel="stylesheet" type="text/css" href="css/login_main.css">
<!--===============================================================================================-->
</head>
<body>
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="images/img-01.png" alt="IMG">
				</div>

				<form class="login100-form validate-form" action="#" method="post">
					<span class="login100-form-title">
						Member Login
						
					</span>
					<?php echo isset($error)?$error:""; ?>
					<div class="wrap-input100 validate-input" data-validate = "Valid name is required">
						<input class="input100" type="text" name="txtName" placeholder="Email or Username">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100" type="password" name="pwdPass" placeholder="Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
					
					<div class="container-login100-form-btn">
						<button type="submit" name="subBtn" class="login100-form-btn">
							Login
						</button>
					</div>

					<div class="text-center p-t-12">
						<span class="txt1">
							Forgot
						</span>
						<a class="txt2" href="#">
							Username / Password?
						</a>
					</div>

					<div class="text-center p-t-136">
						<a class="txt2" href="#" data-toggle="modal" data-target="#create-user">
							Create your Account
							<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	<div class="modal fade" id="create-user">
	<div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Sign Up</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form class="login100-form validate-form" action="#" method="post">
					<span class="login100-form-title">
						Member Sign up
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Valid name is required">
						<input type="hidden" name="cmbRole" value="4">
						<input class="input100" type="text" name="txtName" placeholder="Email or Name">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100" type="password" name="pwdPass" placeholder="Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100" type="password" name="pwdRePass" placeholder="Re-Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
					<div class="container-login100-form-btn">
						<button type="submit" name="regBtn" class="login100-form-btn">
							Register
						</button>
					</div>
				</form>
            
            </form>
        </div>
    </div>
</div>

	
<!--===============================================================================================-->	
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
	<script src="js/login_main.js"></script>

</body>
</html>