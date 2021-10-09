<?php
    if(isset($_POST["subBtn"])){
       // print_r($_POST);
        $name=$_POST["txtName"];
        $password=$_POST["pwdPass"];
        $re_password=$_POST["pwdRePass"];
        $role_id=$_POST["cmbRole"];
        $active_status=$_POST["active_status"];

        if(isset($_FILES["photo"]["name"])){
            $file_name=$_FILES["photo"]["name"];
            $temp_name=$_FILES["photo"]["tmp_name"];
            move_uploaded_file($temp_name,"images/users/".$file_name);
        }
        if($password==$re_password){
            $user=new User($name,$file_name,$role_id,$password,$active_status);
            $user->insert_data();
            //$message="<p class='alert alert-success'>User added successfully</p>";
            $message="<div class='alert alert-success alert-dismissible show' role='alert'>
            User added successfully
	        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
		    <span aria-hidden='true'>&times;</span>
	        </button>
	        </div>";
        }else{
            //$error="<p class='alert alert-danger'>Password did not match</p>";
            $error="<div class='alert alert-warning alert-dismissible show' role='alert'>
            Password did not match
	        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
		    <span aria-hidden='true'>&times;</span>
	        </button>
	        </div>";
        }
    }

?>

<?php echo breadcumb(["Create User"],"home"); ?>
<?php echo head_title("Create User"); ?>
<div class="panel panel-default">
    <div class="panel-heading">Forms</div>
    <?php echo isset($message)?$message:"";?>
    <?php echo isset($error)?$error:"";?>
    <div class="panel-body">
        <div class="col-md-6">
            <form action="#" method="post" enctype="multipart/form-data" role="form">
                <div class="form-group">
                    <label>Name</label>
                    <input type="hidden"  name="active_status" value="0" />
                    <input class="form-control" required name="txtName" placeholder="Placeholder">
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="pwdPass" class="form-control" placeholder="Password">
                </div>
                <div class="form-group">
                    <label>Re-password</label>
                    <input type="password" name="pwdRePass" class="form-control" placeholder="Re-password">
                </div>
                <div class="form-group">
                    <label>File input</label>
                    <input type="file" name="photo">
                </div>
                <div class="form-group">
                    <label>Role</label>
                    <select name="cmbRole" class="form-control">
                        <?php
                            $data=$db->query("select id,name from {$ex}roles");
                            $arr=[];
                            while(list($id,$name)=$data->fetch_row()){
                                $arr[$id]=$name;
                                echo"<option value='$id'>$name</option>";
                            }
                        ?>
                    </select>
                </div>
                <input type="submit" name="subBtn" value="Insert" class="btn btn-primary" />
                <button type="reset" class="btn btn-default">Reset</button>


            </form>
        </div>
    </div>
</div><!-- /.panel-->
