<?php
    if(isset($_POST["subBtn"])){
        $user_name = $_POST["txtName"];
        $password = $_POST["pwdPassword"];
        $re_password = $_POST["pwdRePassword"];

        if($password == $re_password){
            $file = file("user.txt");
            $csv=(count($file)+1).",".trim($user_name).",".$password.",0,".PHP_EOL;
            file_put_contents("user.txt",$csv,FILE_APPEND);
            $message="Successfully Created";
        }else{
            $error="Password did not match";
        }
    }
?>
 <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
          <form action="#" method="post" class="form-horizontal">
            <div class="card card-info">
                <div class="card-header">Create User</div>
                <div class="card-body">
                    <p style="color:green; text-align:center;"><?php echo isset($message)?$message:"";?></p>
                    <p style="color:red; text-align:center;"><?php echo isset($error)?$error:"";?></p>
                    <?php echo text_field("User Name","txtName","Enter name");?>
                   <?php echo password_field("Password","pwdPassword","Enter password")?>
                   <?php echo password_field("Re-Password","pwdRePassword","Enter Re-password")?>
                </div>
                <div class="card-footer">
                    <input type="submit" name="subBtn" value="Create" class="btn btn-info" />
                    <button class="btn btn-default float-right">Cancel</button>
                </div>
            </div>
            </form>
          </div>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>