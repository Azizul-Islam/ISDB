
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="images/main_logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Phone Book</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <?php 
        $file = file("user.txt");
        foreach($file as $user){
        list($id,$name,$password,$image,$inactive) = explode(",",$user);
      }

      echo "<div class='user-panel mt-3 pb-3 mb-3 d-flex'>";
        echo "<div class='image'>";
          echo "<img  class='img-circle elevation-2' alt='User Image' src='";
          echo "images/user/";
          echo $_SESSION['s_image'];
          echo "'/>";
        echo "</div>";
        echo "<div class='info'>";
         echo "<a href='#' class='d-block'>".$_SESSION['s_userName']."</a>";

        echo "</div>";
      echo "</div>";
    ?>
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
               <li class="nav-item">
                <a href="dashboard" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>Dashboard</p>
                </a>
            </li>
          <li class="nav-item has-treeview">
          
            <a href="#" class="nav-link">
            <i class="fas fa-address-book nav-icon"></i>
              <p>
                Phone Book
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="home.php?page=create-contat" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Create Contact</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="manage-contact" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage Contact</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
            <i class="nav-icon fas fa-user-cog"></i>
              <p>
                System
                </i><i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="create-user" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Create User</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="manage-user" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage User</p>
                </a>
              </li>
            </ul>
            
          </li>
            <li class="nav-item">
                <a href="help" class="nav-link">
                <i class="fab fa-hire-a-helper nav-icon"></i>
                  <p>Help</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="logout.php" class="nav-link">
                <i class="fas fa-sign-out-alt nav-icon"></i>
                  <p>Logout</p>
                </a>
            </li>
        </ul>
        
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>