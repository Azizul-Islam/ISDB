
<?php echo breadcumb(["Product Add"]); ?>
<?php echo head_title("Product Add"); ?>

<div class="panel panel-default">
    <div class="panel-heading">Forms</div>

    <?php
    if(isset($_POST["subBtn"])){
       // print_r($_POST);
       $name=$_POST["txtName"];
       $price=$_POST["txtPrice"];
       $code=$_POST["txtCode"];
       $quantity=$_POST["txtQty"];
       $desc=$_POST["txtDesc"];
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
        // elseif(!preg_match("/^[a-zA-z]{2,}$/",$name)){
        //     $errors["name"]="Please enter valid Name";
        // }
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
       //$message="<p class='alert alert-success'>Product added successfully</p>";
       $message="<div class='alert alert-success alert-dismissible show' role='alert'>
       Product added successfully!
	    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
		<span aria-hidden='true'>&times;</span>
	    </button>
	    </div>";
        }
       //header("location:products/product_list.php");
    }else{
        foreach($errors as $error){
            //echo "<p class='alert alert-danger'>$error</p>";
            echo "<div class='alert alert-warning alert-dismissible show' role='alert'>
            $error;
	        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
		    <span aria-hidden='true'>&times;</span>
	        </button>
	        </div>";
        }
    }
    }

?>


     <?php echo isset($message)?$message:"";?>
    <!--<?php echo isset($error)?$error:"";?> -->
    <div class="panel-body">
    <form action="#" method="post" enctype="multipart/form-data" role="form">
        <div class="col-md-6">
            
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" name="txtName" value="<?= isset($_POST["txtName"])?$_POST["txtName"]:""; ?>" placeholder="Placeholder">
                </div>
                <div class="form-group">
                    <label>Price</label>
                    <input type="text" name="txtPrice" class="form-control" value="<?= isset($_POST["txtPrice"])?$_POST["txtPrice"]:""; ?>" placeholder="Price">
                </div>
                <div class="form-group">
                    <label>Product Code</label>
                    <input type="text" name="txtCode" class="form-control" value="<?= isset($_POST["txtCode"])?$_POST["txtCode"]:""; ?>" placeholder="Code">
                </div>
                <div class="form-group">
                    <label>Product Quantity</label>
                    <input type="text" name="txtQty" class="form-control" value="<?= isset($_POST["txtQty"])?$_POST["txtQty"]:""; ?>" placeholder="Quantity">
                </div>
                <input type="submit" name="subBtn" value="Insert" class="btn btn-primary" />
                <button type="reset" class="btn btn-default">Reset</button>
        </div>

        <div class="col-md-6">
        <div class="form-group">
			<label>Short Description</label>
			<textarea name="txtDesc"  placeholder="Short Description..." class="form-control" rows="3"><?= isset($_POST["txtDesc"])?$_POST["txtDesc"]:""; ?></textarea>
		</div>
                <div class="form-group">
                    <label>Product Photo</label>
                    <input type="file" name="photo">
                </div>
                <div class="form-group">
                    <label>Categories</label>
                    <select name="cmbCategory" value="<?= isset($_POST["cmbCategory"])?$_POST["cmbCategory"]:""; ?>" class="form-control">
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
                    <input type="text" name="txtManu" class="form-control" value="<?= isset($_POST["txtManu"])?$_POST["txtManu"]:""; ?>" placeholder="Manufacturer">
                </div>
        </div>
       
        </form>
    </div>
</div><!-- /.panel-->