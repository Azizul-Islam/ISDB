<?php

class Product{
   //private $id;
   private $title;
   private $price;
   private $user_id; 
   private $inactive;
   
   function __construct($title,$price,$user_id,$inactive){      
      $this->title=$title;
      $this->price=$price;
      $this->user_id=$user_id;  
      $this->inactive=$inactive;
   }
  public function save(){
    global $db;
    global $ex;
   
    $db->query("insert into {$ex}courses(title,price,user_id)values('$this->title','$this->price','$this->user_id')");
    return $db->insert_id; 
  }  

  public function update($id){
   global $db;
   global $ex;

   $sql="update {$ex}courses set title='$this->title',price='$this->price',user_id='$this->user_id',inactive='$this->inactive' where id='$id'";
   $db->query($sql);
   
   //file_put_contents("sql.txt",$sql);
   
   return $id;
  }

 public static function delete($id){
     global $db;
     global $ex;

     $db->query("delete from {$ex}courses where id='$id'");
 }

public static function get_products($page=1,$per_page=10){

   global $db;
   global $ex;   
   
   $top=($page-1)*$per_page;
   $sql="select p.id,p.title,p.price,p.user_id uid from {$ex}courses p  order by p.id limit $top,$per_page";   
   $products=$db->query($sql);


   $total_rs=$db->query("select count(*) from {$ex}courses");
   list($total)=$total_rs->fetch_row();   
   $total_page=ceil($total/$per_page);
  
   $table=["data"=>$products,"pagination"=>pagination($page,$total_page)];

   return $table;

}


}//end class

