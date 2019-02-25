<?php include_once('header.php');
include_once('config.php');
$getidquery	= "SELECT invoice_id,invoice_no FROM invoice_master WHERE companyName = 'NASIS' order by invoice_id desc limit 1";
$result		 =  mysqli_query($con,$getidquery);
$arrayResult =  mysqli_fetch_array($result);
$id			 = $arrayResult['invoice_id'];

$invoiceNo	 = $arrayResult['invoice_no'];
$invNoArray	 = explode('/',$invoiceNo);
//print_r($invNoArray);

$inv_id		 = $invNoArray[3]+1;
date_default_timezone_set('Asia/Calcutta');
//echo date("m");
//echo date("d");
//if(date("m")==4 && date("d")==1)
//{
	//$inv_id	 = 1;
//}

$gettaxquery	= "SELECT * FROM tax_master WHERE taxType='SERVICE TAX'";
$resulttxtype	= mysqli_query($con,$gettaxquery);
$taxArray		= mysqli_fetch_array($resulttxtype);
$servicetax		= $taxArray['taxPercent'];
$getsurcharge	= "SELECT * FROM tax_master WHERE taxType='SURCHARGE'";
$resultsurcharge= mysqli_query($con,$getsurcharge);
$surchargeArray	= mysqli_fetch_array($resultsurcharge);
$surcharge		= $surchargeArray['taxPercent'];



