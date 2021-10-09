<div class="panel panel-default">
<div class="panel panel-container">
        <div class="row">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">
                    <form role="search">
                    <div >
                        <input type="text"  placeholder="Search category">
                        <button class="fa fa-user btn btn-sm btn-success">Add Category</button>
                     </div>
                    </form>
						<ul class="pull-right panel-settings panel-button-tab-right">
                            <span class="fa fa-user btn btn-sm btn-success"></span>                            
						</ul>
					</div>
					<div class="panel-body">
						
						<div class="canvas-wrapper">
							<canvas class="main-chart" id="line-chart" height="200" width="600"></canvas>
						</div>
					</div>
				</div>
			</div>
		</div><!--/.row-->
</div>
</div>


<!-- table -->

<table class="table table-bordered">

<thead>
	<tr>
		<th scope="col">ID</th>
		<th scope="col">Category Name</th>
		<th scope="col">Action</th>
	</tr>
</thead>
<tbody>
	
	<tr>
		<td>1</td>
		<td>Name</td>
		<td>
			<form action='#' method='post' onSubmit="return confirm('Are your sure?')">
				<input type="hidden" name="txtId" value="" />
				<button type='button' class='btn btn-success btn-sm btn-edit' data-toggle='modal' data-json='<?= $json ?>' data-id='$u->id' data-target='#user-edit' name='btnEdit' value='edit'><i class='fa fa-edit'></i></button>
				<button type='submit' class='btn btn-danger btn-sm' name='btnDel' value='del'><i class="fa fa-trash"></i></button>
			</form>
		</td>
	</tr>
</tbody>
</table>




<!--invoice-->
<div class="panel panel-default">
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
                </div>
                <table border="0" cellspacing="0" cellpadding="0">
                    <thead>
                        <tr>
                            <th>Qty</th>
                            <th class="text-left">Description</th>
                            <th class="text-right">Product</th>
                            <th class="text-right">Item Price</th>
                            <th class="text-right">TOTAL</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="no">04</td>
                            <td class="text-left"><h3>
                                <a target="_blank" href="https://www.youtube.com/channel/UC_UMEcP_kF0z4E6KbxCpV1w">
                                Youtube channel
                                </a>
                                </h3>
                               <a target="_blank" href="https://www.youtube.com/channel/UC_UMEcP_kF0z4E6KbxCpV1w">
                                   Useful videos
                               </a> 
                               to improve your Javascript skills. Subscribe and stay tuned :)
                            </td>
                            <td class="unit">$0.00</td>
                            <td class="qty">100</td>
                            <td class="total">$0.00</td>
                        </tr>
                        <tr>
                            <td class="no">01</td>
                            <td class="text-left"><h3>Website Design</h3>Creating a recognizable design solution based on the company's existing visual identity</td>
                            <td class="unit">$40.00</td>
                            <td class="qty">30</td>
                            <td class="total">$1,200.00</td>
                        </tr>
                        <tr>
                            <td class="no">02</td>
                            <td class="text-left"><h3>Website Development</h3>Developing a Content Management System-based Website</td>
                            <td class="unit">$40.00</td>
                            <td class="qty">80</td>
                            <td class="total">$3,200.00</td>
                        </tr>
                        <tr>
                            <td class="no">03</td>
                            <td class="text-left"><h3>Search Engines Optimization</h3>Optimize the site for search engines (SEO)</td>
                            <td class="unit">$40.00</td>
                            <td class="qty">20</td>
                            <td class="total">$800.00</td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2"></td>
                            <td colspan="2">SUBTOTAL</td>
                            <td>$5,200.00</td>
                        </tr>
                        <tr>
                            <td colspan="2"></td>
                            <td colspan="2">TAX 25%</td>
                            <td>$1,300.00</td>
                        </tr>
                        <tr>
                            <td colspan="2"></td>
                            <td colspan="2">GRAND TOTAL</td>
                            <td>$6,500.00</td>
                        </tr>
                    </tfoot>
                </table>
                <div class="thanks">Thank you!</div>
                <div class="notices">
                    <div>NOTICE:</div>
                    <div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>
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