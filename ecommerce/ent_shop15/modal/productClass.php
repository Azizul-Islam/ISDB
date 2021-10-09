<?php
    class Category{
        private $id;
        private $category_name;
        public function __construct($category_name){
            $this->category_name=$category_name;
        }
        public static function delete_category($id){
            global $db;
            global $ex;
            $db->query("delete from {$ex}categories where id='$id'");
        }
        public function insert_category(){
            global $db;
            global $ex;
            $db->query("insert into {$ex}categories(category_name)values('$this->category_name')");
        }
        public function category_update($id){
            global $db;
            global $ex;
            $db->query("update {$ex}categories set category_name='$this->category_name' where id='$id'");
        }
    }
    class categoryView{
        public $id;
        public $category_name;
        public function __construct($id,$category_name){
            $this->id=$id;
            $this->category_name=$category_name;
        }
    }
    class categoryController{
        public static function show_category(){
            global $db;
            global $ex;
            $data=[];
            $query=$db->query("select id,category_name from {$ex}categories");
            while($q=$query->fetch_object()){
                $q=new categoryView($q->id,$q->category_name);
                array_push($data,$q);
            }
            return $data;
        }
    }
    class Purchase{
        private $vendor_id;
        private $ref_no;
        private $purchase_date;

        // private $purchase_id;
        private $product_id;
        private $Qty;
        private $cost;

        public function __construct($vendor_id,$ref_no,$purchase_date,$product_id,$Qty,$cost){
            $this->vendor_id=$vendor_id;
            $this->ref_no=$ref_no;
            $this->purchase_date=$purchase_date;

            // $this->purchase_id= $purchase_id;
            $this->product_id=$product_id;
            $this->Qty=$Qty;
            $this->cost=$cost;
        }
        
       
        public function insert_purchase(){
            global $db;
            global $ex;
            $db->query("insert into {$ex}purchase(vendor_id,ref_no,purchase_date)values('$this->vendor_id','$this->ref_no','$this->purchase_date')");
            $purchase_id=$db->insert_id;
            $db->query("insert into {$ex}purchasedetails(purchase_id,product_id,Qty,cost)values($purchase_id,'$this->product_id','$this->Qty','$this->cost')");
        }
        public function update_purchase($id){
            global $db;
            global $ex;
            $db->query("update {$ex}purchase set vendor_id='$this->vendor_id',ref_no='$this->ref_no',purchase_date='$this->purchase_date' where id='$id'");
            
        }
        public static function delete_purchase($id){
            global $db;
            global $ex;
            $db->query("delete from {$ex}purchase where id='$id'");
        }
    }
    class PurchaseView{
        public $id;
        public $vendor_id;
        public $vendor_name;
        public $ref_no;
        public $purchase_date;
        function __construct($id,$vendor_id,$vendor_name,$ref_no,$purchase_date){
            $this->id=$id;
            $this->vendor_id=$vendor_id;
            $this->vendor_name=$vendor_name;
            $this->ref_no=$ref_no;
            $this->purchase_date=$purchase_date;
        }
    }
    class PurchaseController{
        // public static function show_purchase(){
        //     global $db;
        //     global $ex;
        //     $query=$db->query("select pu.id,pu.vendor_id,v.name,pu.ref_no,pu.purchase_date from {$ex}purchase pu,{$ex}vendor v where pu.vendor_id=v.id order by pu.id");
        //     $data=[];
        //     while($p=$query->fetch_object()){
        //         $p=new PurchaseView($p->id,$p->vendor_id,$p->name,$p->ref_no,$p->purchase_date);
        //         array_push($data,$p);
        //     }
        //     return $data;
        // }

        public static function show_purchase($page=1,$per_page=10){
            global $db;
            global $ex;
            $top=($page-1)*$per_page;
            $purchases=$db->query("select pu.id,pu.vendor_id,v.name,pu.ref_no,pu.purchase_date from {$ex}purchase pu,{$ex}vendor v where pu.vendor_id=v.id order by pu.id limit $top,$per_page");
            
            $total_rs=$db->query("select count(*) from {$ex}purchase");
            list($total)=$total_rs->fetch_row();
            $total_page=ceil($total/$per_page);
            $table=["data"=>$purchases,"pagination"=>pagination($page,$total_page)];
            return $table;


            while($p=$query->fetch_object()){
                $p=new PurchaseView($p->id,$p->vendor_id,$p->name,$p->ref_no,$p->purchase_date);
                array_push($data,$p);
            }
            return $data;
        }
    }
    

?>