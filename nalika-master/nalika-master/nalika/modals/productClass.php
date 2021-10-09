<?php
    class Product{
        private $id;
        private $name;
        private $price;
        private $quantity;
        private $short_desc;
        private $image;
        private $category_id;
        private $product_stock;
        private $brand_id;

        function __construct($name,$price,$quantity,$short_desc,$image,$category_id,$product_stock,$brand_id){
            $this->name=$name;
            $this->price=$price;
            $this->quantity=$quantity;
            $this->image=$image;
            $this->category_id=$category_id;
            $this->product_stock=$product_stock;
            $this->brand_id=$brand_id;
        }
        public function save(){
            global $db;
            global $ex;
            $products=$db->query("insert into {$ex}products(name,price,quantity,short_desc,image,category_id,product_stock,brand_id)values('$this->name','$this->price','$this->quantity','$this->short_desc','$this->image','$this->category_id','$this->product_stock','$this->brand_id')");
            return $db->insert_id;
        }
        public static function show_product(){
            global $ex;
            global $db;

            $querys=$db->query("select id,name,price,quantity,product_stock from {$ex}products");
            $data=[];
            while($query=$querys->fetch_object()){
                $u=new productView($query->id,$query->name,$query->price,$query->quantity,$query->product_stock);
                array_push($data,$u);
            }
            return $data;
        }
        public static function delete_product($id){
            global $ex;
            global $db;
            $db->query("delete from {$ex}products where id='$id'");
        }
    }

    class productView{
        public $id;
        public $name;
        public $price;
        public $quantity;
        public $product_stock;
        

        function __construct($id,$name,$price,$quantity,$product_stock){
            $this->id=$id;
            $this->name=$name;
            $this->price=$price;
            $this->quantity=$quantity;
            $this->product_stock=$product_stock;
        }
    }

?>