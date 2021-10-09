<?php
    if(isset($_POST["customerAdd"])){
        $name=$_POST["txtName"];
        $email=$_POST["txtEmail"];
        $phone=$_POST["txtPhone"];
        $address=$_POST["txtAddress"];
        //print_r($_POST);
        $db->query("insert into {$ex}customer(name,email,phone,address)values('$name','$email',$phone,'$address')");
        $message="<div class='alert alert-success alert-dismissible show' role='alert'>
	    Customer Added Succesfully.
	    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
		<span aria-hidden='true'>&times;</span>
	    </button>
	    </div>";
    }

?>
<?php echo breadcumb(["Customer"],"home"); ?>
<?php echo head_title("Customer"); ?>

<div class="panel panel-default">
    <?= isset($message)?$message:""; ?>
    <div class="panel-heading">Forms</div>
    <div class="panel-body">
        <div class="row">
        <div class="col-md-5">
        <fieldset>
            <form action="#" method="post" enctype="multipart/form-data" role="form">
                <div class="form-group">
                    <label>Customer-Name</label>
                    <input type="hidden"  name="active_status" value="0" />
                    <input class="form-control" required name="txtName" placeholder="Name">
                </div>
                <div class="form-group">
                    <label>E-mail</label>
                    <input type="text" name="txtEmail" class="form-control" placeholder="Email">
                </div>
                <div class="form-group">
                    <label>Phone</label>
                    <input type="text" name="txtPhone" class="form-control" placeholder="Phone">
                </div>
                <div class="form-group">
                    <label>Address</label>
                    <textarea type="text" name="txtAddress" id=""  class="form-control" rows="3"></textarea>
                </div>
                <input type="submit" name="customerAdd" value="Insert" class="btn btn-primary" />
                <button type="reset" class="btn btn-default">Reset</button>
            </form>
            </fieldset>
        </div>
        <div class="col-md-7">
        <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">Index</th>
                <th scope="col">Customer Details</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
        
            <?php
                $query_rs=$db->query("select id,name,email,phone,address from {$ex}customer");
                while(list($id,$name,$email,$phone,$address)=$query_rs->fetch_row()){
                echo "<tr>";
                echo "<td>$id</td>";
                echo "<td>";
                  echo  "Name : ".$name."<br>";
                  echo  "Email : "."<a href='mailto'>".$email."</a>"."<br>";
                  echo  "Phone : ".$phone."<br>";
                  echo  "Address : ".$address."<br>";
                echo "</td>";
                echo "<td>";
                    echo "<form action='#' method='post' onSubmit='return confirm('Are your sure?')'>";
                        echo "<input type='hidden' name='txtId' value='' />";
                        echo "<button type='button' class='btn btn-success btn-sm btn-edit' data-toggle='modal' data-json='' data-id='' data-target='#user-edit' name='btnEdit' value='edit'><i class='fa fa-edit'></i></button>";
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