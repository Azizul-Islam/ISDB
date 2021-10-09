<?php echo breadcumb(["Purchase"]); ?>
<?php echo head_title("Purchase"); ?>
<?php
    if(isset($_POST["subBtn"])){
        $vendor_id=$_POST["cmbVendor"];
        $date=$_POST["txtDate"];
        $ref=$_POST["txtRef"];
        $data=new Purchase($vendor_id,$ref,$date);
        $data->insert_purchase();
        $message="<p class='alert alert-success'>Purchase added successfully!</p>";

    }
    if(isset($_POST["btnSaveChange"])){
       // print_r($_POST);
        $id=$_POST["txtId"];
        $vendor_id=$_POST["cmbVendor"];
        $date=$_POST["txtDate"];
        $ref=$_POST["txtRef"];

        $data=new Purchase($vendor_id,$ref,$date);
        $data->update_purchase($id);
        $message="<p class='alert alert-success'>Purchase update successfully!</p>";
    }
    if(isset($_POST["btnDel"])){
        $id=$_POST["txtId"];
        Purchase::delete_purchase($id);
        $message="<p class='alert alert-danger'>Purchase Deleted successfully!</p>";

    }

?>

<!-- add purchase with modal -->
<div class="modal fade" id="add-purchase">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add purchase</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="#" method="post" id="edit-form" enctype="multipart/form-data" role="form">
                    <div class="form-group">
                        <label>Vendor</label>
                        <select name="cmbVendor" id="cmbVendor" class="form-control">
                            <?php
                                $query=$db->query("select id,name from {$ex}vendor");
                                $arr=[];
                                while(list($id,$name)=$query->fetch_row()){
                                    $arr["$id"]=$name;
                                    echo "<option value='$id'>$name</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Purchase Date</label>
                        <input type="text" name="txtDate" id="datepicker" class="form-control" placeholder="Purchase Date">
                    </div>
                    <div class="form-group">
                        <label>Ref No</label>
                        <input type="text" name="txtRef" id="txtRef" class="form-control" placeholder="Ref No">
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

<!-- edit purchase with modal -->
<div class="modal fade" id="edit-purchase">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit purchase</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="#" method="post" id="edit-form" enctype="multipart/form-data" role="form">
                    <div class="form-group">
                        <label>Vendor</label>
                        <input type="hidden" name="txtId" id="txtId"/>
                        <select name="cmbVendor" id="cmbVendor" class="form-control">
                            <?php
                                $query=$db->query("select id,name from {$ex}vendor");
                                $arr=[];
                                while(list($id,$name)=$query->fetch_row()){
                                    $arr["$id"]=$name;
                                    echo "<option value='$id'>$name</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Purchase Date</label>
                        <input type="text" name="txtDate" id="txtDate" class="form-control" placeholder="Purchase Date">
                    </div>
                    <div class="form-group">
                        <label>Ref No</label>
                        <input type="text" name="txtRef" id="txtRef" class="form-control" placeholder="Ref No">
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
                        <input type="text" class="form-control" placeholder="Search Purchase">
                    </div>
                </form>
            </div>
            <div class="col-md-3">
                <a href="create-purchase-invoice">
                <button type="button" class="btn btn-primary"><i class="fa fa-user-plus" style="padding-right:5px"></i>Create Invoice</button>
                </a>
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
                                <th scope="col">Vendor Name</th>
                                <th scope="col">Ref No</th>
                                <th scope="col">Purchase Date</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $page=isset($_GET["p"])?$_GET["p"]:1; 
                                $purchases=PurchaseController::show_purchase($page,8);
                                while($pu=$purchases["data"]->fetch_object()){
                                echo "<tr>";
                                    echo "<td>$pu->id</td>";
                                    echo "<td>$pu->name</td>";
                                    echo "<td>$pu->ref_no</td>";
                                    echo "<td>$pu->purchase_date</td>";
                                    echo "<td>";
                                       echo "<form action='#' method='post'>";
                                          echo "<input type='hidden' name='txtId' value='$pu->id' />";
                                        //   $json=json_encode(["id"=>"$pu->id","vendor_id"=>"$pu->vendor_id","ref_no"=>"$pu->ref_no","purchase_date"=>"$pu->purchase_date"]);
                                        //     echo "<button type='button' class='btn btn-primary btn-sm btn-edit' data-toggle='modal' data-json='$json' data-id='$pu->id' data-target='#edit-purchase' name='btnEdit' value='edit'><i class='fa fa-edit'></i></button>";
                                        //     echo "<button type='submit' class='btn btn-danger btn-sm' name='btnDel' value='del'><i class='fa fa-trash'></i></button>";
                                            echo "<a href='purchase-invoice?id=$pu->id'>";
                                            echo "<button type='button' class='btn btn-primary btn-sm btn-details' name='btnDetails' value='details'>Details</button>";
                                            echo "</a>";
                                       echo "</form>";
                                    echo "</td>";
                                echo "</tr>";
                                }
	                        ?>
                        </tbody>
                    </table>
                    <?php 
                        echo $purchases["pagination"];
                    ?>

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
            $("#edit-form").find("#txtId").val(record.id);
            $("#edit-form").find("#txtDate").val(record.purchase_date);
            $("#edit-form").find("#txtRef").val(record.ref_no);
            $("#edit-form").find("#cmbVendor option").each(function(k,v){
                if(v.value==record.vendor_id){
                    $(this).attr("selected","selected")
                }
            });
        });
        $( "#datepicker" ).datepicker();
    });

</script>