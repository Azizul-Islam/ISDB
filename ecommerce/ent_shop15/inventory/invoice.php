<?php echo breadcumb(["Invoice"]); ?>
<?php echo head_title("Invoice"); ?>
<?php
    if(isset($_POST["subBtn"])){
        //print_r($_POST);
        $vendor_id=$_POST["cmbVendor"];
        $date=$_POST["txtDate"];
        $ref=$_POST["txtRef"];

        $product_id=$_POST["cmbProduct"];
        $cost=$_POST["txtCost"];
        $qty=$_POST["txtQty"];

        $data=new Purchase($vendor_id,$ref,$date,$product_id,$qty,$cost);
        $data->insert_purchase();
        $message="<p class='alert alert-success'>Purchase added successfully!</p>";
    }
?>

<div class="panel panel-default">
    <div class="panel panel-container">
    <div class="panel-body">
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
                <button type="button" data-toggle="modal" data-target="#add-purchase" class="btn btn-primary"><i class="fa fa-user-plus" style="padding-right:5px"></i>Add purchase</button>
            </div>
        </div>
    <div class="row">
        <?php echo isset($message)?$message:""; ?>
        <form action="#" method="post" id="edit-form" enctype="multipart/form-data" role="form">
           <div class="col-md-6">
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
           <div class="col-md-6">
                <div class="form-group">
                        <label>Product</label>
                        <select name="cmbProduct" id="cmbProduct" class="form-control">
                            <?php
                                $query=$db->query("select id,name from {$ex}products");
                                $arr=[];
                                while(list($id,$name)=$query->fetch_row()){
                                    $arr["$id"]=$name;
                                    echo "<option value='$id'>$name</option>";
                                }
                            ?>
                    </select>
                </div>
                 <div class="form-group">
                    <label>Quantity</label>
                    <input type="text" name="txtQty" id="txtQty" class="form-control" placeholder="Quantity">
                </div>
                <div class="form-group">
                    <label>Cost</label>
                    <input type="text" name="txtCost" id="txtCost" class="form-control" placeholder="Cost">
                </div>
           </div>
           <input type="submit" name="subBtn" value="Insert" class="btn btn-primary" />
            <button type="reset" class="btn btn-default">Reset</button>
       </form>
        </div>
        <!--/.row-->
        </div>
    </div>
</div>
<script>
    $(function(){
        $( "#datepicker" ).datepicker();
    });
</script>