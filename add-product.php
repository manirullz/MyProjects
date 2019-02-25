<?php include_once('header.php');?>
<div id="page-wrapper">
        <div class="graphs">
	     <div class="xs">
		 <!-- ADD PRODUCT SECTION --->
  	       <h3>Add Service Type</h3>
  	         <div class="tab-content">
						<div class="tab-pane active" id="horizontal-form">
							<form class="form-horizontal" action="action.php" method="post" enctype="multipart/form-data">
                            	 <div class="form-group">
									<label for="prod_name" class="col-sm-2 control-label label-input-sm">Service Code</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1 input-sm" name="prod_code" id="prod_code" required value="" >
								</div>
                                </div>
                           		 <div class="form-group">
									<label for="prod_name" class="col-sm-2 control-label label-input-sm">Service Type</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1 input-sm" name="prod_name" required id="prod_name" value="" >
								</div>
                                </div>
                            	<!--<div class="form-group">
									<label for="prod_quantity" class="col-sm-2 control-label label-input-sm">Product Quantity</label>
									<div class="col-sm-8">
										<input type="number" class="form-control1 input-sm" name="prod_quantity" id="prod_quantity" placeholder="Enter Product Quantity">
								</div>
                                </div>-->                               
                                <div class="form-group">
								<label for="price" class="col-sm-2 control-label label-input-sm">Price/Unit</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1 input-sm" id="price" name="price" >
									</div>
                                    </div>
                                    <div class="col-sm-8 col-sm-offset-2">
										<button type="submit" name="addproduct" class="btn-success btn">Add</button>
									</div>
							</form>
						</div>
					</div>
  </div>
  <?php include_once('footer.php'); ?>