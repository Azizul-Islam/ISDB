<?php   
  
  //Delete
   if(isset($_POST["btnDel"])){
     
      $id=$_POST["txtId"];   
     // print_r($id);   
      User::delete($id);

   }
  //Update without Modal
   if(isset($_POST["btnUpdate"])){      
      //print_r($_POST); 
      $id=$_POST["txtId"];
      $username=$_POST["txtUsername"];
      $role_id=$_POST["cmbRole"];
      $password=$_POST["pwdPassword"];
      $repassword=$_POST["pwdRePassword"];
      $inactive=isset($_POST["ckhInactive"])?0:1;
      //echo $inactive;
      if($password==$repassword){
         $user=new User($username,$password,$role_id,$inactive);
         $user->update($id); 
      }

   } 
   //Update With Modal
   if(isset($_POST["btnSaveChange"])){      
      //print_r($_POST); 
      $id=$_POST["txtId"];
      $username=$_POST["txtUsername"];
      $role_id=$_POST["cmbRole"];
      $password=$_POST["pwdPassword"];
      $repassword=$_POST["pwdRePassword"];          
      $inactive=isset($_POST["ckhInactive"])?0:1;
            
      if($password==$repassword){
         $user=new User($username,$password,$role_id,$inactive);
         $user->update($id); 
      }

   }

   

?>
<!-------Page Title------->
<div class="content-header">

   <div class="container">
      <div class="row mb-2">
         <div class="col">
            <h1 class="m-0 text-dark">
               Manage User
               <button class="btn btn-success" data-toggle="modal" data-target="#user-create">New User</button>
            </h1>
         </div>
         <div class="col">
           <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Manage User</li>
            </ol>
         </div>
      </div>
   </div>

</div>

<!-------Page Body------->
<div class="content">    
   <div class="container">     
      <div class="row">
         <div class="col-sm-9">
            
            <form action="#" class="form-horizontal" method="post">
             <div class="card card-info">
              
               <div class="card-header">
                 <h3 class="card-title">Manage User</h3>
                 
              </div>
 
               <div class="card-body">              
                    <!-------To Open edit Form witout modal------->
                  <?php
                        if(isset($_POST["btnEdit"])){
                           $id=$_POST["id"];
                           $username=$_POST["username"];
                           $role_id=$_POST["role_id"];
                           $password=$_POST["password"];  
                           $inactive=$_POST["inactive"];
                           $checked=$inactive==0?"checked":"";                           
                           
                       ?>
                     
                           <form action="#" class="form-horizontal" method="post">                       
              
                             <div class="card-body">              
                                     <?php echo isset($message)?$message:"" ?>
                                     <?php echo isset($error)?$error:"" ?>                                   
                                     <input type="hidden" name="txtId" value="<?php echo $id?>" />
                                   
                                   <?php 
                                  
                                   $roles=$db->query("select id,name from {$ex}roles");
                                   $roles_arr=array();                      
                                   while(list($id,$name)=$roles->fetch_row()){                         
                                     $roles_arr[$id]=$name;                       
                                   }                                  
                                    echo select_box("Role","cmbRole",$roles_arr,$role_id);                                
                                   ?>
                                   
                                  <?php echo text_field("Name","txtUsername","Enter name",$username); ?>
                                  <?php echo password_field("Password","pwdPassword","Enter password",$password); ?>   
                                  <?php echo password_field("Retype Password","pwdRePassword","Enter password",$password); ?> 
                                 
                                 
                                  Active <input type="checkbox" name="ckhInactive" value="<?php echo $inactive?>" <?php echo $checked?> />
                                 
                              </div>
                              
                              <div class="card-footer">
                                <input type="submit" value="Update" class="btn btn-info" name="btnUpdate" />
                                <button type="button" onclick="location='manage-user'" name="btnCancel" class="btn btn-default float-right">Cancel</button>
                              </div>               
                          
                          </form>        
                     
                  <?php                     
                     }      
                  ?>
             <!-------User View------->
                   <table class="table">
                    <?php                     
                        $page=isset($_GET["p"])?$_GET["p"]:1;
                        //print_r($_GET["p"]);
                        $users=User::get_users($page);               
                        
                       $id=1;
                       foreach($users["data"] as $user){
                        echo "<tr>";
                         echo "<td class='id'>$user->id</td>";
                         //echo "<td class='id'>".$id++."</td>";
                         echo "<td>$user->username</td>";
                         echo "<td>$user->role_name</td>";
                         echo "<td>".$user->password."</td>";
                         echo "<td>";
                            echo "<div class='btn-group'>";                         
                             //action_edit($user);
                             action_delete($user->id);
                              //$json="{\"id\":\"$user->id\",\"username\":\"$user->username\"}";                           
                             //$json=json_encode(["id"=>"$user->id","username"=>"$user->username","role_id"=>"$user->role_id","password"=>"$user->password","inactive"=>"$user->inactive"]);
                             $json=json_encode($user);
                             echo "<button type='button' class='btn btn-success btn-sm btn-edit' name='btnEdit' value='edit' data-toggle='modal' data-target='#user-edit' data-id='$user->id' data-json='$json' ><i class='far fa-edit'></i></button>";
                            echo "</div>";
                         echo "</td>";
                        echo "</tr>";
                        }
                       
                    ?>                  
                   </table>
                   
                   <?php 
                      echo $users["pagination"];
                   ?>
                </div>               
                          
             </div>
            </form>             
         </div>
      </div>   
   </div> 

