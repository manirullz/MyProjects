<?php include_once('header.php');
include_once('config.php');

if(isset($_POST['UpdateTax']))
{
	$taxValue	= $_POST['taxvalue'];
	$txtypid	= $_POST['taxtypeid'];	
	$updateTaxvalue	= "UPDATE tax_master SET taxPercent=".$taxValue." WHERE taxTypeid=".$txtypid."";
	mysqli_query($con,$updateTaxvalue);
	
}
?>
<script>
function Popup(taxvalue,txtypeid)
{
	var taxvalue;
	var txtypeid;
	//alert(txtypeid);
	$("#popup_taxfrm").show();
	document.getElementById('taxvalue').value	= taxvalue;
	document.getElementById('taxtypeid').value	= txtypeid;
	
	return false;
}
</script>
<div id="page-wrapper">
       <div class="bs-example4" data-example-id="contextual-table">
    <table class="table">
      <thead>
        <tr>
          <th>Tax ID</th>
          <th>Tax Type</th>         
          <th>Tax Value(in %age)</th>                  
        </tr>
      </thead>
      <tbody>
       <?php
		$view_tax_query		=	"SELECT * FROM tax_master";
		$exe_tax_query		=	mysqli_query($con,$view_tax_query);
		while($result_tax_list	= 	mysqli_fetch_array($exe_tax_query))
		{
			$taxTypeid			= $result_tax_list['taxTypeid'];
			$taxType			= $result_tax_list['taxType'];
			//$product_instock	= $result_prod_list['quantityInStock'];
			//$prod_unitType		= $result_prod_list['prod_unitType'];
			$taxPercent			= $result_tax_list['taxPercent'];
			//$product_instock	= $result_prod_list['product_instock'];
		 ?>
        <tr class="active">
          <th scope="row"><?php echo $taxTypeid; ?></th>
          <td><?php echo $taxType; ?></td>          
          <td><?php echo $taxPercent; ?></td>
          <td><a href="javascript:;" onclick="Popup('<?php echo $taxPercent ;?>','<?php echo $taxTypeid; ?>')">Modify</a></td>
        </tr>
        <?php }?>
      </tbody>
    </table>
   </div>
    <!-- Start Pop Up form Layout -->                
          <div id ="popup_taxfrm" class="popup" style="position: fixed;width: 100%;height: 100%;margin: 0 auto;top: 0;left: 0;z-index: 99999999999; display:none" >
         <div style="z-index: -1; top: 0; left: 0; bottom: 0; right: 0px; position: fixed;
            opacity: 0.6; filter: alpha(opacity=6); background-color: Gray;">
        </div>
              <div class="panel-body" style="width: 560px;margin: 0 auto;background: #fff;padding: 28px;border: 1px solid #0D0D0D;margin-top: 10%;box-shadow: 1px 2px 3px #ccc;border-radius: 8px;">
                 <div class="row">
                   <div>
                    <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data" role="form" >
                          <div class="form-group">
                                <label>Tax Value</label>
                                <input type="number" class="form-control1 input-sm" id="taxvalue" name="taxvalue"  value="" >
                           </div>
                         <input type="hidden" name="taxtypeid" id="taxtypeid" value="" />
                         <input type="submit" name="UpdateTax"  value="Update"/>
                         <input type="button" name="close"  value="Close" onclick="$('.popup').hide();"/>                     
                    </form>
                   </div>
                </div>
               
             </div>
          </div>
          <!-- End Pop Up form Layout -->
  </div>
  <?php include_once('footer.php'); ?>