<?php session_start();
  if(!isset($_SESSION["s_id"])){
    header("location:index.php");
  }


?>

<?php require_once("libaray/component.php"); ?>
<?php require_once("modals/UserClass.php"); ?>
<?php require_once("db_config.php"); ?>


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

  <title>Phone Book | Starter</title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="assets/AdminLTE-3.0.5/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/AdminLTE-3.0.5/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="assets/AdminLTE-3.0.5/dist/css/style.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
    <?php include("include/navbar.php"); ?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php include("include/sidebar.php"); ?>

  <!-- Content Wrapper. Contains page content -->
  <?php include("include/content_wrapper.php"); ?>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <?php include("include/control_sidebar.php"); ?>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <?php include("include/footer.php"); ?>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="assets/AdminLTE-3.0.5/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="assets/AdminLTE-3.0.5/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="assets/AdminLTE-3.0.5/dist/js/adminlte.min.js"></script>
</body>
</html>
