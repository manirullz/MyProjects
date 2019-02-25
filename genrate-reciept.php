<?php 
include_once('header.php');
include_once('config.php');

$invoice_id	= $_REQUEST['i_id'];
$billed_amt	= $_REQUEST['amt'];
if(isset($_REQUEST['balamt']))
{
	$balance_amt= $_REQUEST['balamt'];
}
?>
<script type="text/javascript">
function paymodechange()
{
	var paymode	= document.getElementById('pay_mode');
	var chequeId= document.getElementById('cheque_no');
	if(paymode.value!='CASH')
	{
		document.getElementById('cheque_no').disabled=false;
		document.getElementById('bank_charge').disabled=false;
	}
	else
	{
		document.getElementById('cheque_no').disabled=true;
		document.getElementById('bank_charge').disabled=true;
		document.getElementById('cheque_no').value="";
		document.getElementById('bank_charge').value=0;
	}		
}
function calculate()
{
	
		var paymode		= document.getElementById('pay_mode');
		var inv_amt		= Math.round(document.getElementById('billed_amt').value);
		if(document.getElementById('due_amt'))
		{
			//alert('test');
			var inv_amt		= document.getElementById('due_amt').value;
			//alert(inv_amt);
		}
		
			
		var paid_amt	= document.getElementById('paid_amt').value;
		var bal_amt		= document.getElementById('bal_amt');
	if(paymode.value!='CASH')
	{
		var bankCharge  = document.getElementById('bank_charge').value;	
		var finalAmt	= 0;
		finalAmt		= parseFloat(inv_amt)- (parseFloat(paid_amt)+parseFloat(bankCharge));
		
			bal_amt.value	= finalAmt;	
			if(bal_amt.value<0)
		{
			alert('Enter Valid Amount');
			document.getElementById('paid_amt').value="";
			document.getElementById('bank_charge').value="0";	
			
		}
	}
	else
	{
		var finalAmt	= 0;
		finalAmt		= parseFloat(inv_amt)- parseFloat(paid_amt);
		bal_amt.value	= finalAmt;
		
		if(bal_amt.value<0)
		{
			alert('Enter Valid Amount');
			document.getElementById('paid_amt').value="";
			//document.getElementById('bank_charge').value="0";	
			
		}
	}
}
	$(window).load("pageshow", function() {
		document.forms["form"].reset();
  // update hidden input field
});
	
</script>
<div id="page-wrapper">
        <div class="graphs">
	     <div class="xs">
  	       <h3>Enter Payment Details</h3>
  	         <div class="tab-content">
						<div class="tab-pane active" id="horizontal-form">
							<form class="form-horizontal" name="form" action="action.php" method="post" enctype="multipart/form-data">
                            	 <div class="form-group">
									<label for="pay_date" class="col-sm-2 control-label label-input-sm">Payment Date</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1 input-sm" name="pay_date" id="poDate" required value="" >
									</div>
                                </div>
                           		 <div class="form-group">
									<label for="billed_amt" class="col-sm-2 control-label label-input-sm">Billed/Due Amount</label>
									<div class="col-sm-8">
									<input type="text" readonly class="form-control1 input-sm" name="billed_amt" required id="billed_amt" value="<?php echo $billed_amt; ?>" >
                                    <?php if(isset($_REQUEST['balamt']))
									{?>
                                   	 <input type="hidden" name="due_amt" id="due_amt" value="<?php echo intval($balance_amt); ?>" />
                                  	 <label for="due_amt" class="col-sm-4">Due Amount: Rs.<?php echo $balance_amt; ?></label>
                              <?php }?>
									</div>
                                </div>
                                <div class="form-group">
									<label for="pay_mode" class="col-sm-2 control-label label-input-sm">Payment Mode</label>
									<div class="col-sm-8">
										<select class="form-control1" name="pay_mode" id="pay_mode" onchange="paymodechange(),calculate();" required>
                                        	<option value="">-Select-</option>
                                            <option value="CASH">CASH</option>
                                            <option value="CHEQUE">CHEQUE</option>
                                            <option value="NEFT/RTGS">NEFT/RTGS</option>
                                         </select>
									</div>
                                </div>  
                                 <div class="form-group">
									<label for="cheque_no" class="col-sm-2 control-label label-input-sm">Cheque/Reference No.</label>
									<div class="col-sm-8">
										<input type="text" disabled="disabled"  class="form-control1 input-sm" id="cheque_no" name="cheque_no" >
									</div>
                                </div> 
                                 <div class="form-group">
									<label for="paid_amt" class="col-sm-2 control-label label-input-sm">Paid Amount</label>
									<div class="col-sm-8">
									   <input type="number" min="0" max="<?php echo round($billed_amt);  ?>" step="any" onBlur="calculate();"  class="form-control1 input-sm" onKeyUp="calculate();" required id="paid_amt" name="paid_amt"/>
									</div>
                                </div>                            	
                                 <div class="form-group">
									<label for="paid_amt" class="col-sm-2 control-label label-input-sm">Bank Charge</label>
									<div class="col-sm-8">
									   <input type="number" min="0" max="<?php echo round($billed_amt);  ?>" step="any" onBlur="calculate();"  class="form-control1 input-sm" onKeyUp="calculate();" required id="bank_charge" name="bank_charge"/>
									</div>
                                </div>                           
                               
                                 <div class="form-group">
									<label for="bal_amt" class="col-sm-2 control-label label-input-sm">Balance Amount</label>
									<div class="col-sm-8">
									   <input type="text"   class="form-control1 input-sm" readonly id="bal_amt" value="0" name="bal_amt"/>
									</div>
                                </div>
                                    <div class="col-sm-8 col-sm-offset-2">
                                    	<input type="hidden" name="inv_id" value="<?php echo $invoice_id; ?>" />
										<button type="submit" name="genrate_reciept" class="btn-success btn">Genrate</button>
									</div>
							</form>
						</div>
					</div>
  </div>
  <?php include_once('footer.php'); ?>