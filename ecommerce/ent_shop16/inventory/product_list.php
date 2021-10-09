<?php echo breadcumb(["Product List"]); ?>
<?php echo head_title("Product List"); ?>
<?php 
    if(isset($_POST["btnDel"])){
        //print_r($_POST);
        $id=$_POST["txtId"];
        Product::delete_product($id);
        //$message="<p class='alert alert-danger'>Deleted successfully</p>";
        $message="<div class='alert alert-warning alert-dismissible show' role='alert'>
	    Deleted successfully!
	    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
		<span aria-hidden='true'>&times;</span>
	    </button>
	    </div>";
    }

    // edit with modal

    if(isset($_POST["btnSaveChange"])){
        //print_r($_POST);
        $id=$_POST["txtId"];
        $name=$_POST["txtName"];
        $price=$_POST["txtPrice"];
        $code=$_POST["txtCode"];
        $quantity=$_POST["txtQty"];
        $desc=$_POST["txtDesc"];
        $category_id=$_POST["cmbCategory"];
        $manufacturer=$_POST["txtManu"];
        
       
        if(isset($_FILES["photo"]["name"])){
         $file_name=$_FILES["photo"]["name"];
         $temp_name=$_FILES["photo"]["tmp_name"];
         move_uploaded_file($temp_name,"images/products/".$file_name);
     }
     
        $data=new Product($name,$price,$code,$quantity,$desc,$file_name,$category_id,$manufacturer);
        $data->update_product($id);
        //$message="<p class='alert alert-success'>Product Updated successfully</p>";
        $message="<div class='alert alert-success alert-dismissible show' role='alert'>
	    Product Updated successfully.
	    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
		<span aria-hidden='true'>&times;</span>
	    </button>
	    </div>";
    }
?>


<?php
// add product with modal
if(isset($_POST["subBtn"])){
    // print_r($_POST);
    $name=$_POST["txtName"];
    $price=$_POST["txtPrice"];
    $code=$_POST["txtCode"];
    $quantity=$_POST["txtQty"];
    $desc=trim($_POST["txtDesc"]);
    $category=$_POST["cmbCategory"];
    $manufacturer=$_POST["txtManu"];
    $errors=[];
    $valid_type=["image/jpeg","image/jpg","image/png","image/gif"];
    
    if(isset($_FILES["photo"]["name"])){
         //$selected_type=[$_FILES["photo"]["type"]];
     //if(in_array($selected_type,$valid_type)){
         $file_size=$_FILES["photo"]["size"];
     if($file_size/1000<=200){
         $file_name=$_FILES["photo"]["name"];
         $temp_name=$_FILES["photo"]["tmp_name"];
         move_uploaded_file($temp_name,"images/products/".$file_name);
     }else{
         $errors["photo_size"]="Invalid file size";
     }
     // }else{
     //     $errors["photo_type"]="Invalid file type";
     // }
 }

     if(empty($_POST["txtName"])){
         $errors["empty_name"]="Name field is required";
      }
      //elseif(!preg_match("/^[a-zA-z]{2,}$/",$name)){
    //      $errors["name"]="Please enter valid Name";
    //  }
     if(empty($_POST["txtPrice"])){
         $errors["empty_price"]="Price field is required";
     }elseif(!preg_match("/^[0-9]{1,}[.]?[0-9]{1,}$/",$price)){
         $errors["id"]="Please enter numeric price field";
     }
    if(empty($_POST["txtQty"])){
     $errors["empty_qty"]="Quantity field is required";
    }elseif(!preg_match("/^[0-9]{1,}$/",$quantity)){
        $errors["quantity"]="Please enter numeric quantity";
    }
    if(count($errors)==0){
    $data=new Product($name,$price,$code,$quantity,$desc,$file_name,$category,$manufacturer);
    if($data){
    $data->insert_product();
    unset($_POST);
    $message="<p class='alert alert-success'>Product added successfully</p>";
     }
    //header("location:products/product_list.php");
 }else{
     echo "<ul>";
     foreach($errors as $error){
         echo "<li class='text-danger'>$error</lo>";
     }
     echo "</ul>";
 }
 }

