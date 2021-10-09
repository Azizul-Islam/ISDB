<?php
    $name=["Azizul Islam","Nahid"];
    $age=24;
   // printf(is_string($age));
    $age1 = &$age;
    $age1="Goodbye";
    echo $age1;
?>