<?php session_start();
	if(!isset($_SESSION["s_id"])){
		header("location:index.php");
	}
?>
<?php require_once("lib/component.php"); ?>
<?php require_once("db_config.php"); ?>
<?php require_once("modal/userClass.php"); ?>
<?php require_once("modal/productClass.php"); ?>
<?php require_once("modal/vendorClass.php"); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Admin - Dashboard</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	
	<link href="css/font-awesome.min.css" rel="stylesheet">
	<link href="css/datepicker3.css" rel="stylesheet">
	<link rel="stylesheet" href="css/styles.css" >
	<link rel="stylesheet" href="css/invoice.css" >
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	
	<!--Custom Font-->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->
</head>
<body>

	<?php include("include/navbar.php"); ?>
	<?php include("include/sidebar.php"); ?>
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
	
	<?php
		if(isset($_GET["page"])){
			$page=$_GET["page"];
			if($page=="create-user"){
				include("pages/create_user.php");
			}elseif($page=="manage-user"){
				include("pages/manage_user.php");
			}elseif($page=="add-product"){
				include("inventory/add_product.php");
			}elseif($page=="product-list"){
				include("inventory/product_list.php");
			}elseif($page=="product-category"){
				include("inventory/product_category.php");
			}elseif($page=="supplier"){
				include("inventory/vendor.php");
			}elseif($page=="purchase"){
				include("inventory/purchase.php");
			}elseif($page=="create-purchase-invoice"){
				include("inventory/create_purchase_invoice.php");
			}elseif($page=="invoice"){
				include("inventory/invoice.php");
			}elseif($page=="purchase-invoice"){
				include("inventory/purchase_invoice.php");
			}
		}else{
			include("include/breadcumb.php");
			include("include/dashboard.php");
		}
	
	?>

	</div>	<!--/.main-->
	
	
	<!-- <script src="js/jquery-1.11.1.min.js"></script> -->
	<script src="js/bootstrap.min.js"></script>
	<script src="js/chart.min.js"></script>
	<script src="js/chart-data.js"></script>
	<script src="js/easypiechart.js"></script>
	<script src="js/easypiechart-data.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script src="js/custom.js"></script>
	<!-- <script>
		window.onload = function () {
	var chart1 = document.getElementById("line-chart").getContext("2d");
	window.myLine = new Chart(chart1).Line(lineChartData, {
	responsive: true,
	scaleLineColor: "rgba(0,0,0,.2)",
	scaleGridLineColor: "rgba(0,0,0,.05)",
	scaleFontColor: "#c5c7cc"
	});
};
	</script> -->
		
</body>
</html>