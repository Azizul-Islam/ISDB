<?php
    class User{
        private $id;
        private $username;
        private $passowrd;
        private $role_id;

        public function __construct($username,$passowrd,$role_id){
            
            $this->username=$username;
            $this->password=$passowrd;
            $this->role_id=$role_id;
        }
        public function insert_data(){
            global $db;
            global $ex;
            $md5=md5($this->password);
            $db->query("insert into {$ex}users (username,password,role_id)values('$this->username','$md5','$this->role_id')");
            return $db->insert_id;
        }
        public function update($id){
            global $db;
            global $ex;
            $md5=md5($this->password);
            $sql="update {$ex}users set username='$this->username',password='$md5',role_id='$this->role_id' where id='$id'";
            $db->query($sql);
            return $id;
        }
        public static function delete_data($id){
            global $db;
            global $ex;
            $db->query("delete from {$ex}users where id='$id'");
        }
    }
    class UserView{
        public $id;
        public $username;
        public $passowrd;
        public $role_id;
        public $role_name;

        public function __construct($id,$username,$passowrd,$role_id,$role_name){
            $this->id=$id;
            $this->username=$username;
            $this->password=$passowrd;
            $this->role_id=$role_id;
            $this->role_name=$role_name;
        }
    }

    class UserController{
        public static function get_user(){
            global $db;
            global $ex;

            $sql="select u.id,u.username,u.password,u.role_id,r.name role from {$ex}users u,{$ex}roles r where r.id=u.role_id";
            //file_put_contents('db.txt',$sql);
            $users=$db->query($sql);
            $data=[];
            /*
            while(list($id,$username,$password,$role_id,$role)=$users->fetch_row()){
                $user=new UserView($id,$username,$password,$role_id,$role);
                array_push($data,$user);
            }
            */
            while($user=$users->fetch_object()){
                $user=new UserView($user->id,$user->username,$user->password,$user->role_id,$user->role);
                array_push($data,$user);
            }
            return $data;
        }
    }

?> 