</div>

<!--New User-->
<div class="modal" id="user-create">
   <div class="modal-dialog">
      <div class="modal-content">
         
          


      </div>
   </div>
</div>

<!-------Edit Modal------->
<div class="modal" id="user-edit">
     <div class="modal-dialog modal-md">
      <div class="modal-content">
        <form action="#" id="edit-form" class="form-horizontal" method="post">
        
         <div class="modal-header">
              <h4 class="modal-title">Edit User</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
         </div> 
         <div class="modal-body">      
                                          
                     <?php echo isset($message)?$message:"" ?>
                     <?php echo isset($error)?$error:"" ?>
                    <input type="hidden" name="txtId" id="txtId" />
                    <?php echo text_field("Name","txtUsername","Enter name"); ?>  
                    <?php echo password_field("Password","pwdPassword","Enter password"); ?>   
                    <?php echo password_field("Retype Password","pwdRePassword","Enter password"); ?> 
                  
                    <?php  
                     
                      $roles=$db->query("select id,name from {$ex}roles");
                      
                      $roles_arr=[];                      
                      while(list($id,$name)=$roles->fetch_row()){                         
                        $roles_arr[$id]=$name;                       
                      }
                                          
                      echo select_box("Role","cmbRole",$roles_arr);
                    ?>               
             Active <input type="checkbox" name="ckhInactive" id="ckhInactive"  />
         </div>
         <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <input type="submit" name="btnSaveChange" value="Save changes" class="btn btn-primary"/>
         </div>

         </form>     
     
      </div>
     </div>
</div>
<script>
  $(function(){
     
     $(".btn-edit").on("click",function(){

       //let id=$(this).parent().parent().parent().find(".id").html();  
       //$(this).parent().parent().parent().css("background-color","lightgray");      
              
       let record=$(this).data("json");    
        console.log(record);
        /*
       let id=$(this).data("id");
       $.ajax({
          url:"../api/get_user.php?id="+id,
          method:"get",
          success:function(res){
           var record=JSON.parse(res);           
          }       
       });*/

       $("#edit-form").find("#txtId").val(record.id)
       $("#edit-form").find("#txtUsername").val(record.username)
       $("#edit-form").find("#pwdPassword").val(record.password)
       $("#edit-form").find("#pwdRePassword").val(record.password)

       $("#edit-form").find("#cmbRole option").each(function(k,v){
          if(v.value==record.role_id){
            $(this).attr("selected","selected")            
          }
       });

       if(record.inactive==0){               
         $("#edit-form").find("#ckhInactive").attr("checked","checked");
       }else{
         $("#edit-form").find("#ckhInactive").removeAttr("checked");
       }       

     });

  });
</script>