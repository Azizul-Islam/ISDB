<?php echo breadcumb(["Salse"],"home"); ?>
<?php echo head_title("Salse"); ?>


<table class="table table-bordered">
<thead>
	<tr>
		<th scope="col">#</th>
		<th scope="col">Product Name</th>
		<th scope="col">Customer Name</th>
        <th scope="col">Salse date</th>
        <th scope="col">Qty</th>
        <th scope="col">Item Cost</th>
        <th scope="col">Total</th>
        
	</tr>
</thead>
<tbody>
    <?php 
        $subtotal=0;
        $query_rs= $db->query("select s.id,p.name as product_name,cu.name as customer,s.created_at,sd.qty,sd.price from {$ex}products p,{$ex}salse s,{$ex}customer cu,{$ex}salse_details sd where sd.product_id=p.id and s.customer_id=cu.id and sd.salse_id=s.id");
        while($r=$query_rs->fetch_object()){
        
    ?>
	<tr>
		<td><?= $r->id ?></td>
		<td><?= $r->product_name ?></td>
        <td><?= $r->customer ?></td>
		<td><?= $r->created_at ?></td>
        <td><?= $r->qty ?></td>
		<td><?= $r->price ?></td>
        <td><?php 
        $total= $r->qty*$r->price;
        echo $total;
        $subtotal+=$total;
        ?></td>
        
	</tr>
    <?php } ?>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td><strong>Grand Total</strong></td>
        <td colspan="3" class="text-right"><strong><?php echo $subtotal; ?> </strong></td>
    </tr>
</tbody>
</table>
