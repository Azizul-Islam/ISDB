<?php echo breadcumb(["Product Category"]); ?>
<?php echo head_title("Product Category"); ?>

<?php

    if(isset($_POST["subBtn"])){
        //print_r($_POST);
        $category_name=$_POST["txtCategory"];
        $data=new Category($category_name);
        $errors=[];
        if(empty($_POST["txtCategory"])){
            $errors["txtCategory"]="Category Fiel is required";
        }
        if(count($errors)==0){
        $data->insert_category();
        //$message="<p class='alert alert-success'>Category Deleted Successfully!</p>";
        $message="<div class='alert alert-success alert-dismissible show' role='alert'>
        Category added Successfully!
	    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
		<span aria-hidden='true'>&times;</span>
	    </button>
	    </div>";
        }else{
            foreach($errors as $error){
                echo "<p class='alert alert-danger'>$error</p>";
            }
        }
    }
    if(isset($_POST["btnDel"])){
        $id=$_POST["txtId"];
        Category::delete_category($id);
        //$message="<p class='alert alert-danger'>Category Deleted Successfully!</p>";
        $message="<div class='alert alert-warning alert-dismissible show' role='alert'>
        Category Deleted Successfully!
	    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
		<span aria-hidden='true'>&times;</span>
	    </button>
	    </div>";
    }
    if(isset($_POST["btnSaveChange"])){
       // print_r($_POST);
       $id=$_POST["txtId"];
       $category_name=$_POST["txtName"];
       $update=new Category($category_name);
       $update->category_update($id);
       //$message="<p class='alert alert-success'>Category Updated Successfully!</p>";
       $message="<div class='alert alert-success alert-dismissible show' role='alert'>
       Category Updated Successfully!
	    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
		<span aria-hidden='true'>&times;</span>
	    </button>
	    </div>";
    }

?>

<!-- add category & search -->
<!-- <div class="row">
    <div class="col-md-6"></div>
    <div class="col-md-3">
        <form role="search">
            <div class="form-group">
                <input type="text" class="form-control" placeholder="Search category">
            </div>
        </form>
    </div>
    <div class="col-md-3">
        <button style="float:right" type="button" data-toggle="modal" data-target="#product-add" class="btn btn-success  add-btn">Add Category</button>
    </div>
</div> -->

<div class="modal" id="edit-category">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit category</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" >
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form action="#" id="edit-form" method="post" role="search">
                <div class="form-group">
                    <label>Category Name</label>
                    <input type="hidden" name="txtId" id="txtId" />
                    <input text="text" class="form-control" name="txtName" id="txtName" placeholder="Category Name">
                </div>
            
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <input type="submit" name="btnSaveChange" class="btn btn-primary" value="Save changes" />
            </div>
            </form>
        </div>
    </div>
</div>

<div class="panel panel-default">
    <div class="panel panel-container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <form action="#" method="post" role="search">
                            <div>
                                <input type="text" name="txtCategory" placeholder="Add category">
                                <input type="submit" name="subBtn" class="btn btn-primary btn-lg" value="Add">
                            </div>
                        </form>
                    </div>
                    <div class="panel-body">
                        <?php echo isset($message)?$message:""; ?>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Category Name</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                $categories=categoryController::show_category();
                                foreach($categories as $c){
                                echo "<tr>";
                                    echo "<td>$c->id</td>";
                                    echo "<td>$c->category_name</td>";
                                    echo "<td>";
                                       echo "<form action='#' method='post' onSubmit='return confirm(\"Are you sure?\")'>";
                                          echo "<input type='hidden' name='txtId' value='$c->id' />";
                                          $json=json_encode(["id"=>"$c->id","category_name"=>"$c->category_name"]);
                                            echo "<button type='button' class='btn btn-primary btn-sm btn-edit' data-toggle='modal' data-json='$json' data-id='$c->id' data-target='#edit-category' name='btnEdit' value='edit'><i class='fa fa-edit'></i></button>";
                                            echo "<button type='submit' class='btn btn-danger btn-sm' name='btnDel' value='del'><i class='fa fa-trash'></i></button>";
                                       echo "</form>";
                                    echo "</td>";
                                echo "</tr>";
                                }
	                        ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
        <!--/.row-->
    </div>
</div>

<script>
    $(function(){
        $(".btn-edit").on("click",function(){
            let record=$(this).data("json");
            //console.log(record);
            $("#edit-form").find("#txtId").val(record.id)
            $("#edit-form").find("#txtName").val(record.category_name)
        });
    });
</script>