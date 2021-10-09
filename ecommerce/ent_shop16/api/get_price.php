<?php
    require_once("../db_config.php");
    if(isset($_GET["product_id"])){
        $product_id=$_GET["product_id"];
        $price_rs=$db->query("select cost from {$ex}purchasedetails where product_id='$product_id' order by id desc limit 1");
        $row=$price_rs->fetch_object();
        echo $row->cost;
        die();
    }
    echo "0";

?>