?>

<!-- add product with modal -->
<div class="modal" id="product-add">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form action="#" method="post" enctype="multipart/form-data" role="form">
                <div class="modal-header">
                    <h4 class="modal-title">Edit product</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="hidden" class="form-control" name="txtId" id="txtId" placeholder="Placeholder">
                                    <input type="text" required class="form-control" name="txtName" id="txtName" value="<?= isset($_POST["txtName"])?$_POST["txtName"]:""; ?>" placeholder="Placeholder">
                                </div>
                                <div class="form-group">
                                    <label>Price</label>
                                    <input type="text" name="txtPrice" id="txtPrice" class="form-control" value="<?= isset($_POST["txtPrice"])?$_POST["txtPrice"]:""; ?>" placeholder="Price">
                                </div>
                                <div class="form-group">
                                    <label>Product Code</label>
                                    <input type="text" name="txtCode" id="txtCode" value="<?= isset($_POST["txtCode"])?$_POST["txtCode"]:""; ?>" class="form-control" placeholder="Code">
                                </div>
                                <div class="form-group">
                                    <label>Product Quantity</label>
                                    <input type="text" name="txtQty" id="txtQty" class="form-control" value="<?= isset($_POST["txtQty"])?$_POST["txtQty"]:""; ?>" placeholder="Quantity">
                                </div>

                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Short Description</label>
                                    <textarea name="txtDesc" id="txtDesc" placeholder="Short Description..." class="form-control" rows="3"><?= isset($_POST["txtDesc"])?$_POST["txtDesc"]:""; ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Product Photo</label>
                                    <input type="file" name="photo">
                                </div>
                                <div class="form-group">
                                    <label>Categories</label>
                                    <select name="cmbCategory" id="cmbCategory"  class="form-control">
                                        <?php
                            $data=$db->query("select id,category_name from {$ex}categories");
                            $arr=[];
                            while(list($id,$name)=$data->fetch_row()){
                                $arr[$id]=$name;
                                echo "<option value='$id'>$name</option>";
                            }
                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Manufacturer</label>
                                    <input type="text" name="txtManu" id="txtManu" value="<?= isset($_POST["txtManu"])?$_POST["txtManu"]:""; ?>" class="form-control" placeholder="Manufacturer">
                                </div>
                            </div>


                        </div>
                    </div><!-- /.panel-->
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <!-- <button type="submit" name="subBtn" class="btn btn-primary" value="Save changes" ></button> -->
                    <input type="submit" name="subBtn" class="btn btn-primary" value="Save changes" />
                </div>
            </form>
        </div>
    </div>
</div>

<!-- edit product modal start -->
<div class="modal" id="product-edit">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form action="#" method="post" id="edit-form" enctype="multipart/form-data" role="form">
                <div class="modal-header">
                    <h4 class="modal-title">Edit product</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="hidden" class="form-control" name="txtUserId" id="txtUserId" value="1" placeholder="Placeholder">
                                    <input type="hidden" class="form-control" name="txtId" id="txtId" placeholder="Placeholder">
                                    <input type="text" class="form-control" name="txtName" id="txtName" placeholder="Placeholder">
                                </div>
                                <div class="form-group">
                                    <label>Price</label>
                                    <input type="text" name="txtPrice" id="txtPrice" class="form-control" placeholder="Price">
                                </div>
                                <div class="form-group">
                                    <label>Product Code</label>
                                    <input type="text" name="txtCode" id="txtCode" class="form-control" placeholder="Code">
                                </div>
                                <div class="form-group">
                                    <label>Product Quantity</label>
                                    <input type="text" name="txtQty" id="txtQty" class="form-control" placeholder="Quantity">
                                </div>

                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Short Description</label>
                                    <textarea name="txtDesc" id="txtDesc" placeholder="Short Description..." class="form-control" rows="3"></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Product Photo</label>
                                    <input type="file" name="photo">
                                </div>
                                <div class="form-group">
                                    <label>Categories</label>
                                    <select name="cmbCategory" id="cmbCategory" class="form-control">
                                        <?php
                            $data=$db->query("select id,category_name from {$ex}categories");
                            $arr=[];
                            while(list($id,$name)=$data->fetch_row()){
                                $arr[$id]=$name;
                                echo "<option value='$id'>$name</option>";
                            }
                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Manufacturer</label>
                                    <input type="text" name="txtManu" id="txtManu" class="form-control" placeholder="Manufacturer">
                                </div>
                            </div>


                        </div>
                    </div><!-- /.panel-->
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <input type="submit" name="btnSaveChange" class="btn btn-primary" value="Save changes" />
                </div>
            </form>
        </div>
    </div>
