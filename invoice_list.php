<?php 
include_once('header.php');
include_once('config.php');
?>
<script type="text/javascript">
$(document).on('click','.status_checks',function(){
      var status = '1';
	  //alert(status);
      var msg = 'Cancel Reciept';
      if(confirm("Are you sure to "+ msg)){
        var current_element = $(this);
		var id = $(current_element).attr('data');
		//alert(id);
		//alert(current_element);
        url = "ajax/invoice.ajax.php";
        $.ajax({
          type:"POST",
          url: url,
          data: {id:id,status:status},
          success: function(data)
          {   
            location.reload();
          }
        });
      }      
    });
</script>
<div id="page-wrapper">
       <div class="bs-example4" data-example-id="contextual-table">
    <table class="table">
      <thead>
        <tr>
          <th>Invoice No</th>
          <th>Buyer Details</th>         
          <th>Billed Amount</th>
          <th colspan="2">Action</th>
        </tr>
      </thead>
      <tbody>
   <?php
    $getInvoice			=	"SELECT invoice_id,invoice_no,buyerName,totalAfterTax,invoice_status FROM invoice_master";
    $exeInvoice			=	mysqli_query($con,$getInvoice);		
    $countInvoice		=	mysqli_num_rows($exeInvoice);
		
	if($countInvoice>0)
		{
	   while($resultInvoice	= 	mysqli_fetch_array($exeInvoice))
		{
			$invoice_id			= $resultInvoice['invoice_id'];
			$invoice_no			= $resultInvoice['invoice_no'];
			$buyername			= $resultInvoice['buyerName'];
			$billedAmount		= $resultInvoice['totalAfterTax'];
			$invoice_status		= $resultInvoice['invoice_status'];
			
			$getPayment			= "SELECT * FROM payment_detail WHERE invoice_id=".$invoice_id." ORDER BY pay_id DESC LIMIT 1";
			$exePayment			= mysqli_query($con,$getPayment)or die(mysqli_error($con));
			$count				= mysqli_num_rows($exePayment);
			while($resultPay	= mysqli_fetch_array($exePayment))
			{
				$balanceAmt		= intval($resultPay['balance_amt']); 
			}
			
		 ?>
        <tr class="active">
          <th scope="row"><?php echo $invoice_no; ?></th>
          <td><?php echo $buyername; ?></td>
          <td><?php echo $billedAmount; ?></td>
          <td><a target="_blank" href="print-invoice.php?inv_id=<?php echo $invoice_id; ?>">View Invoice</a></td>
          <td>
          <?php if($balanceAmt >0 && $count==1)
		  {?>
          <i><a href="genrate-reciept.php?i_id=<?php echo $invoice_id; ?>&balamt=<?php echo $balanceAmt; ?>&amt=<?php echo $billedAmount; ?>">Genrate Reciept</a></i>
          <?php } else if($count==0 && $invoice_status==0) { ?>
          (<i><a href="genrate-reciept.php?i_id=<?php echo $invoice_id; ?>&amt=<?php echo $billedAmount; ?>">Genrate Reciept</a></i> / <a><i data="<?php echo $invoice_id;?>" class="status_checks btn">Cancel Invoice</i></a>)         
          <?php } 
		   else if($invoice_status==1) {?>
           Reciept Cancelled
           <?php }
		  else {?>
          Paid
          <?php }?>		  
          </td>
        </tr>
        <?php }} ?>
      </tbody>
    </table>
   </div>
  </div>
  </div>
  <?php include_once('footer.php'); ?>