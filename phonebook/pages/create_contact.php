<?php

    if(isset($_POST["subBtn"])){
        
        $name = $_POST["txtName"];
        $mobile =$_POST["txtMobile"];
        $email = $_POST["txtEmail"];
        $city = $_POST["cmbCity"];
        
        if(isset($_FILES["image"])){
          $image_name=$_FILES["image"]["name"];
          $temp_name = $_FILES["image"]["tmp_name"];
          move_uploaded_file($temp_name,"images/".$image_name);
        }

        $file = file("contact_list.txt");
        $csv = (count($file)+1).",".trim($name).",".trim($mobile).",".$email.",".$image_name.",".$city.PHP_EOL;
        file_put_contents("contact_list.txt",$csv,FILE_APPEND);
        $message="Successfully added contact";
    }
?>


<div class="content-header">
    <?php echo header_title("Create Contact",["<a href='home.php'>Home</a>","Create Contact"]);?>
</div>
 <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
          <form action="#" method="post" class="form-horizontal" enctype="multipart/form-data">
            <div class="card card-info">
                <div class="card-header">Create Contact</div>
                <div id="errName"></div>
                <div id="errEmail"></div>
                <div class="card-body">
                    <p style="color:green;text-align:center"><?php echo isset($message)?$message:"";?></p>
                    
                    <?php echo text_field("Name","txtName","Enter Your name","name_validate()","","name");?>
                   <?php echo text_field("Mobile No","txtMobile","Enter your mobile number")?>
                   <?php echo text_field("E-mail","txtEmail","Enter your email","email_validate()","","email")?>
                   <?php echo image_file("Image","image")?>
                   <?php echo select_box("City","cmbCity",$data=["0"=>"Select One","1"=>"Pabna","2"=>"Dhaka"])?>
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


    <script>
      function name_validate(){
        var name = document.getElementById("name").value;
        var errName=document.getElementById("errName");
        errName.style.color="red";
        if(!(/^[a-zA-Z]{2,}[ ]*[a-zA-Z]+$/.test(name))){
          errName.innerHTML="<div class='alert alert-danger'>Enter valid name</div>";
        }else{
          errName.innerHTML="";
        }
      }
      function email_validate(){
        var email = document.getElementById("email").value;
        var errEmail=document.getElementById("errEmail");
        if(!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+/.test(email))){
          errEmail.innerHTML="<div class='alert alert-danger'>Enter your valid email</div>";
        }else{
          errEmail.innerHTML="";
        }
      }
    </script>