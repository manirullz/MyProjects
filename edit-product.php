<?php 
include_once('header.php');
include_once('config.php');

if(isset($_REQUEST['p_id']))
{	
	$productcode	= $_REQUEST['p_id'];
	$get_service_query	= "SELECT * FROM products WHERE productCode='".$productcode."'";
	$exe_service_query	= mysqli_query($con,$get_service_query);
	while($result	= mysqli_fetch_array($exe_service_query))
	{
		$p_id			= $result['productCode'];
		$product_name	= $result['productName'];
		$p_price		= $result['buyPrice'];
		$product_price_monthly	= $result['MSRP'];
	    $product_price_perday  = ($result['MSRP']/31);
	}
} 

if(isset($_POST['updateproduct']))
  {
	  $serviceType	= $_POST['prod_name'];
	  $serviceRate	= $_POST['price'];
	  $productcode	= $_POST['prod_code'];
	  $product_price_perdayU  = ($_POST['price']/31);
	  
	  $updateProduct	= "UPDATE products SET productName='".$serviceType."',buyPrice='".$product_price_perdayU."',MSRP='".$serviceRate."' WHERE productCode='".$productcode."'";
	  mysqli_query($con,$updateProduct);
	  echo 'Data have been updated successfully';
	  header('Location:view-products.php');
	  
  }

?>
<div id="page-wrapper">
        <div class="graphs">
	     <div class="xs">
  	       <h3>Update Service Type</h3>
  	         <div class="tab-content">
						<div class="tab-pane active" id="horizontal-form">                         
							<form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                            	 <div class="form-group">
									<label for="prod_id" class="col-sm-2 control-label label-input-sm">Service Code</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1 input-sm" name="prod_code" id="prod_code" readonly value="<?php echo $p_id ?>" >
								</div>
                                </div>
                           		 <div class="form-group">
									<label for="prod_name" class="col-sm-2 control-label label-input-sm">Service Type</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1 input-sm" name="prod_name" required id="prod_name" value="<?php echo $product_name; ?>" >
								</div>
                                </div>
                            	<!--<div class="form-group">
									<label for="prod_quantity" class="col-sm-2 control-label label-input-sm">Product Quantity</label>
									<div class="col-sm-8">
										<input type="number" class="form-control1 input-sm" name="prod_quantity" id="prod_quantity" placeholder="Enter Product Quantity">
								</div>
                                </div>-->                               
                                <div class="form-group">
								<label for="price" class="col-sm-2 control-label label-input-sm">Price/Month</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1 input-sm" id="price" name="price" value="<?php echo $product_price_monthly; ?>" >
									</div>
                                    </div>
                                    <div class="col-sm-8 col-sm-offset-2">
										<button type="submit" name="updateproduct" class="btn-success btn">Update</button>
									</div>
							</form>
						</div>
                       
					</div>
  </div>
  <?php include_once('footer.php'); ?>