<?php
    class User{
        private $id;
        private $name;
        private $photo;
        private $role_id;
        private $password;
        private $active_status;
        
        public function __construct($name,$photo,$role_id,$password,$active_status){
            $this->name=$name;
            $this->photo=$photo;
            $this->role_id=$role_id;
            $this->password=$password;
            $this->active_status=$active_status;
        }
        public function insert_data(){
            global $db;
            global $ex;
            $md5=md5($this->password);
            $db->query("insert into {$ex}users(name,photo,role_id,password)values('$this->name','$this->photo','$this->role_id','$md5')");
            return $db->insert_id;
        }
        public static function delete_user($id){
            global $db;
            global $ex;
            $db->query("delete from {$ex}users where id='$id'");
           
        }
        public function update_user($id){
            global $db;
            global $ex;
            $md5=md5($this->password);
            $db->query("update {$ex}users set name='$this->name',photo='$this->photo',role_id='$this->role_id',password='$md5',active_status='$this->active_status' where id='$id'");
        }


    }
    class UserView{
        public $id;
        public $name;
        public $photo;
        public $role_id;
        public $password;
        public $active_status;

        function __construct($id,$name,$photo,$role_id,$role,$password,$active_status){
            $this->id=$id;
            $this->name=$name;
            $this->photo=$photo;
            $this->role_id=$role_id;
            $this->role=$role;
            $this->password=$password;
            $this->active_status=$active_status;
            
        }

    }
    class UserController{
        public static function get_user(){
        global $db;
        global $ex;
        $users=$db->query("select u.id,u.name,u.photo,u.role_id,u.password,u.active_status,r.name as role from {$ex}users u,{$ex}roles r where u.role_id=r.id");
        $data=[];
        while($user=$users->fetch_object()){
            $user=new UserView($user->id,$user->name,$user->photo,$user->role_id,$user->role,$user->password,$user->active_status);
            array_push($data,$user);
        }
        return $data;
        }
    }

    class Product{
       
        private $name;
        private $price;
        private $code;
        private $quantity;
        private $short_desc;
        private $photo;
        private $category_id;
        private $manufacturer;

        function __construct($name,$price,$code,$quantity,$short_desc,$photo,$category_id,$manufacturer){
            $this->name=$name;
            $this->price=$price;
            $this->code=$code;
            $this->quantity=$quantity;
            $this->short_desc=$short_desc;
            $this->photo=$photo;
            $this->category_id=$category_id;
            $this->manufacturer=$manufacturer;
            
        }
        public function insert_product(){
            global $db;
            global $ex;
            $products=$db->query("insert into {$ex}products(name,price,code,quantity,short_desc,photo,category_id,manufacturer)values('$this->name','$this->price','$this->code','$this->quantity','$this->short_desc','$this->photo','$this->category_id','$this->manufacturer')");
            return $db->insert_id;
        }

        public static function show_product($page=1,$per_page=10){
            global $ex;
            global $db;
            $top=($page-1)*$per_page;
            $products=$db->query("select p.id,p.name,p.price,p.code,p.quantity,p.short_desc,p.photo,c.category_name,p.category_id,p.manufacturer from {$ex}products p,{$ex}categories c where p.category_id=c.id order by p.id limit $top,$per_page");
            
            $total_rs=$db->query("select count(*) from {$ex}products");
            list($total)=$total_rs->fetch_row();   
            $total_page=ceil($total/$per_page);
  
            $table=["data"=>$products,"pagination"=>pagination($page,$total_page)];
            return $table;
        }



        // public static function show_product(){
        //     global $ex;
        //     global $db;

        //     $querys=$db->query("select p.id,p.name,p.price,p.code,p.quantity,p.short_desc,p.photo,c.category_name,p.category_id,p.manufacturer from {$ex}products p,{$ex}categories c where p.category_id=c.id");
        //     $data=[];
        //     while($query=$querys->fetch_object()){
        //         $u=new productView($query->id,$query->name,$query->price,$query->code,$query->quantity,$query->short_desc,$query->photo,$query->category_name,$query->category_id,$query->manufacturer);
        //         array_push($data,$u);
        //     }
        //     return $data;
        // }
        public static function delete_product($id){
            global $ex;
            global $db;
            $db->query("delete from {$ex}products where id='$id'");
        }
        public function update_product($id){
            global $db;
            global $ex;
            $data=$db->query("update {$ex}products set name='$this->name',price='$this->price',code='$this->code',quantity='$this->quantity',short_desc='
            $this->short_desc',photo='$this->photo',category_id='$this->category_id',manufacturer='$this->manufacturer' where id='$id'");
            print_r($data);
        }
    }

    class productView{
        public $id;
        public $name;
        public $price;
        public $code;
        public $quantity;
        public $short_desc;
        public $photo;
        public $category_name;
        public $category_id;
        public $manufacturer;
        

        function __construct($id,$name,$price,$code,$quantity,$short_desc,$photo,$category_name,$category_id,$manufacturer){
            $this->id=$id;
            $this->name=$name;
            $this->price=$price;
            $this->code=$code;
            $this->quantity=$quantity;
            $this->short_desc=$short_desc;
            $this->photo=$photo;
            $this->category_name=$category_name;
            $this->category_id=$category_id;
            $this->manufacturer=$manufacturer;
            
        }
    }



?>
