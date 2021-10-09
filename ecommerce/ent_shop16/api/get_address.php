<?php
require_once("../db_config.php");
    if(isset($_GET["vendor_id"])){
        $vendor_id=$_GET["vendor_id"];
        $vendor_rs=$db->query("select address from {$ex}vendor where id='$vendor_id'");
        $row=$vendor_rs->fetch_object();
        echo $row->address;
        
    }

?>