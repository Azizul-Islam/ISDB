<div class="content-wrapper">
    
    <?php
       
       if(isset($_GET["page"])){

           $page=$_GET["page"];

           if($page=="create-contact"){              
              include("pages/create_contact.php");
           }elseif($page=="manage-contact"){
              include("pages/manage_contact.php");
           }elseif($page=="create-user"){
              include("pages/create_user.php");
           }elseif($page=="manage-user"){
              include("pages/manage_user.php");
           }elseif($page=="contact"){
              include("pages/contact.php");
           }elseif($page=="home"){
              include("pages/dashboard.php");
           }elseif($page=="manage-product"){
             include("pages/manage_product.php");
           }elseif($page=="create-purchase-invoice"){
            include("pages/purchase_invoice.php");
          }

            
       }else{
            
          include("pages/dashboard.php");
             
       }
    
    ?>
    
</div>