</div>
<!-- edit product modal end -->

<!-- add product button & search -->
<div class="row">
    <div class="col-md-6"></div>
    <div class="col-md-3">
        <form role="search">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Search User">
            </div>
        </form>
    </div>
    <div class="col-md-3">
        <button style="float:right" type="button" data-toggle="modal" data-target="#product-add" class="btn btn-primary  add-btn"><i class="fa fa-user-plus" style="padding-right:5px"></i>Add Product</button>
    </div>
</div>


<div class="panel panel-default">

    <?= isset($message)?$message:""; ?>
    <table class="table table-bordered">

        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Price</th>
                <th scope="col">Code</th>
                <th scope="col">Quantity</th>
                <th scope="col">Photo</th>
                <th scope="col">Category</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
        $page=isset($_GET["p"])?$_GET["p"]:1;                        
        $products=Product::show_product($page,10);
        while($p=$products["data"]->fetch_object()){
            
            echo "<tr>";
                echo "<td>$p->id</td>";
                echo "<td>$p->name</td>";
                echo "<td>$p->price </td>";
                echo "<td>$p->code</td>";
                echo "<td>$p->quantity</td>";
                echo "<td>";
                echo "<img src='images/products/$p->photo' title='Product-photo' width='50' width='50' />";
                echo "</td>";
                echo "<td>$p->category_name</td>";
                echo "<td>";
                echo "<form action='#' method='post' onSubmit='return confirm(\"Are you sure?\")'>";
                echo "<input type='hidden' name='txtId' value='$p->id' />";
                $json=json_encode(["id"=>"$p->id","name"=>"$p->name","price"=>"$p->price","code"=>"$p->code","quantity"=>"$p->quantity","short_desc"=>"$p->short_desc","category_id"=>"$p->category_id","manufacturer"=>"$p->manufacturer"]);
                echo "<button type='button' class='btn btn-primary btn-sm btn-edit' data-toggle='modal' data-json='$json' data-id='$p->id' data-target='#product-edit' name='btnEdit' value='edit'><i class='fa fa-edit'></i></button>";
                
                echo "<button type='submit' class='btn btn-danger btn-sm' name='btnDel' value='del'><i class='fa fa-trash'></i></button>";
                echo "</form>";
                echo "</td>";
                
                echo "</tr>";
        }
        ?>
        </tbody>
    </table>
    <?php 
        echo $products["pagination"];
    ?>
</div>







<script>
 $(function(){
    $(".btn-edit").on("click",function(){
      let record= $(this).data("json");
      //console.log(record);
      //alert(record.name);
      $("#edit-form").find("#txtId").val(record.id)
      $("#edit-form").find("#txtName").val(record.name)
      $("#edit-form").find("#txtPrice").val(record.price)
      $("#edit-form").find("#txtCode").val(record.code)
      $("#edit-form").find("#txtQty").val(record.quantity)
      $("#edit-form").find("#txtDesc").val(record.short_desc)
      $("#edit-form").find("#cmbCategory").val(record.category_id)
      $("#edit-form").find("#txtManu").val(record.manufacturer)
      $("#edit-form").find("#cmbCategory option").each(function(k,v){
        if(v.value==record.category_id){
          $(this).attr("selected","selected")
        }
      });
  });
 });  


  </script>
