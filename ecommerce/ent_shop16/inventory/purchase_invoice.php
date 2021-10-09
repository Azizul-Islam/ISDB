<?php echo breadcumb(["Purchase Details"]); ?>
<?php echo head_title("Purchase Deteails"); ?>

<?php
    if(isset($_GET["id"])){
       $id=$_GET["id"];
       $query_rs=$db->query("select p.name,v.name as Vendor_name,v.address,v.phone,pu.purchase_date,pu.due_date,pu.ref_no,pd.Qty,pd.cost from {$ex}products p,{$ex}vendor v,{$ex}purchase pu,{$ex}purchasedetails pd where pd.product_id=p.id and pd.purchase_id=pu.id and pu.vendor_id=v.id and pd.purchase_id='$id'");
       $row=$query_rs->fetch_object();

    }

?>

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
                            E-mart
                            </a>
                        </h2>
                        <div>Dhaka mirpur,Sector-10</div>
                        <div>(01) 1738040305</div>
                        <div>e.miraj@gmail.com</div>
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
                            <?php echo $row->Vendor_name ?>
                        </h2>
                        <div class="address" id="address_output"><?php echo $row->address; ?></div>
                        <div class="email"><a href="mailto:john@example.com"><?php echo $row->phone ?></a></div>
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
                        <?php echo $row->purchase_date ?>
                        </div>
                        <div class="date">Due Date: 
                        <?php echo $row->due_date ?>
                        <div class="form-group">
                            <label>Ref No</label>
                            <?php echo $row->ref_no ?>
                        </div>
                        </div>
                    </div>
                    </form>
                </div>
            <div class="row">
                <table border="0" cellspacing="0" cellpadding="0">
                    <thead>
                        <tr>
                            <th>SN</th>
                            <th class="text-left">Product</th>
                            <th>Photo</th>
                            <th class="text-right">Qty</th>
                            <th class="text-right">Price</th>
                            <th class="text-right">Total</th>
                            
                        </tr>
                        
                    </thead>
                    <tbody>
                     <?php
                        $index=1;
                        $subtotal=0;
                        if(isset($_GET["id"])){
                            $id=$_GET["id"];
                        $query_rs=$db->query("select p.name,p.photo,pd.Qty,pd.cost from {$ex}products p,{$ex}purchase pu,{$ex}purchasedetails pd where pd.product_id=p.id and pd.purchase_id=pu.id and pd.purchase_id='$id'");
                        }
                        while(list($name,$photo,$Qty,$cost)=$query_rs->fetch_row()){
                            echo "<tr>";
                            echo "<td class='no'>".$index++."</td>";
                            echo "<td class='text-left'>$name";                             
                            echo "</td>";
                            echo "<td><img src='images/products/$photo' width='40px' /></td>";
                            echo "<td class='qty'>$Qty</td>";
                            echo "<td class='total'>$cost</td>";
                            echo "<td class='total'>".$Qty*$cost."</td>";
                            echo "</tr>";
                            $total=$Qty*$cost;
                            $subtotal+=$total;
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
            
                </div>
                <div class="thanks">Thank you!</div>
                <div class="notices">
                    <div>NOTICE:</div>
                    <div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>
                </div>
                <div class="text-right">
                    <button id="printInvoice" onclick="window.print()" class="btn btn-info"><i class="fa fa-print"></i> Print</button>
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