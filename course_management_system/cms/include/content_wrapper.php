<div class="content-wrapper">
   <?php
    if(isset($_GET["page"])){
      
      $page = $_GET["page"];
      if($page=="create-contat"){
        include("pages/create_contact.php");
      }elseif($page=="manage-contact"){
        include("pages/manage_contact.php");
      }
      elseif($page=="manage-user"){
        include("pages/manage_user.php");
      }
      elseif($page=="create-user"){
        include("pages/contact_user.php");
      }
      elseif($page=="help"){
        include("pages/help.php");
      }
      elseif($page=="dashboard"){
        include("pages/dashboard.php");
      }
      elseif($page=="contact"){
        include("pages/contact.php");
      }elseif($page=="edit-contact"){
        include("pages/edit_contact.php");
      }
    }else{
      include("pages/dashboard.php");
    }


   ?>
  </div>