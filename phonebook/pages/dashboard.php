 <!-- Content Header (Page header) -->
 <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Starter Page</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Starter Page</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
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
            
           echo "</form>";
           
            echo "</div>";
            echo "</div>";
            echo "</div>";
}

?>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->