?>
<style>
.form-group
{
	margin-bottom: 8px;
}
</style>
<div id="page-wrapper">
        <div class="graphs">
	     <div class="xs">
  	       <h4 align="center">Enter Billing Details</h4>
  	        <!-- Begin page content -->
    <div class="container content">    	
        <form action="add-invoice.php" method="post" role="form" enctype="multipart/form-data">
    	<div class='row'>
      		<div class='col-lg-4'>            
      			<div class="form-group">
                   <label>Company Name</label>
				   <input type="text" class="form-control" readonly name="companyName" id="companyName" value="New Alert Security & Intelligence Services.">
				</div>
				<div class="form-group">
                	<label>GST No.</label>
					<input type="text" class="form-control" readonly name="serviceTaxno" id="serviceTaxno" value="09ADRPT7551M1ZG">
				</div>
                <div class="form-group">
                	<label>Buyer Name</label>
					<input type="text" class="form-control" name="clientName" id="clientName" required placeholder="Buyer Name">
				</div>
                <div class="form-group">
                	<label>Buyer GST No.</label>
					<input type="text" class="form-control"  name="buyertxno" id="buyertxno" value="">
				</div>
               
      		</div>
            <div class='col-lg-4'>
                <div class="form-group">
                	<label>P.O.No.</label>
					<input type="number" min="0" class="form-control" name="poNo" id="poNo" >
				</div>
                <div class="form-group">
                	<label>P.O Date.</label>
					<input type="text"  class="form-control" id="poDate" name="poDate" >
				</div>
                <div class="form-group">
                	<label>Invoice No.</label>
					<input type="text" class="form-control" name="invNo" id="invNo" readonly value="NASIS/bill/<?php if(date("m")>3){ echo date("Y"); ?>-<?php echo date("y")+1;} else{ echo date("Y")-1; ?>-<?php echo date("y"); } ?>/<?php echo $inv_id; ?>">
				</div>
                
                <div class="form-group">
                	<label>Invoice Date</label>
					<input type="text" class="form-control" name="invoiceDate" id="invoiceDate" placeholder="Invoice Date" required>
				</div>            
            </div>
            <div class='col-lg-3'>
                <div class="form-group">
                	<label>Payment Term</label>
					<input type="text" class="form-control" name="payTerm" id="payTerm" value="">
				</div>
                <div class="form-group">
                	<label>Sales Executive</label>
					<input type="text" class="form-control" name="salesExe" id="salesExe" value="">
				</div>
                <div class="form-group">
                	<label>Mode Of Payment</label>
					<select name="mop" id="mop" class="form-control">
                    	<option value="CASH">CASH</option>
                        <option value="CHEQUE">CHEQUE</option>
                        <option value="NEFT/RTGS">NEFT/RTGS</option>
                    </select>
				</div>
                <div class="form-group">
                	<label>Supplier</label>
					<input type="text" class="form-control" name="supplier" id="supplier" value="">
				</div>
      		</div>
      		<div class='col-lg-4'>
                <div class="form-group">
                	<label>PF.No.</label>
					<input type="text" min="0" class="form-control" name="pf_no" id="pf_no" readonly value="MRMRT1666828000" />
				</div>
			</div>
			<div class='col-lg-4'>
                <div class="form-group">
                	<label>PAN  No.</label>
					<input type="text"  class="form-control" id="pan_no" name="pan_no" value=""/>
				</div>
			</div>
			<div class='col-lg-3'>
                <div class="form-group">
                	<label>ESI No.</label>
					<input type="text" class="form-control" name="esi_no" id="esi_no" readonly value="67000653870000999" />
				</div>
            </div>
      			<div class='col-lg-4'>
                <div class="form-group">
                	<label>Address</label>
					<input type="text" class="form-control" name="address" id="address" />
				</div>
            </div>
			
      	</div>      	
      		<div class='col-xs-12 col-sm-12 col-md-12 col-lg-11'>
      			<table class="table table-bordered table-hover">
					<thead>
						<tr>
							<th width="2%"><input id="check_all" class="formcontrol" type="checkbox"/></th>
							<th width="8%">Service No</th>
							<th width="20%">Service Type</th>
							<th width="10%">SAC / HSN </th>
							<th width="10%">Rate </th>
							<th width="10%">Duties</th>
							<th width="15%">Ammount</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><input class="case" type="checkbox"/></td>
							<td><input type="text" data-type="productCode" name="itemNo[]" id="itemNo_1" class="form-control autocomplete_txt" autocomplete="off"></td>
							<td><input type="text" data-type="productName" name="itemName[]" id="itemName_1" class="form-control autocomplete_txt" autocomplete="off"></td>
							<td><input type="text" name="sac[]" id="sac_1" class="form-control" autocomplete="off"></td>
							<td><input type="text" name="price[]" id="price_1" class="form-control changesNo" autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;"></td>
							<td><input type="number" min="1" name="quantity[]" id="quantity_1" class="form-control changesNo" autocomplete="off" onkeypress="return IsNumeric(event);" value="1" ondrop="return false;" onpaste="return false;"></td>                            
							<td><input type="text" name="total[]" id="total_1" readonly="readonly" class="form-control totalLinePrice" autocomplete="off" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;"></td>
						</tr>
					</tbody>
				</table>
      		</div>
      	</div>
      	<div class='row'>
      		<div class='col-xs-12 col-sm-3 col-md-3 col-lg-3'>
      			<button class="btn btn-danger delete" type="button">- Delete</button>
      			<button class="btn btn-success addmore" type="button">+ Add More</button>
      		</div>
         </div>
         <div class='row'>
      		<div class='col-xs-6'>
					<div class="form-group">
						<label>Subtotal: &nbsp;</label>
						<div class="input-group">
							<div class="input-group-addon">Rs.</div>
							<input type="text" class="form-control" name="subTotal" id="subTotal" placeholder="Subtotal" onkeypress="return IsNumeric(event);" ondrop="return false;" readonly="readonly" onpaste="return false;">
						</div>
					</div>
                    <div class="form-group">
						<label>Discount: &nbsp;</label>
						<div class="input-group">
							<div class="input-group-addon">%</div>
							<input type="text" class="form-control" name="discount" id="discount" placeholder="discount" onkeypress="return IsNumeric(event);" ondrop="return false;" value="0" onpaste="return false;">
						</div>
					</div>
                    <div class="form-group">
						<label>Discount Amount: &nbsp;</label>
						<div class="input-group">
							<div class="input-group-addon">Rs</div>
							<input type="text" class="form-control" name="discountamt" id="discountamt" onkeypress="return IsNumeric(event);" ondrop="return false;" value="0" readonly="readonly" onpaste="return false;">
						</div>
					</div>
                    <div class="form-group">
						<label>Total: &nbsp;</label>
						<div class="input-group">
							<div class="input-group-addon">Rs</div>
							<input type="text" class="form-control" readonly="readonly" name="amtafterdis" id="amtafterdis" onkeypress="return IsNumeric(event);" ondrop="return false;" value="0" onpaste="return false;">
						</div>
					</div>	
                    <div class="form-group">
						<label>Tax: &nbsp;</label>
						<div class="input-group">
							<div class="input-group-addon">%</div>
							<input type="text" class="form-control" name="tax" id="tax" placeholder="Tax" onkeypress="return IsNumeric(event);" ondrop="return false;" value="<?php echo $servicetax; ?>" onpaste="return false;">
						</div>
					</div>
					<div class="form-group">
						<label>Tax Amount: &nbsp;</label>
						<div class="input-group">
                        <div class="input-group-addon">Rs.</div>
							<input type="text" class="form-control" readonly="readonly" name="taxAmount" id="taxAmount" placeholder="Tax" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;">
							
						</div>
					</div>				
                    </div>
                    <div class='col-xs-6'>                    
                    <div class="form-group">
						<label>Swachh Bharat Cess: &nbsp;</label>
						<div class="input-group">
							<div class="input-group-addon">%</div>
							<input type="text" class="form-control" name="swachCess" id="swachCess" placeholder="Swachh Bharat Cess" onkeypress="return IsNumeric(event);" ondrop="return false;" value="<?php echo $surcharge; ?>" onpaste="return false;">
						</div>
					</div>
					<div class="form-group">
						<label>Swachh Bharat Amt: &nbsp;</label>
						<div class="input-group">
                        <div class="input-group-addon">Rs.</div>
							<input type="text" class="form-control" name="CessAmt" id="CessAmt" placeholder="Swachh Bharat Cess" onkeypress="return IsNumeric(event);" ondrop="return false;" readonly="readonly" onpaste="return false;">
							
						</div>
					</div>
                    <div class="form-group">
						<label>Krishi Kalyan Cess: &nbsp;</label>
						<div class="input-group">
							<div class="input-group-addon">%</div>
							<input type="text" class="form-control" name="surcharge" id="surcharge" placeholder="Total" onkeypress="return IsNumeric(event);" ondrop="return false;" value="<?php echo $surcharge; ?>" onpaste="return false;">
						</div>
					</div>
                    <div class="form-group">
						<label>Krishi Kalyan Cess Amt: &nbsp;</label>
						<div class="input-group">
							<div class="input-group-addon">Rs.</div>
							<input type="text" class="form-control" name="surchargeamt" id="surchargeamt" readonly="readonly" onkeypress="return IsNumeric(event);" ondrop="return false;" value="" onpaste="return false;">
						</div>
					</div>
					<div class="form-group">
						<label>Grand Total: &nbsp;</label>
						<div class="input-group">
							<div class="input-group-addon">Rs.</div>
							<input type="text" class="form-control" name="totalAftertax" id="totalAftertax" readonly="readonly" placeholder="Total" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;">
						</div>
					</div>
                    
					<div class="form-group">
                    <label>Final Payable Amount: &nbsp;</label>
						<div class="input-group">
							<div class="input-group-addon">Rs.</div>
							<input type="text" class="form-control" name="totalAfterRound" readonly="readonly" id="totalAfterRound" placeholder="Total Amount After Roundoff" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;">
						</div>
                    <!--
						<label>Amount Paid: &nbsp;</label>
						<div class="input-group">
							<div class="input-group-addon">Rs.</div>
							<input type="text" class="form-control" name="amountPaid" id="amountPaid" required placeholder="Amount Paid" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;">
						</div>
					</div>
					<div class="form-group">
						<label>Amount Due: &nbsp;</label>
						<div class="input-group">
							<div class="input-group-addon">Rs.</div>
							<input type="text" class="form-control amountDue" name="amountDue" id="amountDue" placeholder="Amount Due" onkeypress="return IsNumeric(event);" ondrop="return false;" onpaste="return false;">
						</div>
                        -->	
                        <button type="submit" name="createinvoice" value="yes" class="btn btn-success addmore" type="button">Submit</button>
					</div>			
			</div>
      	</div>
        </form>
    </div>
  <?php include_once('footer.php'); ?>