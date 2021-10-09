
<div class="content-header">
    <?php echo header_title("Edit Contact",["<a href='home.php'>Home</a>","Edit Contact"]);?>
    <p class="text-danger"><?php echo isset($errMessage)?$errMessage:""; ?></p>
 </div>

 <?php 
 if(isset($_POST["contactUpdate"])){
     //print_r($_POST);
     $id = $_POST["txtId"];
     $name = $_POST["txtName"];
     $mobile = $_POST["txtMobile"];
     $email = $_POST["txtEmail"];
     //$image = $_POST["image"];
     $city = $_POST["cmbCity"];

     $file = file("contact_list.txt");
     $new_list = array();
     foreach($file as $user){
         list($_id,$_name,$_mobile,$_email,$image,$_city) = explode(",",$user);
         if($id == $_id){
            $csv = $id.",".$name.",".$mobile.",".$email.",".$image.",".$city.PHP_EOL;
            array_push($new_list,trim($csv));
         }else{
             array_push($new_list,trim($user));
         }
          
     }
     $str = implode(PHP_EOL,$new_list);
     file_put_contents("contact_list.txt",$str.PHP_EOL);
     
 }


?>
<?php
 if(isset($_POST["btnEdit"])){
     $id = $_POST["txtId"];
     $name = $_POST["txtName"];
     $mobile = $_POST["txtMobile"];
     $email = $_POST["txtEmail"];
     $image = $_POST["image"];
     $city = $_POST["cmbCity"];

?>
<div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
          <form action="#" method="post" class="form-horizontal" enctype="multipart/form-data">
            <div class="card card-info">
                <div class="card-header">Edit Contact</div>
                <div class="card-body">
                    <p style="color:green;text-align:center"><?php echo isset($message)?$message:"";?></p>
                    <input type="hidden" name="txtId" value="<?php echo $id ?>">
                    <?php echo text_field("Name","txtName","Enter Your name",$name);?>
                   <?php echo text_field("Mobile No","txtMobile","Enter your mobile number",$mobile)?>
                   <?php echo text_field("E-mail","txtEmail","Enter your email",$email)?>
                   <?php echo image_file("Image","image",$image)?>
                   <?php echo "<img src='images/$image' alt='Profile photo' height='100' width='100'>"?>
                   <?php echo select_box("City","cmbCity",$data=["Select One","Pabna","Dhaka"],$city)?>
                </div>
                <div class="card-footer">
                    <input type="submit" name="contactUpdate" value="Update" class="btn btn-info" />
                    <button class="btn btn-default float-right">Cancel</button>
                </div>
            </div>
            </form>
          </div>
        </div>
      </div>
    </div>

 <?php } ?>