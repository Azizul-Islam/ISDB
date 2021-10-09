<?php
    if(isset($_POST["btnDelete"])){
        //print_r($_POST);
        $id = $_POST["txtId"];
        $file = file("contact_list.txt");
        $new_list = array();
        foreach($file as $user){
            list($_id) = explode(",",$user);
            if($id != $_id){
                array_push($new_list,trim($user));
            }
        }
        $str = implode(PHP_EOL,$new_list);
        file_put_contents("contact_list.txt",$str.PHP_EOL);
        $errMessage = "Contact Deleted successfully!";
    }

?>
<div class="content-header">
    <?php echo header_title("Manage User",["<a href='home.php'>Home</a>","Manage User"]);?>
    <p class="text-danger"><?php echo isset($errMessage)?$errMessage:""; ?></p>
 </div>

 <div class="content">
      <div class="container-fluid">
        <div class="row pt-4">
            
        <?php

            $file = file("contact_list.txt");
            foreach($file as $user){
                list($id,$name,$phone,$email,$photo,$city) = explode(",",$user);
            echo "<div class='col-md-6'>";
                echo "<div class='content-inner'>";
                    echo "<div class='image-box'>";
                        echo "<a href=''><img src='images/$photo' class='img-thumbnail' alt='profile-photo'></a>";
                    echo "</div>";
                    echo "<div class='main-content'>";
                        echo "<h4><a href=''>$name</a></h4>";
                        echo "<p><a href=''><i class='fas fa-envelope mr-2'></i>$email</a></p>";
                        echo "<p><i class='fas fa-phone-alt mr-2'></i>$phone</p>";
                        echo "<p><i class='fas fa-map-marker-alt mr-2'></i>$city</p>";
                        echo "</div>";
                        echo "<div class='btn-group'>";
                        echo "<form action='home.php?page=edit-contact' method='post' >";
                        echo "<input type='hidden' name='txtId' value='$id' />";
                        echo "<input type='hidden' name='txtName' value='$name' />";
                        echo "<input type='hidden' name='txtMobile' value='$phone' />";
                        echo "<input type='hidden' name='txtEmail' value='$email' />";
                        echo "<input type='hidden' name='image' value='$photo' />";
                        echo "<input type='hidden' name='cmbCity' value='$city' />";
                        echo "<button type='submit' class='btn btn-success btn-sm' name='btnEdit' value='edit'><i class='far fa-edit'></i></button>";
                       echo "</form>";
                        echo "<form action='#' method='post' onSubmit='return confirm(\"Are your sure?\")'>";
                        echo "<input type='hidden' name='txtId' value='$id' />";
                        echo "<button type='submit' class='btn btn-danger btn-sm' name='btnDelete' value='delete'><i class='far fa-trash-alt'></i></button>";
                       echo "</form>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
            }

        ?>
        </div>
      </div>
    </div>