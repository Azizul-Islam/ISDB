<?php 
    if(isset($_POST["btnDel"])){
        //print_r($_POST);
        $id = $_POST["txtId"];
        $file = file("user.txt");
        $new_list = array();
        foreach($file as $user){
            list($_id)=explode(",",$user);
            if($id!=$_id){
                array_push($new_list,trim($user));
            }

        }
        $str=implode(PHP_EOL,$new_list);
        file_put_contents("user.txt",$str.PHP_EOL);
    }


    if(isset($_POST["btnUpdate"])){
      //print_r($_POST); 
      $id=$_POST["txtId"];
      $username=$_POST["txtUsername"];
      //$image = $_POST["image"];
      $password=$_POST["pwdPassword"];
      $repassword=$_POST["pwdRePassword"];
      $inactive=isset($_POST["ckhInactive"])?0:1;

      $file=file("user.txt");      
      $new_user_list=array();
      foreach($file as $user){
          list($_id,$_name,$_password,$_image,$_inactive)=explode(",",$user);
          if($id==$_id){  
             $csv=$id.",".$username.",".$password.",".$image.",".$inactive.PHP_EOL;            
             array_push($new_user_list,trim($csv));
          }else{
             array_push($new_user_list,trim($user));
          }
      }

      $str=implode(PHP_EOL,$new_user_list);
      file_put_contents("user.txt",$str.PHP_EOL);

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
                           //print_r($_POST);
                           
                           $id=$_POST["txtId"];
                           $username=$_POST["txtUsername"];
                           $photo = $_POST["image"];
                           $password=$_POST["pwdPassword"];  
                           $inactive=$_POST["txtInactive"];
                           $checked=$inactive==0?"checked":"";  
                                                   
                           
                       ?>
                     
                           <form action="#" class="form-horizontal" method="post" enctype="multipart/form-data">                       
              
                             <div class="card-body">              
                                     <?php echo isset($message)?$message:"" ?>
                                     <?php echo isset($error)?$error:"" ?>
                                   
                                   <input type="hidden" name="txtId" value="<?php echo $id?>" />
                                   <div class='form-group row'>
                                    <label class='col-sm-3 col-form-label'>
                                    Name
                                    </label>
                                   <div class='col-sm-9'>
                                    <input type='text' id='$id' class='form-control'  name='txtUsername' value="<?php echo $username; ?>">
                                    </div>
                                    </div>
                                  
                                  <!-- <?php echo text_field("Name","txtUsername","Enter name",$username); ?>                     -->
                                 <?php echo image_file("Image","image",$photo);?>
                                 <?php echo "<img src='images/user/$photo' alt='Profile photo' height='100' width='100'>"?>
                                  <?php echo password_field("Password","pwdPassword","Enter password",$password); ?>   
                                  <?php echo password_field("Retype Password","pwdRePassword","Enter password",$password); ?> 
                                  Active <input type="checkbox" name="ckhInactive" value="<?php echo $inactive?>" <?php echo $checked?> />
                                 
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
                    <?php
                       $file=file("user.txt");
                       echo "<tr><th>ID</th><th>User Name</th><th>Photo</th><th>Action</th></tr>";
                       foreach($file as $user){
                        list($id,$username,$password,$image,$inactive)=explode(",",$user);
                        echo "<tr>";
                         echo "<td>$id</td>";
                         echo "<td>$username</td>";
                         echo "<td><a href='#'><img src='images/user/$image' width='50'/></a></td>";
                         
                         echo "<td>";
                            echo "<div class='btn-group'>";
                            
                            echo "<form action='#' method='post'>";
                            echo "<input type='hidden' name='txtId' value='$id' />";
                            echo "<input type='hidden' name='txtUsername' value='$username' />";
                            echo "<input type='hidden' name='image' value='$image' />";
                            echo "<input type='hidden' name='pwdPassword' value='$password' />";
                            echo "<input type='hidden' name='txtInactive' value='$inactive' />";
                            if($_SESSION["s_index"]==$id){
                            echo "<button type='submit' class='btn btn-success btn-sm' name='btnEdit' value='edit'><i class='far fa-edit'></i></button>";
                           echo "</form>";
                           
                              echo "<form action='#' method='post' onSubmit='return confirm(\"Are you sure?\")'>";
                               echo "<input type='hidden' name='txtId' value='$id' />";
                               
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