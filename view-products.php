<?php include_once('header.php');
include_once('config.php');
?>
<div id="page-wrapper">
       <div class="bs-example4" data-example-id="contextual-table">
    <table class="table">
      <thead>
        <tr>
          <th>Product Code</th>
          <th>Product Name</th>         
          <th>Product Price</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
       <?php
		$view_prod_query	=	"SELECT * FROM products";
		$exe_prod_query		=	mysqli_query($con,$view_prod_query);		
		$countProduct		=	mysqli_num_rows($exe_prod_query);
		
		if($countProduct>0)
			{
		while($result_prod_list	= 	mysqli_fetch_array($exe_prod_query))
		{
			$product_id			= $result_prod_list['productCode'];
			$product_name		= $result_prod_list['productName'];
			$product_instock	= $result_prod_list['quantityInStock'];
		    //$prod_unitType		= $result_prod_list['prod_unitType'];
			$product_price		= $result_prod_list['MSRP'];
			//$product_instock	= $result_prod_list['product_instock'];
		 ?>
        <tr class="active">
          <th scope="row"><?php echo $product_id; ?></th>
          <td><?php echo $product_name; ?></td>
          <td><?php echo $product_price; ?></td>
          <td><a href="edit-product.php?p_id=<?php echo $product_id; ?>">EDIT</a></td>
        </tr>
        <?php }} ?>
      </tbody>
    </table>
   </div>
  </div>
  </div>
  <?php include_once('footer.php'); ?>