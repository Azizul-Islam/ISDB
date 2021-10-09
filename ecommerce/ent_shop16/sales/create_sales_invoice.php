<?php
    if(isset($_POST["salseBtn"])){
        if(count($_SESSION["salse"])>0){
            //print_r($_SESSION["salse"]);
            $customer_id=$_POST["cmbCustomer"];
            $db->query("insert into {$ex}salse(customer_id)values('$customer_id')");
            $salse_id=$db->insert_id;
            foreach($_SESSION["salse"] as $k=>$v){
                $db->query("insert into {$ex}salse_details(salse_id,product_id,qty,price)values('$salse_id','$v[id]','$v[qty]','$v[price]')");
            }
            unset($_SESSION["salse"]);
            $message="<div class='alert alert-success alert-dismissible show' role='alert'>
                Submit success.
	            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
		        <span aria-hidden='true'>&times;</span>
	            </button>
	            </div>";
        }else{
            $message="<div class='alert alert-success alert-dismissible show' role='alert'>
            Item is't found.
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
            </button>
            </div>";
        }
    }
    if(!isset($_SESSION["salse"])){
        $_SESSION["salse"]=[];
    }
    if(isset($_POST["btnAdd"])){
        $id=$_POST["cmbProduct"];
        $qty=$_POST["txtQty"];

        $query_rs=$db->query("select id,name,price,photo from {$ex}products where id='$id'");
        $row=$query_rs->fetch_object();
        if(array_key_exists($id,$_SESSION["salse"])){
            $_SESSION["salse"][$id]["qty"]+=$qty;
            $_SESSION["salse"][$id]["total"]=$_SESSION["salse"][$id]["qty"]*$row->price;
        }else{
        $_SESSION["salse"][$id]["id"]=$id;
        $_SESSION["salse"][$id]["name"]=$row->name;
        $_SESSION["salse"][$id]["photo"]=$row->photo;
        $_SESSION["salse"][$id]["price"]=$row->price;
        $_SESSION["salse"][$id]["qty"]=$qty;
        $_SESSION["salse"][$id]["total"]=$qty*$row->price;
        }
    }
    if(isset($_POST["btnDel"])){
        $id=$_POST["txtId"];
        if(array_key_exists($id,$_SESSION["salse"])){
            unset($_SESSION["salse"]);
        }
    }
?>

<?php echo breadcumb(["Customer"],"home"); ?>
<?php echo head_title("Create Customer invoice"); ?>


<div class="panel panel-default">
    <?= isset($message)?$message:""; ?>
    <div class="panel panel-container">
    <div class="panel-body">
    <div class="row">
    <div id="invoice">
    <div class="toolbar hidden-print">
        <div class="text-right">
            <button id="printInvoice" class="btn btn-info"><i class="fa fa-print"></i> Print</button>
            <button class="btn btn-info"><i class="fa fa-file-pdf-o"></i> Export as PDF</button>
        </div>
        <hr>
    </div>
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
                    <div class="col-md-6 invoice-to">
                        <div class="text-gray-light">INVOICE FORM:</div>
                        <h2 class="to">
                        <form action="#" method="post" id="salseForm">
                        <div class="form-group">
                        <input type="hidden" name="salseBtn" value="save">
                        <select name="cmbCustomer" id="cmbCustomer" class="form-control">
                            <?php
                                $query=$db->query("select id,name from {$ex}customer");
                                $arr=[];
                                while(list($id,$name)=$query->fetch_row()){
                                    $arr["$id"]=$name;
                                    echo "<option value='$id'>$name</option>";
                                }
                            ?>
                        </select>
                        </div>
                   
                        </h2>
                        </form>
                        <div class="address">796 Silver Harbour, TX 79273, US</div>
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
                    </div>
                </div>
                <table border="0" cellspacing="0" cellpadding="0">
                    <thead>
                    <form action="#" method="post" >
                        <tr>
                            
                            <th>
                            <?php
                                $product_rs=$db->query("select id,name from ent_products");
                                echo select_box_query("cmbProduct",$product_rs);
                            ?>
                            </th>
                            <th >
                                <?php
                                    echo text_field_nolabel("txtQty","Enter Qty");
                                ?>
                            </th>
                            
                            <th><input type="submit" name="btnAdd" value="Add"/></th>
                            <th colspan="4"></th>
                        </tr>
                    </form>
                    <tr>
                            <th>SN</th>
                            <th class="text-left">Product</th>
                            <th>Photo</th>
                            <th >Qty</th>
                            <th class="text-right">Price</th>
                            <th class="text-right">Total</th>
                            <th class="text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $index=1;
                        $subtotal=0;
                        if(isset($_SESSION["salse"])){
                        foreach($_SESSION["salse"] as $k=>$v){
                            echo "<tr>";
                            echo "<td class='no'>".$index++."</td>";
                            echo "<td class='text-left'>$v[name]";                             
                            echo "</td>";
                            echo "<td><img src='images/products/$v[photo]' width='40' /></td>";
                            echo "<td class='no'>$v[qty]</td>";
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
                            
                            <td colspan="3"></td>
                            <td colspan="2">SUBTOTAL</td>
                            <td><?php echo $subtotal ?></td>
                        </tr>
                        <tr>
                            
                            <td colspan="3"></td>
                            <td colspan="2">TAX 5%</td>
                            <td>
                            <?php 
                            $tax=$subtotal*5/100;
                            echo $tax;
                            ?></td>
                        </tr>
                        <tr>
                            
                            <td colspan="3"></td>
                            <td colspan="2">Shiping</td>
                            <td>
                            <?php
                                $shiping=80;
                                echo $shiping;
                            ?>
                            </td>
                        </tr>
                        <tr>
                            
                            <td colspan="3"></td>
                            <td colspan="2">GRAND TOTAL</td>
                            <td>
                            <?php
                                echo $subtotal+$tax+$shiping;
                            ?>
                            </td>
                        </tr>
                    </tfoot>
                </table>
                <div class="thanks">Thank you!</div>
                <div class="notices">
                    <div>NOTICE:</div>
                    <div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>
                </div>
                <div class="text-right">
                    <button type="submit" name="btnsubmit" id="btnsubmit" class="btn btn-info"><i class="fa fa-plus"></i>Care</button>
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
            if(confirm("Are you sure!")){
                $("#salseForm").submit();
            }
        });
    });
</script>