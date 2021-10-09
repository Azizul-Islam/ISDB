<?php
//add form with modal

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


    if(isset($_POST["btnDel"])){
        //print_r($_POST);
        $id=$_POST["txtId"];
        User::delete_user($id);
        //$message="<p class='alert alert-danger'>Deleted successfully</p>";
        $message="<div class='alert alert-warning alert-dismissible show' role='alert'>
        Deleted successfully
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
        </button>
        </div>";
    }
    if(isset($_POST["btnSaveChange"])){
        //print_r($_POST);
        $id=$_POST["txtId"];
        $name=$_POST["txtName"];
        $password=$_POST["pwdPass"];
        $repassword=$_POST["pwdRePass"];
        $role_id=$_POST["cmbRole"];
        $active_status=isset($_POST["active_status"])?0:1;
        //$id=$_POST["photo"];
        if(isset($_FILES["photo"]["name"])){
            $file_name=$_FILES["photo"]["name"];
            $temp_name=$_FILES["photo"]["tmp_name"];
            move_uploaded_file($temp_name,"images/users/".$file_name);
        }

        if($password==$repassword){
            $user=new User($name,$file_name,$role_id,$password,$active_status);
            $user->update_user($id);
            //$message="<p class='alert alert-success'>User Updated successfully!</p>";
            $message="<div class='alert alert-success alert-dismissible show' role='alert'>
            User Updated successfully!
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
            </button>
            </div>";
        }
    }
    
?>

<?php echo breadcumb(["Manage User"]); ?>
<?php echo head_title("Manage User"); ?>


<!-- add user modal -->
<div class="modal" id="add-user">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add User</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="col-md-6">
                            <form action="#" method="post" enctype="multipart/form-data" role="form">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="hidden" name="active_status" value="0" />
                                    <input class="form-control" name="txtName" placeholder="Name">
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
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end modal -->


<div class="row">
    <div class="col-md-6"></div>
    <div class="col-md-3">
        <form role="search">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Search User">
            </div>
        </form>
    </div>
    <div class="col-md-3">
        <button style="float:right" type="button" data-toggle="modal" data-target="#add-user" class="btn btn-primary"><i class="fa fa-user-plus" style="padding-right:5px"></i>Add User</button>
    </div>
</div>
<!--/.row-->

<!-- edit user modal -->
<div class="modal" id="user-edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="#" id="edit-form" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h4 class="modal-title">Edit User</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="hidden" class="form-control" name="txtId" id="txtId" placeholder="Placeholder">
                        <input type="text" class="form-control" name="txtName" id="txtName" placeholder="Name">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="pwdPass" id="pwdPass" class="form-control" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <label>Re-password</label>
                        <input type="password" name="pwdRePass" id="pwdRePass" class="form-control" placeholder="Re-password">
                    </div>
                    <div class="form-group">
                        <label>File input</label>
                        <input type="file" name="photo" id="photo">
                    </div>
                    <div class="form-group">
                        <label>Role</label>
                        <select name="cmbRole" id="cmbRole" class="form-control">
                            <?php
                            $data=$db->query("select id,name from {$ex}roles");
                            $arr=[];
                            while(list($id,$name)=$data->fetch_row()){
                                $arr[$id]=$name;
                                echo "<option value='$id'>$name</option>";
                            }
                        ?>
                        </select>
                    </div>
                    <div class="form-group">
                        Active <input type="checkbox" name="active_status" id="active_status" />
                    </div>
                </div>
                <div class="modal-footer justify-content-between">

                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <input type="submit" name="btnSaveChange" value="Save changes" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
</div>


<div class="panel panel-default">
    <?= isset($message)?$message:""; ?>
    <?php echo isset($error)?$error:"";?>
    <table class="table table-bordered">

        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Photo</th>
                <th scope="col">Role</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
        $dir="images/users";
        $users=UserController::get_user();
        foreach($users as $u):
    ?>
            <tr>

                <td><?= $u->id; ?></td>
                <td><?= $u->name; ?></td>

                <td>
                    <img src="images/users/<?= $u->photo; ?>" title="user-photo" width="60" height="60" />
                </td>
                <td><?= $u->role; ?></td>
                <td>
                    <form action='#' method='post' onSubmit="return confirm('Are your sure?')">
                        <input type="hidden" name="txtId" value="<?= $u->id ?>" />
                        <?php  $json=json_encode(["id"=>"$u->id","name"=>"$u->name","password"=>"$u->password","photo"=>"$u->photo","role_id"=>"$u->role_id","active_status"=>"$u->active_status"]); ?>

                        <button type='button' class='btn btn-primary btn-sm btn-edit' data-toggle='modal' data-json='<?= $json ?>' data-id='$u->id' data-target='#user-edit' name='btnEdit' value='edit'><i class='fa fa-edit'></i></button>
                        
                        <button type='submit' class='btn btn-danger btn-sm' name='btnDel' value='del'><i class='fa fa-trash'></i></button>
                        
                    </form>
                </td>

            </tr>
            <?php endforeach;?>
        </tbody>
    </table>

</div>


<script>
    $(function() {
        $(".btn-edit").on("click", function() {
            let record = $(this).data("json");
            //console.log(record);
            $("#edit-form").find("#txtId").val(record.id)
            $("#edit-form").find("#txtName").val(record.name)
            $("#edit-form").find("#pwdPass").val(record.password)
            $("#edit-form").find("#pwdRePass").val(record.password)

            $("#edit-form").find("#cmbRole option").each(function(k, v) {
                //console.log(v);
                if (v.value == record.role_id) {
                    $(this).attr("selected", "selected")
                }
            });

            if (record.active_status == 0) {
                $("#edit-form").find("#active_status").attr("checked", "checked");
            } else {
                $("#edit-form").find("#active_status").removeAttr("checked");
            }
        
        });
    });

</script>
