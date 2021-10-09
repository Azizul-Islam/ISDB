<?php
    abstract class Math{
        public function add($a,$b){
            return $a+$b;
        }
        abstract public function sub($x,$y);
    }
    class MyMath extends Math{
        public function sub($x,$y){
            return $x-$y;
        }
    }
    $obj=new MyMath();
    echo $obj->add(5,5);
    echo "<br>";
    echo $obj->sub(10,5);
    echo "<br>";
    echo process($obj);
    function process(MyMath $m){
        return $m->add(10,20);

    }
?>