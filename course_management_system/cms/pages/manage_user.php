<?php
    if(isset($_POST["btnDel"])){
        //print_r($_POST);
        $id = $_POST["txtId"];
        User::delete_data($id);
        $message="<p style='color:red'>Deleted successfully</p>";
        
    }


    if(isset($_POST["btnUpdate"])){
      //print_r($_POST); 
      $id=$_POST["txtId"];
      $role_id=$_POST["cmbRole"];
      $username=$_POST["txtUsername"];
      //$image = $_POST["image"];
      $password=$_POST["pwdPassword"];
      $repassword=$_POST["pwdRePassword"];
     // $inactive=isset($_POST["ckhInactive"])?0:1;

      $user=new User($username,$password,$role_id);
      $user->update($id);
      $message="<p style='color:green'>Update successfully</p>";

     

   }


?>


<div class="content-header">
    <?php echo header_title("Manage User",["<a href='home.php'>Home</a>","Manage User"]);?>
 </div>

 <div class="content">
      <div class="container-fluid">
        <div class="row justify-content-center">
          <div class="col-md-10">
          <form action="#" class="form-horizontal" method="post" >
             <div class="card card-info">
              
               <div class="card-header">
                 <h3 class="card-title">Manage User</h3>
              </div>

               <div class="card-body">              
               
                  <?php
                        if(isset($_POST["btnEdit"])){

                           $id=$_POST["txtId"];
                           $role_id=$_POST["cmbRole"];
                           $username=$_POST["txtUsername"];
                           //$photo = $_POST["image"];
                           $password=$_POST["pwdPassword"];  
                           // $inactive=$_POST["txtInactive"];
                           // $checked=$inactive==0?"checked":""; 
                                                     
                           
                       ?>
                     
                           <form action="#" class="form-horizontal" method="post" enctype="multipart/form-data">                       
              
                             <div class="card-body">              
                                     <?php echo isset($message)?$message:"" ?>
                                     <?php echo isset($error)?$error:"" ?>
                                   
                                   <input type="hidden" name="txtId" value="<?php echo $id?>" />
                                   <?php
                                   $roles=$db->query("select id,name from {$ex}roles");
                                   $html="<div class='form-group row'>";
                                   $html.="<label class='col-sm-3 col-form-label'>";
                                   $html.="Role";
                                   $html.="</label>";
                                   $html.="<div class='col-sm-9'>";
                                   echo $html;
                                   echo "<select name='cmbRole' class='form-control'>";
                                   while(list($rid,$name)=$roles->fetch_row()){
                                    if($rid==$role_id){
                                       echo "<option value='$rid' selected>$name</option>";
                                    }else{
                                       echo "<option value='$rid'>$name</option>";
                                    }
                                   }
                                   echo "</select>";
                                   echo "</div>";
                                   echo "</div>";
                                   ?>
                                  <?php echo text_field("Name","txtUsername","Enter name","",$username); ?>                    
                                 <!-- <?php echo image_file("Image","image",$photo);?> -->
                                 <!-- <?php echo "<img src='images/user/$photo' alt='Profile photo' height='100' width='100'>"?> -->
                                  <?php echo password_field("Password","pwdPassword","Enter password",$password); ?>   
                                  <?php echo password_field("Retype Password","pwdRePassword","Enter password",$password); ?> 
                                  <!-- Active <input type="checkbox" name="ckhInactive" value="<?php echo $inactive?>" <?php echo $checked?> /> -->
                                 
                              </div>
                              
                              <div class="card-footer">
                                <input type="submit" value="Update" class="btn btn-info" name="btnUpdate" />
                                <button type="button" onclick="location='home.php?page=manage-user'" name="btnCancel" class="btn btn-default float-right">Cancel</button>
                              </div>               
                          
                          </form>
                               
                     
                     
                     
                  <?php                     
                        }      
                  ?>

                   <table class="table">
                   <?php echo isset($message)?$message:"" ?>
                    <?php
                       $users=UserController::get_user();

                       echo "<tr><th>ID</th><th>User Name</th><th>Role</th><th>Password</th><th>Action</th></tr>";
                       foreach($users as $user){
                       
                        echo "<tr>";
                         echo "<td>$user->id</td>";
                         echo "<td>$user->username</td>";
                         echo "<td>$user->role_name</td>";
                         echo "<td>".md5($user->password)."</td>";
                         echo "<td><a href='#'><img src='' width='50'/></a></td>";
                         
                         echo "<td>";
                            echo "<div class='btn-group'>";
                            if(($_SESSION["s_id"])==$user->id){
                            echo "<form action='#' method='post'>";
                            echo "<input type='hidden' name='txtId' value='$user->id' />";
                            echo "<input type='hidden' name='txtUsername' value='$user->username' />";
                            echo "<input type='hidden' name='image' value='' />";
                            echo "<input type='hidden' name='pwdPassword' value='$user->password' />";
                            echo "<input type='hidden' name='cmbRole' value='$user->role_id' />";
                            echo "<button type='submit' class='btn btn-success btn-sm' name='btnEdit' value='edit'><i class='far fa-edit'></i></button>";
                           echo "</form>";
                           
                              
                              echo "<form action='#' method='post' onSubmit='return confirm(\"Are you sure?\")'>";
                               echo "<input type='hidden' name='txtId' value='$user->id' />";
                               
                               echo "<button type='submit' class='btn btn-danger btn-sm' name='btnDel' value='del'><i class='far fa-trash-alt'></i></button>";
                              
                               echo "</form>";
                              
                              }
                            echo "</div>";
                         echo "</td>";
                        echo "</tr>";

                       }
                    ?>                  
                   </table>
                </div>
                
                          
             </div>
            </form>
          </div>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>