<?php
    interface a{
        const a ="Interface constant"; 
    }
    
    class b implements a{
        const b= "Class Constant";
    }
    $obj = new b;
    echo $obj->a::b;


?>