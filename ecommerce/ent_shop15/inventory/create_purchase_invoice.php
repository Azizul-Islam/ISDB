<?php echo breadcumb(["Create Invoice"]); ?>
<?php echo head_title("Create Invoice"); ?>
<?php
    if(isset($_POST["btnSave"])){
        if(count($_SESSION["invoice"])>0){
            //print_r($_POST);
            $vendor_id=$_POST["cmbVendor"];
            $ref=$_POST["txtRef"];

            date_default_timezone_set("Asia/Dhaka");
            $purchase_at=date("Y-m-d",strtotime($_POST["txtDate"]));
            $purchase_du_at=date("Y-m-d",strtotime($_POST["txtDueDate"]));
            $db->query("insert into {$ex}purchase(vendor_id,ref_no,purchase_date,due_date)values('$vendor_id','$ref','$purchase_at','$purchase_du_at')");
            $purchase_id=$db->insert_id;
            foreach($_SESSION["invoice"] as $k=>$v){
                $db->query("insert into {$ex}purchasedetails(purchase_id,product_id,Qty,cost)values('$purchase_id','$v[id]','$v[qty]','$v[price]')");
            }
            unset($_SESSION["invoice"]);
            $message="<p class='alert alert-success'>Item Added successfully</p>";
        }else{
            $message="<p class='alert alert-warning'>Item is not found</p>";
        }
    }
   
    if(!is_array($_SESSION["invoice"])){
        $_SESSION["invoice"]=[];
       }
    
if(isset($_POST["btnAdd"])){
        // print_r($_POST);
        $id=$_POST["cmbProduct"];
        $qty=$_POST["txtQty"];
        $price=$_POST["txtPrice"];

        $product_row=$db->query("select id,name,price from {$ex}products where id='$id'");
        $row=$product_row->fetch_object();

        if(array_key_exists($id,$_SESSION["invoice"])){
            $_SESSION["invoice"][$id]["qty"]+=$qty;
            $_SESSION["invoice"][$id]["total"]=$_SESSION["invoice"][$id]["qty"]*$price;
        }else{
            $_SESSION["invoice"][$id]["id"]=$id;
            $_SESSION["invoice"][$id]["qty"]=$qty;
            $_SESSION["invoice"][$id]["product"]=$row->name;
            $_SESSION["invoice"][$id]["price"]=$price;
            $_SESSION["invoice"][$id]["total"]=$qty*$price;
        }
        //print_r($_SESSION["invoice"]);
}

