<?php
    class Vendor{
        private $name;
        private $phone;
        private $address;
        public function __construct($name,$phone,$address){
            $this->name=$name;
            $this->phone=$phone;
            $this->address=$address;
        }
        public function insert_vendor(){
            global $db;
            global $ex;
            $db->query("insert into {$ex}vendor(name,phone,address)values('$this->name','$this->phone','$this->address')");

        }
        public function update_vendor($id){
            global $db;
            global $ex;
            $db->query("update {$ex}vendor set name='$this->name',phone='$this->phone',address='$this->address' where id='$id'");

        }
        public function delete_vendor($id){
            global $db;
            global $ex;
            $db->query("delete from {$ex}vendor where id='$id'");
        }

    }
    class vendorView{
        public $id;
        public $name;
        public $phone;
        public $address;

        function __construct($id,$name,$phone,$address){
            $this->id=$id;
            $this->name=$name;
            $this->phone=$phone;
            $this->address=$address;
        }
    }
    class vendorController{
        
        public static function show_vendor(){
            global $db;
            global $ex;
            $data=[];
            $sql=$db->query("select id,name,phone,address from {$ex}vendor");
            while($v=$sql->fetch_object()){
                $v=new vendorView($v->id,$v->name,$v->phone,$v->address);
                array_push($data,$v);
            }
            return $data;
        }
    }
?>