<?php session_start();
   if(!isset($_SESSION["s_id"])){
     header("location:index.php");
   }
?>
<?php require_once("db_config.php")?>
<?php require_once("lib/components.php") ?>

<?php require_once("models/User.class.php") ?>
<?php require_once("models/Product.class.php") ?>

<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>COURSE MANAGEMENT | HOME</title>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="asset/AdminLTE-3.0.5/plugins/fontawesome-free/css/all.min.css">
   <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    
  <link rel="stylesheet" href="asset/AdminLTE-3.0.5/dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
    <?php include("include/navbar.php")?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
    <?php  include("include/main_sidebar.php")?>

  <!-- Content Wrapper. Contains page content -->
    <?php include("include/content_wrapper.php")?>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
   <?php include("include/control_sidebar.php")?>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <?php  include("include/footer.php")?>

</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="asset/AdminLTE-3.0.5/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="asset/AdminLTE-3.0.5/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="asset/AdminLTE-3.0.5/dist/js/adminlte.min.js"></script>
</body>
</html>
