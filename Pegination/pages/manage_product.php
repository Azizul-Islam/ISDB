<!-------Page Title------->
<div class="content-header">

   <div class="container">
      <div class="row mb-2">
         <div class="col">
            <h1 class="m-0 text-dark">
               Manage Product
               <button class="btn btn-success" data-toggle="modal" data-target="#create-product">New Product</button>
            </h1>
         </div>
         <div class="col">
           <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Manage Product</li>
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
             <!-------Prod View------->
                   <table class="table">
                    <?php                     
                        $page=isset($_GET["p"])?$_GET["p"]:1;                        
                        
                        $products=Product::get_products($page,3);  

                        while($product=$products["data"]->fetch_object()){
                            echo "<tr>";
                            echo "<td class='id'>$product->id</td>";                         
                            echo "<td>$product->title</td>";
                            echo "<td>$product->price</td>";
                            echo "<td>".$product->uid."</td>";
                            /*echo "<td>";
                               echo "<div class='btn-group'>"; 
                                  action_delete($product->id);
                                  $json=json_encode($product);
                                echo "<button type='button' class='btn btn-success btn-sm btn-edit' name='btnEdit' value='edit' data-toggle='modal' data-target='#user-edit' data-id='$user->id' data-json='$json' ><i class='far fa-edit'></i></button>";
                               echo "</div>";
                            echo "</td>";
							*/
                           echo "</tr>";
                        }                    
                   
                        ?>                  
                   </table>
				   
                   <?php 
                      echo $products["pagination"];
                   ?>
                </div>               
                          
             </div>
            </form>             
         </div>
      </div>   
   </div> 

</div>

