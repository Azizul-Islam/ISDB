<?php

    if(isset($_POST["subBtn"])){
        $name=$_POST["txtName"];
        $email=$_POST["txtEmail"];
        
        file_put_contents("store.txt","$name,$email".PHP_EOL,FILE_APPEND);

    }
?>