if(isset($_POST["btnDel"])){
    $id=$_POST["txtId"];
    if(array_key_exists($id,$_SESSION["invoice"])){
        unset($_SESSION["invoice"][$id]);
    }
}
?>
<?php echo isset($message)?$message:""; ?>
<!--invoice-->
<div class="panel panel-default">
    <div class="panel panel-container">
    <div class="panel-body">
    <div class="row">
    <div id="invoice">
    <div class="invoice overflow-auto">
        <div style="min-width: 600px">
            <header>
                <div class="row">
                    <div class="col-md-6">
                        <a target="_blank" href="">
                            <img src="http://lobianijs.com/lobiadmin/version/1.0/ajax/img/logo/lobiadmin-logo-text-64.png" data-holder-rendered="true" />
                            </a>
                    </div>
                    <div class="col-md-6 company-details">
                        <h2 class="name">
                            <a target="_blank" href="">
                            Arboshiki
                            </a>
                        </h2>
                        <div>455 Foggy Heights, AZ 85004, US</div>
                        <div>(123) 456-789</div>
                        <div>company@example.com</div>
                    </div>
                </div>
            </header>
            <main>
                <div class="row contacts">
                <form action="#" method="post" id="frmPurchase">
                    <input type="hidden" name="btnSave" value="save" />
                    <div class="col-md-6 invoice-to">
                        <div class="text-gray-light">INVOICE FORM:</div>
                        <h2 class="to">
                        <div class="form-group">
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
                   
                        </h2>
                        <div class="address" id="address_output"></div>
                        <div class="email"><a href="mailto:john@example.com">john@example.com</a></div>
                    </div>
                    <div class="col-md-6 invoice-details">
                        <h1 class="invoice-id">INVOICE #
                        <?php  
                            $query=$db->query("select max(id) from {$ex}purchase");
                            list($id)=$query->fetch_row();
                            echo $id+1;
                        ?>
                        </h1>
                        <div class="date">Date of Invoice: 
                        <div class="form-group">
                            <input type="text" name="txtDate" id="datepicker" class="form-control" placeholder="Purchase Date">
                        </div>
                        </div>
                        <div class="date">Due Date: 
                        <div class="form-group">
                            <input type="text" name="txtDueDate" id="txtDueDate" class="form-control" placeholder="Due Date">
                        </div>
                        <div class="form-group">
                            <label>Ref No</label>
                            <input type="text" name="txtRef" id="txtRef" class="form-control" placeholder="Ref No">
                        </div>
                        </div>
                    </div>
                    </form>
                </div>
            <div class="row">
                <table border="0" cellspacing="0" cellpadding="0">
                    <thead>
                    <form action="#" method="post" >
                        <tr>
                            <th></th>
                            <th class="text-left">
                            <?php
                                $product_rs=$db->query("select id,name from ent_products");
                                echo select_box_query("cmbProduct",$product_rs);
                            ?>
                            </th>
                            <th class="text-right">
                                <?php
                                    echo text_field_nolabel("txtQty","Enter Qty");
                                ?>
                            </th>
                            <th class="text-right">
                            <?php
                                echo text_field_nolabel("txtPrice","Enter Price");
                            ?>
                            </th>
                            <th class="text-right"><input type="submit" name="btnAdd" value="Add"/></th>
                            <th></th>
                        </tr>
                    </form>
                        <tr>
                            <th>SN</th>
                            <th class="text-left">Product</th>
                            <th class="text-right">Qty</th>
                            <th class="text-right">Price</th>
                            <th class="text-right">Total</th>
                            <th class="text-right">Action</th>
                        </tr>
                        
                    </thead>
                    <tbody>
                    <?php
                        $index=1;
                        $subtotal=0;
                        if(isset($_SESSION["invoice"])){
                        foreach($_SESSION["invoice"] as $k=>$v){
                            echo "<tr>";
                            echo "<td class='no'>".$index++."</td>";
                            echo "<td class='text-left'>$v[product]";                             
                            echo "</td>";
                            echo "<td class='qty'>$v[qty]</td>";
                            echo "<td class='total'>$v[price]</td>";
                            echo "<td class='total'>$v[total]</td>";
                            echo "<td><form action='#' method='post' onSubmit='return confirm(\"Are you sure?\")'><input type='hidden' name='txtId' value='$k' /><button type='submit' class='btn btn-danger btn-sm' name='btnDel' value='del'><i class='fa fa-trash'></i></button></form></td>";
                            echo "</tr>";
                            $subtotal+=$v["total"];
                        }
                    }
                    ?>
                       
                        
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2"></td>
                            <td colspan="2">SUBTOTAL</td>
                            <td><?php echo $subtotal ?></td>
                        </tr>
                        <tr>
                            <td colspan="2"></td>
                            <td colspan="2">TAX 5%</td>
                            <td>
                            <?php 
                            $tax=$subtotal*5/100;
                            echo $tax;
                            ?></td>
                        </tr>
                        <tr>
                            <td colspan="2"></td>
                            <td colspan="2">Shiping</td>
                            <td>
                            <?php
                                $shiping=80;
                                echo $shiping;
                            ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2"></td>
                            <td colspan="2">GRAND TOTAL</td>
                            <td>
                            <?php
                                echo $subtotal+$tax+$shiping;
                            ?>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            
                </div>
                <div class="thanks">Thank you!</div>
                <div class="notices">
                    <div>NOTICE:</div>
                    <div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>
                </div>
                <div class="text-right">
                    <button type="submit" name="btnsubmit" id="btnsubmit" class="btn btn-info"><i class="fa fa-plus"></i>Submit Payment</button>
                </div>
            </main>
            <footer>
                Invoice was created on a computer and is valid without the signature and seal.
            </footer>
        </div>
        <!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
        <div></div>
    </div>
    </div>
        <!--/.row-->
        </div>
    </div>
</div>



<script>
    

    $(function(){
        $("#btnsubmit").on("click",function(){
        if(confirm("Are you sure?")){
            $("#frmPurchase").submit();
        }
        });
        $( "#datepicker" ).datepicker();
        $("#txtDueDate").datepicker();

        $("#cmbProduct").on("change",function(){
        let product_id=$(this).val();
        $.ajax({
            method:"GET",
            url:"api/get_price.php?product_id="+product_id,
            success:function(html){
                $("#txtPrice").val(html);
            }
        });
    });
    $("#cmbVendor").on("change",function(){
        let vendor_id=$(this).val();
        $.ajax({
            method:"GET",
            url:"api/get_address.php?vendor_id="+vendor_id,
            success:function(address){
                $("#address_output").html(address);
            }
        });
    });

});

   
</script>
