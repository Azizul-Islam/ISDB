<div class="content-header">
    <?php echo header_title("Contact",["<a href='home.php'>Home</a>","Contact"]);?>
 </div>

 <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
          <form action="" method="post" class="form-horizontal">
            <div class="card card-info">
                <div class="card-header">Contact Info</div>
                <div class="card-body">
                    <?php echo text_field("Name","txtName","Enter name");?>
                    <?php echo text_field("Email","txtEmail","Enter Email");?>
                    <?php echo select_box("City","cmbCity",["0"=>"Select Item","1"=>"Dhaka"]);?>
                    <?php echo text_field("Number","txtNumber","Enter number");?>
                    <!-- <div class="form-group row">
                        <label for="" class="col-sm-2 col-form-label">Number</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="txtNumber" placeholder="Enter your number">
                        </div>
                    </div> -->
                </div>
                <div class="card-footer">
                    <button class="btn btn-info">Sign up</button>
                    <button class="btn btn-default float-right">Cancel</button>
                </div>
            </div>
            </form>
          </div>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>