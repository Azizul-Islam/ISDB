<?php 
    interface IShape{
        public function get_area();
    }
    class Rectangle implements IShape{
        public $height;
        public $width;

        public function __construct($h,$w){
            $this->height = $h;
            $this->width = $w;
        }
        public function get_area(){
            return $this->height*$this->width;
        }
    }
    class Circle implements IShape{
        const PI=3.1416;
        public $r;

        public function __construct($r){
            $this->r= $r;
        }
        public function get_area(){
            return $this::PI*$this->r*$this->r;
        }
    }
    $obj1 = new Circle(2);
    $obj = new Rectangle(5,6);
    echo $obj->get_area();
    echo "<br>";
    echo $obj1->get_area();



?>