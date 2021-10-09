<?php
// add vendor with modal
    if(isset($_POST["subBtn"])){
        $name=$_POST["txtName"];
        $phone=$_POST["txtPhone"];
        $address=$_POST["txtAddress"];

        $add=new Vendor($name,$phone,$address);
        $add->insert_vendor();
        //$message="<p class='alert alert-success'>Vendor Added Successfully!</p>";
        $message="<div class='alert alert-success alert-dismissible show' role='alert'>
	    Vendor Added Successfully!
	    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
		<span aria-hidden='true'>&times;</span>
	    </button>
	    </div>";
    }

// edit vendor with modal
    if(isset($_POST["btnSaveChange"])){
        $id=$_POST["txtId"];
        $name=$_POST["txtName"];
        $phone=$_POST["txtPhone"];
        $address=$_POST["txtAddress"];
        $update=new Vendor($name,$phone,$address);
        $update->update_vendor($id);
        //$message="<p class='alert alert-success'>Vendor Updated Successfully!</p>";
        $message="<div class='alert alert-success alert-dismissible show' role='alert'>
	    Vendor Updated Successfully!
	    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
		<span aria-hidden='true'>&times;</span>
	    </button>
	    </div>";

    }
    if(isset($_POST["btnDel"])){
        $id=$_POST["txtId"];
        Vendor::delete_vendor($id);
        //$message="<p class='alert alert-danger'>Vendor Deleted Successfully!</p>";
        $message="<div class='alert alert-warning alert-dismissible show' role='alert'>
	    Vendor Deleted Successfully!
	    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
		<span aria-hidden='true'>&times;</span>
	    </button>
	    </div>";
    }
?>

<?php echo breadcumb(["Vendor"]); ?>
<?php echo head_title("Vendor/Supplier"); ?>

<!-- add vendor with modal -->
<div class="modal fade" id="add-vendor">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add vendor</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="#" method="post" enctype="multipart/form-data" role="form">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="hidden" name="txtId" id="txtId" />
                        <input class="form-control" name="txtName" id="txtName" placeholder="Name">
                    </div>
                    <div class="form-group">
                        <label>Phone</label>
                        <input type="text" name="txtPhone" id="txtPhone" class="form-control" placeholder="Phone">
                    </div>
                    <div class="form-group">
                        <label>Address</label>
                        <textarea type="text" name="txtAddress" id="txtAddress" class="form-control" placeholder="Address.."></textarea>
                    </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <input type="submit" name="subBtn" class="btn btn-primary" value="Save changes" />
            </div>
        </div>
        </form>
    </div>
</div>

<!-- edit vendor with modal -->
<div class="modal fade" id="edit-vendor">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit vendor</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="#" method="post" id="edit-form" enctype="multipart/form-data" role="form">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="hidden" name="txtId" id="txtId" />
                        <input class="form-control" name="txtName" id="txtName" >
                    </div>
                    <div class="form-group">
                        <label>Phone</label>
                        <input type="text" name="txtPhone" id="txtPhone" class="form-control" >
                    </div>
                    <div class="form-group">
                        <label>Address</label>
                        <textarea type="text" name="txtAddress" id="txtAddress" class="form-control" ></textarea>
                    </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <input type="submit" name="btnSaveChange" class="btn btn-primary" value="Save changes" />
            </div>
        </div>
        </form>
    </div>
</div>


<div class="panel panel-default">
    <div class="panel panel-container">
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
                <button type="button" data-toggle="modal" data-target="#add-vendor" class="btn btn-primary"><i class="fa fa-user-plus" style="padding-right:5px"></i>Add vendor</button>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel-body">
                    <?php echo isset($message)?$message:""; ?>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Address</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $vendors=vendorController::show_vendor();
                                foreach($vendors as $v){
                                echo "<tr>";
                                    echo "<td>$v->id</td>";
                                    echo "<td>$v->name</td>";
                                    echo "<td>$v->phone</td>";
                                    echo "<td>$v->address</td>";
                                    echo "<td>";
                                       echo "<form action='#' method='post' onSubmit='return confirm(\"Are you sure?\")'>";
                                          echo "<input type='hidden' name='txtId' value='$v->id' />";
                                          $json=json_encode(["id"=>"$v->id","name"=>"$v->name","phone"=>"$v->phone","address"=>"$v->address"]);
                                            echo "<button type='button' class='btn btn-primary btn-sm btn-edit' data-toggle='modal' data-json='$json' data-id='$v->id' data-target='#edit-vendor' name='btnEdit' value='edit'><i class='fa fa-edit'></i></button>";
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
        <!--/.row-->
    </div>
</div>


<script>
    $(function() {
        $(".btn-edit").on("click",function() {
            let record = $(this).data("json");
            //console.log(record);
            $("#edit-form").find("#txtId").val(record.id);
            $("#edit-form").find("#txtName").val(record.name);
            $("#edit-form").find("#txtPhone").val(record.phone);
            $("#edit-form").find("#txtAddress").val(record.address);
        });
    });

</script>
