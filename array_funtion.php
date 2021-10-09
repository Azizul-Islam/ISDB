<?php
    //range()
    $number = range(0,20,2);
    //$number = array(1,2,3,4,5,6,7,8,9,10);
   print_r($number)."<br>";

   //is_array()
   $states =["Florida"];
   $state = "Ohio";
   printf("\$states is an array: %s<br>",(is_array($states)?"True":"FALSE"))."<br>";
   printf("\$state is an array: %s<br>",(is_array($state)?"TRUE":"FALSE"));
?>