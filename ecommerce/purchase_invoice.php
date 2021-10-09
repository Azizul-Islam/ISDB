<?php

  if(isset($_POST["btnDel"])){
    
    $id=$_POST["txtId"];
    if(array_key_exists($id,$_SESSION["invoice"])){
         unset($_SESSION["invoice"][$id]);
    }

  }
  
  if(isset($_POST["btnAdd"])){   
    //print_r($_POST);
    $id=$_POST["cmbProduct"];
    $qty=$_POST["txtQty"];
    $price=$_POST["txtPrice"];

    $product_row=$db->query("select p.name,u.name uom,p.price from {$ex}products p, {$ex}uom u where u.id=p.uom_id and p.id='$id'");
    $row=$product_row->fetch_object();
   
    if(array_key_exists($id,$_SESSION["invoice"])){
      
      $_SESSION["invoice"][$id]["qty"]+=$qty;
      $_SESSION["invoice"][$id]["total"]=$_SESSION["invoice"][$id]["qty"]*$price;
   
    }else{

      $_SESSION["invoice"][$id]["id"]=$id;
      $_SESSION["invoice"][$id]["name"]=$row->name;
      $_SESSION["invoice"][$id]["qty"]=$qty;
      $_SESSION["invoice"][$id]["uom"]=$row->uom;
      $_SESSION["invoice"][$id]["price"]=$price;
      $_SESSION["invoice"][$id]["total"]=$qty*$price;

    }

  }

    //print_r($_SESSION["invoice"]);
?>

<div class="content-header">

   <div class="container">
      <div class="row mb-2">
         <div class="col">
            <h1 class="m-0 text-dark">
               Purchase Invoice
            </h1>
         </div>
         <div class="col">
           <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Purchase Invoice</li>
            </ol>
         </div>
      </div>
   </div>

</div>

<div class="content">
   
   <div class="container">
     
      <div class="row">
         <div class="col-sm-10">



<div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
                <div class="col-12">
                  <h4>
                    <i class="fas fa-globe"></i> AdminLTE, Inc.
                    <small class="float-right">Date: 2/10/2014</small>
                  </h4>
                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->
              <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                  From
                  <div>
                    <?php
                      $supplers_rs=$db->query("select id,name from {$ex}suppliers");
                      $vendors=[];
                      while(list($id,$name)=$supplers_rs->fetch_row()){
                        $vendors[$id]=$name;
                      }
                      echo select_box2("cmbSupplier",$vendors);
                    ?>
                  </div>
                  <address>                  
                    <strong>Admin, Inc.</strong><br>
                    795 Folsom Ave, Suite 600<br>
                    San Francisco, CA 94107<br>
                    Phone: (804) 123-5432<br>
                    Email: info@almasaeedstudio.com
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                 
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  <b>Invoice # <?php
                   $rs_row= $db->query("select max(id)+1 count from cms_purchase");
                   $row=$rs_row->fetch_object();
                   echo $row->count==null?1:$row->count;
                  ?></b><br>
                  <br>
                  <b>Order ID:</b> 4F3S8J<br>
                  <b>Payment Due:</b> 2/22/2014<br>
                  <b>Account:</b> 968-34567
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  
                  <table class="table table-striped">
                    <thead>
                    <tr>
                      <th>SN</th>
                      <th>Product</th>                    
                      <th>Qty</th>
                      <th>Price</th>
                      <th></th>                      
                    </tr>
                   
                    <tr>
                    <th>
                      <form action="#" method="post">
                    </th>
                      <th>
                       <?php
                          $products_rs=$db->query("select id,name from cms_products");
                           echo select_box_query("cmbProduct",$products_rs);
                       ?>
                      </th>                     
                      <th><?php echo text_field_nolabel("txtQty")?></th>
                      <th><?php echo text_field_nolabel("txtPrice")?></th>
                      <th><input type="submit" name="btnAdd" value="Add" />
                        </form>
                      </th>
                      
                    </tr>
                    </thead>

                    <tbody>
                    <?php
                     $i=1;
                     $subtotal=0;
                     foreach($_SESSION["invoice"] as $k=>$v){

                      echo "<tr>";
                      echo "<td>".$i++."</td>";
                      echo "<td>$v[name]</td>";
                      echo "<td>$v[qty]</td>";
                      echo "<td>$v[price]</td>";                      
                      echo "<td>$v[total]</td>";
                     // echo "<td>dd</td>";
                      echo "<td><form action='#' method='post' onSubmit='return confirm(\"Are you sure?\")'><input type='hidden' name='txtId' value='$k' /><button type='submit' class='btn btn-danger btn-sm' name='btnDel' value='del'><i class='far fa-trash-alt'></i></button></form></td>";
                      echo "</tr>";
                      $subtotal+=$v["total"];
                     }

                    ?>
                    
                                  
                  
                    </tbody>
                  </table>
                  
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <div class="row">
                <!-- accepted payments column -->
                <div class="col-9">
                 Test
                </div>
                <!-- /.col -->
                <div class="col-3">
                  <p class="lead">Amount Due 2/22/2014</p>

                  <div class="table-responsive">
                    <table class="table">
                      <tbody><tr>
                        <th style="width:50%">Subtotal:</th>
                        <td><?php  echo $subtotal?></td>
                      </tr>
                      <tr>
                        <th>Tax (5%)</th>
                        <td>
                        <?php
                           $tax=$subtotal*(5/100);
                           echo $tax;
                        ?>
                        </td>
                      </tr>
                      <tr>
                        <th>Shipping:</th>
                        <td><?php 
                           $shipping_cost=80;
                           echo $shipping_cost;
                        ?></td>
                      </tr>
                      <tr>
                        <th>Total:</th>
                        <td><?php echo $subtotal+$tax+$shipping_cost ?></td>
                      </tr>
                    </tbody></table>
                  </div>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- this row will not appear when printing -->
              <div class="row no-print">
                <div class="col-12">
                  <a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
                  <button type="button" class="btn btn-success float-right"><i class="far fa-credit-card"></i> Submit
                    Payment
                  </button>
                  <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                    <i class="fas fa-download"></i> Generate PDF
                  </button>
                </div>
              </div>
            </div>

            </div>  


</div>

</div>


</div>