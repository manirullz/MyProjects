<link href="invoice/css/font-awesome.min.css" rel="stylesheet">

<?php
session_start();
include_once('config.php');
include_once('inttoword.php');

if($_SESSION['admin_username']=="")
{
	header('Location:index.html');
}

$inv_id			= $_REQUEST['inv_id'];

$getInvoicedata	= "SELECT * FROM invoice_master WHERE invoice_id=".$inv_id."";
$exe_result	= mysqli_query($con,$getInvoicedata);
$resultdata	= mysqli_fetch_array($exe_result);

$invoice_no	 =	$resultdata['invoice_no'];   
$companyName =	strtoupper($resultdata['companyName']);
$serviceTxNo =	$resultdata['tinNo'];
$buyerName	 = 	$resultdata['buyerName'];
$buyertxno	 = 	$resultdata['buyertxno'];
$poNo		 =	$resultdata['poNo'];
if(date('d-m-Y',strtotime($resultdata['podate']))=='01­01­1970')
{
	$podate		 =	'NA';
}
else
{
	$podate		 =	date('d-m-Y',strtotime($resultdata['podate']));
}	
$paymentTerm =	$resultdata['paymentTerm'];
$salesExe	 =	$resultdata['salesExe'];
$moPay		 =	$resultdata['moPay'];
$supplier	 = 	$resultdata['supplier'];
$invoiceDate =	date('d-m-Y',strtotime($resultdata['invoiceDate']));

$serviceNo	 =	explode(',',$resultdata['serviceNo']);
$serviceType =	explode(',',$resultdata['serviceType']);
$price		 =	explode(',',$resultdata['price']);
$quantity	 =	explode(',',$resultdata['quantity']);
$total		 =	explode(',',$resultdata['total']);
$sac		 =	explode(',',$resultdata['hsn_no']);

$subTotal	 =	$resultdata['subTotal'];
$discount	 = 	$resultdata['discount'];
$discountAmt = 	$resultdata['discountamt'];
$amtAfterdis = 	$resultdata['amtaftrdisc'];
$tax		 =	$resultdata['tax'];
$taxAmount	 =	$resultdata['taxAmount'];
//SWACH BHARAT MODIFIED\\\\
$swachCess	 =  $resultdata['swachCess'];
$swachCessAmt= 	$resultdata['swachCessAmt'];
//SWACH BHARAT MODIFIED\\\\

$surcharge	 = 	$resultdata['surcharge'];
$surchargeAmt=	$resultdata['surchargeamt'];
$totalAfterTax	=	$resultdata['totalAfterTax'];

///PAYABLE AMOUNT\\\\
$amtPayable	 = $resultdata['amtPayable'];
//$amountPaid	 	=	$resultdata['amountPaid'];
//$amountDue	 	=	$resultdata['amountDue'];
//$dateModified	=	$resultdata['dateModified'];

//AKHILESH CUSTOM REQUIREMENT
//$working_days   = $resultdata['no_working_days'];
//$hsn_no         = $resultdata['hsn_no'];

$pan_no    = $resultdata['pan_no'];
$pf_no     = $resultdata['pf_no'];
$esi_no    = $resultdata['esi_no'];
$address   = $resultdata['address'];
?>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=euc-jp">
<title><?php echo $companyName; ?> | Invoice No.<?php echo $invoice_no; ?> </title>
<STYLE TYPE="text/css">
     .breakhere {page-break-before: always}
	 
</STYLE>
<style type="text/css" media="print">
    @page 
    {
        size: auto;   /* auto is the initial value */
        margin: 5.19mm;  /* this affects the margin in the printer settings */
    }

    body 
    {
        background-color:#FFFFFF; 
       /* border: solid 1px black ;*/
        margin: 0px;  /* this affects the margin on the content before sending to printer */
   }
</style>
</head>
<body  onload="window.print();">
<div id="page-wrapper" style="border-style:solid; border-width:1px;margin:0;padding:0;">               
  	        <!-- Begin page content -->
    <div class="container content" style="padding:2px;">    	    
    	<div class='row'>
      		<div style="width:100%">            
      			<div style="width:40%; float:left;" >GST No:<?php echo $serviceTxNo; ?><br>
                </div>
                <div style="width:40%;float:left;">RETAIL/TAX Invoice</div>
                <div style="width:20%;float:left;" align="center">Orignal Copy</div>
                </div><br>
                <div style="width:100%;border-solid; border-width:1px;" align="center">
                <img src="images/logo_nasis.png" height="65px" width="175px" style="float:left">
                <h2 style="margin-bottom: -16px;"><?php echo $companyName; ?></h2><br>
                <sub><b>Reg. Address:</b> 1029,Shiv Nagar,Near Police Chowki,<br>
                Allahabad ,Uttar Pradesh (india)-211002<br>
                </sub>
                <sub><b>Office Address:</b> Plot No.100,RC Plaza,SiddharthVihar,Gaziabad-201009,UP(India)<br>
               	<sub style="padding-left:22%;"><b>Phone:</b>+91-7065044521 , <b>Email:</b> info@nasis.in,
                 <b>Website-</b> www.nasis.com</sub>
                 </sub>
                </div>
                <div style="width:100%;border-top-style:solid;border-bottom-style:solid; border-width:1px;height: 175px">
                <div style="width:50%; float:left;height: 175px;border-right-style:solid; border-width:1px;;">
                <p><b>Organisation Info:</b><br>
                <?php echo $buyerName; ?><br>
                <b>Buyer GST No:</b><br>
                <?php echo $buyertxno; ?><br>
                <b>Address:</b><br>
                <?php echo $address; ?>
                </p>              
                </div>
                <div style="height:175px;">
                    <p style="float:left;margin-left: 20px;">
                    <label>Invoice No.</label><br>
                    <label>Dated</label><br>
                    <!--<label>P.O No</label><br>
                    <label>P.O Date</label><br>-->
                    <label>Payment Term</label><br>
                    <label>Mode Of Payment</label><br>
                    <label>Sales Executive</label><br>
                    <label>PF No.</label><br>
                    <label>Pan No.</label><br>
                    <label>ESI No.</label><br>
                    </p>
                    <p style="float:left;margin-left: 50px;">
                    <label>:<?php echo $invoice_no; ?></label><br>
                    <label>:<?php echo $invoiceDate; ?></label><br>
                   <!-- <label>:<?php echo $poNo; ?></label><br>
                    <label>:<?php echo $podate; ?></label><br>-->
                    <label>:<?php echo $paymentTerm; ?></label><br>
                    <label>:<?php echo $moPay; ?></label><br>
                    <label>:<?php echo $salesExe;?></label><br>
                    <label>:<?php echo $pf_no;?></label><br>
                    <label>:<?php echo $pan_no;?></label><br>
                    <label>:<?php echo $esi_no;?></label><br>
                   </p>
                </div>
                </div>
      			<table rules="cols" height="300px" cellpadding="0" cellspacing="0" width="100%">
					<thead>
						<tr style="border-style:solid; border-width:1px;margin:0;padding:0;">
							<th width="5%" align="left">Srl. No</th>
							<!--<th width="10%" align="left">Service No.</th>-->
							<th width="27.3%" align="left">Service Type</th>
							<th width="10%" align="left">SAC / HSN </th>
							<th width="5%" align="left"> Working Days </th>                            
                            <th width="5%" align="left"> Rate </th>
							<th width="15%" align="center">Amount(<i class="fa fa-inr"></i>)</th>
						</tr>
					</thead>
					<tbody>
                    <?php 
                   foreach($serviceNo as $i =>$key)
				    {
						$i >0;
   							?> 
						<tr style="vertical-align:baseline;height:1px;">
							<td><?php echo $i+1; ?></td>
							<!--<td><?php echo $serviceNo[$i]; ?></td>-->
							<td><?php echo $serviceType[$i];?></td>
							<td><?php echo $sac[$i]; ?></td>
							<td><?php echo $quantity[$i]; ?></td>
							<td><?php echo round($price[$i]*31,2);?></td>
                            <td align="center"><?php echo $total[$i];?></td>
						</tr>
                        <?php }?>
						</tr>
						<tr style="vertical-align:baseline;height: auto;">
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
                            <td align="center"></td>
						</tr>
					</tbody>
				</table>
                <div style="width:100%;border-bottom-style:solid; border-width:1px;border-top-style:solid;" align="right">
                                	
				<table>
                <tr><td width="35%"></td><td>&nbsp;</td><td width="30%">&nbsp;Total&nbsp;</td><td width="30%" align="left"><i class="fa fa-inr"></i><?php echo intval($subTotal); ?><?php /*?><?php echo $subTotal; ?><?php */?></td></td></tr>
              <?php if($discount!='0')
					{?>
                <tr><td width="25%">LESS:</td><td width="25%">Discount&nbsp;</td><td width="30%">@&nbsp;<?php echo $discount; ?>%</td><td width="20%"><?php echo $discountAmt; ?></td></td></tr>
                <tr><td></td><td>&nbsp;</td><td>&nbsp;Total(Rs.)</td><td width="20%"><?php echo $amtAfterdis; ?></td></td></tr>
                <?php } ?>
                <tr><td width="25%">ADD:</td><td width="25%">TAX&nbsp;</td><td width="30%">@&nbsp;<?php echo $tax; ?>%</td><td width="20%"><i class="fa fa-inr"></i><?php echo $taxAmount; ?></td></tr> 
                <tr><td width="25%">ADD:</td><td width="25%">Swacch Bharat Cess&nbsp;</td><td width="30%">@&nbsp;<?php echo $swachCess; ?>%</td><td width="20%"><i class="fa fa-inr"></i><?php echo $swachCessAmt; ?></td></tr> 
                <tr><td width="25%" style="border-bottom: 1px solid #000;">ADD:</td><td width="25%" style="border-bottom: 1px solid #000;">Krishi Kalyan Cess&nbsp;</td><td width="30%" style="border-bottom: 1px solid #000;">@&nbsp;<?php echo $surcharge; ?>%</td><td width="20%" style="border-bottom: 1px solid #000;"><?php echo $surchargeAmt; ?></td></td></tr>                                         
                <tr><td width="25%"></td><td width="25%">&nbsp;</td><td width="30%">Grand Total(<i class="fa fa-inr"></i>)</td><td width="20%"><?php echo $totalAfterTax; ?></td></tr>
                <tr><td width="25%"></td><td width="25%">&nbsp;</td><td width="30%">Payable Amount(<i class="fa fa-inr"></i>)</td><td width="20%"><?php echo $amtPayable; ?></td></tr>
               
                </table>
                <table style="width: 100%;text-align: right;">
                    <tr><td>AMOUNT IN WORDS:</td><td> <i><?php echo "RUPEES "; echo strtoupper(no_to_words($amtPayable));  ?>ONLY </i></td></tr>
                </table>
                </div>
                <div style="width:100%; margin-top:30px">
                <div style="border-right-style: solid; border-width:1px;height: 190px; width:50%; float:left;margin-top: 0px; margin-right:23px;">
                <div> 
                 
                  <p><b>Note:</b>Please make the payment of bill through NEFT/RGTS in below mention account.
                   <p></p>
                    <b>
                    New Alert Security & Intelligence Services.</br>
                    A/C No.712220110000462</br>
                    Bank Of Indaia,Sec-62,Noida</br>
                    IFSC:INDB0000714</br>
                    Account Type:Current</br>
                    </b>
                 </p>             
                </div>
                </div>
                <div style="height: 155px; margin-top:-30px;">               
                <div>
                 <h5>Terms & Condition(E & O.E.)</h5>              
                 <ol>
                	<!--<li>Goods once sold will not be taken back.</li>
                    <li>Interest @ 24% p.a will be charged if the payment is not made within the stipulated time.</li>-->
                    <li>Subject To 'Gaziabaad' Jurisdiction only.</li>
                </ol> 
                <div style="border-bottom: 1px solid #000;margin-left: 50%;"></div>              
                <h5 align="right" style="padding-top: 1px;">&nbsp;&nbsp;For&nbsp;<?php echo $companyName; ?></h5></div>
                </div>
                <p align="right" style="margin-bottom:0px;"><b>Authorised-Signatory</b></p>
      			</div>
      		</div>
    	</div>
    </div>
    
    <div id="page-wrapper" style="border-style:solid; border-width:1px;margin:0;padding:0;" class="breakhere"> 
           <!-- Begin page content -->
      <div id="page-wrapper" style="border-style:solid; border-width:1px;margin:0;padding:0;">               
  	        <!-- Begin page content -->
    <div class="container content" style="padding:2px;">    	    
    	<div class='row'>
      		<div style="width:100%">            
      			<div style="width:40%; float:left;" >GST No:<?php echo $serviceTxNo; ?><br>
                </div>
                <div style="width:40%;float:left;">RETAIL/TAX Invoice</div>
                <div style="width:20%;float:left;" align="center">Duplicate Copy</div>
                </div><br>
                <div style="width:100%;border-solid; border-width:1px;" align="center">
                <img src="images/logo_nasis.png" height="65px" width="175px" style="float:left">
                <h2 style="margin-bottom: -16px;"><?php echo $companyName; ?></h2><br>
                <sub><b>Reg. Address:</b> 1029,Shiv Nagar,Near Police Chowki,<br>
                Allahabad ,Uttar Pradesh (India)-211002 <br>
                </sub>
                <sub><b>Office Address:</b> Plot No.100,RC Plaza,SiddharthVihar,Gaziabad-201009,UP(India)<br>
               	<sub style="padding-left:22%;"><b>Phone:</b>+91-7065044521 , <b>Email:</b> info@nasis.in,newalertsisacc@gmail.com
                 <b>Website-</b> www.nasis.com</sub>
                 </sub>
                </div>
                <div style="width:100%;border-top-style:solid;border-bottom-style:solid; border-width:1px;height: 175px">
                <div style="width:50%; float:left;height: 175px;border-right-style:solid; border-width:1px;;">
                <p><b>Organisation Info:</b><br>
                <?php echo $buyerName; ?><br>
                <b>Buyer GST No:</b><br>
                <?php echo $buyertxno; ?><br>
                <b>Address:</b><br>
                <?php echo $address; ?>
                </p>              
                </div>
                <div style="height:175px;">
                    <p style="float:left;margin-left: 20px;">
                    <label>Invoice No.</label><br>
                    <label>Dated</label><br>
                    <!--<label>P.O No</label><br>
                    <label>P.O Date</label><br>-->
                    <label>Payment Term</label><br>
                    <label>Mode Of Payment</label><br>
                    <label>Sales Executive</label><br>
                    <label>PF No.</label><br>
                    <label>Pan No.</label><br>
                    <label>ESI No.</label><br>
                    </p>
                    <p style="float:left;margin-left: 50px;">
                    <label>:<?php echo $invoice_no; ?></label><br>
                    <label>:<?php echo $invoiceDate; ?></label><br>
                   <!-- <label>:<?php echo $poNo; ?></label><br>
                    <label>:<?php echo $podate; ?></label><br>-->
                    <label>:<?php echo $paymentTerm; ?></label><br>
                    <label>:<?php echo $moPay; ?></label><br>
                    <label>:<?php echo $salesExe;?></label><br>
                    <label>:<?php echo $pf_no;?></label><br>
                    <label>:<?php echo $pan_no;?></label><br>
                    <label>:<?php echo $esi_no;?></label><br>
                    </p>
                </div>
                </div>
      			<table rules="cols" height="300px" cellpadding="0" cellspacing="0" width="100%">
					<thead>
						<tr style="border-style:solid; border-width:1px;margin:0;padding:0;">
							<th width="5%" align="left">Srl. No</th>
							<!--<th width="10%" align="left">Service No.</th>-->
							<th width="27.3%" align="left">Service Type</th>
							<th width="10%" align="left">SAC / HSN </th>
							<th width="5%" align="left"> Working Days </th>                            
                            <th width="5%" align="left"> Rate </th>
							<th width="15%" align="center">Amount(<i class="fa fa-inr"></i>)</th>
						</tr>
					</thead>
					<tbody>
                    <?php 
                   foreach($serviceNo as $i =>$key)
				    {
						$i >0;
   							?> 
						<tr style="vertical-align:baseline;height:1px;">
							<td><?php echo $i+1; ?></td>
							<!--<td><?php echo $serviceNo[$i]; ?></td>-->
							<td><?php echo $serviceType[$i];?></td>
						    <td><?php echo $sac[$i]; ?></td>
							<td><?php echo $quantity[$i]; ?></td>
							<td><?php echo round($price[$i]*31,2);?></td>
                            <td align="center"><?php echo $total[$i];?></td>
						</tr>
                        <?php }?>
						</tr>
						<tr style="vertical-align:baseline;height: auto;">
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
                            <td align="center"></td>
						</tr>
					</tbody>
				</table>
                <div style="width:100%;border-bottom-style:solid; border-width:1px;border-top-style:solid;" align="right">                	
				<table>
                <tr><td width="35%"></td><td>&nbsp;</td><td width="30%">&nbsp;Total&nbsp;</td><td width="30%" align="left"><i class="fa fa-inr"></i><?php echo intval($subTotal); ?><?php /*?><?php echo $subTotal; ?><?php */?></td></td></tr>
              <?php if($discount!='0')
					{?>
                <tr><td width="25%">LESS:</td><td width="25%">Discount&nbsp;</td><td width="30%">@&nbsp;<?php echo $discount; ?>%</td><td width="20%"><?php echo $discountAmt; ?></td></td></tr>
                <tr><td></td><td>&nbsp;</td><td>&nbsp;Total(Rs.)</td><td width="20%"><?php echo $amtAfterdis; ?></td></td></tr>
                <?php } ?>
                <tr><td width="25%">ADD:</td><td width="25%">TAX&nbsp;</td><td width="30%">@&nbsp;<?php echo $tax; ?>%</td><td width="20%"><i class="fa fa-inr"></i><?php echo $taxAmount; ?></td></tr> 
                <tr><td width="25%">ADD:</td><td width="25%">Swacch Bharat Cess&nbsp;</td><td width="30%">@&nbsp;<?php echo $swachCess; ?>%</td><td width="20%"><i class="fa fa-inr"></i><?php echo $swachCessAmt; ?></td></tr> 
                <tr><td width="25%" style="border-bottom: 1px solid #000;">ADD:</td><td width="25%" style="border-bottom: 1px solid #000;">Krishi Kalyan Cess&nbsp;</td><td width="30%" style="border-bottom: 1px solid #000;">@&nbsp;<?php echo $surcharge; ?>%</td><td width="20%" style="border-bottom: 1px solid #000;"><?php echo $surchargeAmt; ?></td></td></tr>                                         
                <tr><td width="25%"></td><td width="25%">&nbsp;</td><td width="30%">Grand Total(<i class="fa fa-inr"></i>)</td><td width="20%"><?php echo $totalAfterTax; ?></td></tr>
                <tr><td width="25%"></td><td width="25%">&nbsp;</td><td width="30%">Payable Amount(<i class="fa fa-inr"></i>)</td><td width="20%"><?php echo $amtPayable; ?></td></tr>
                </table>
                <table style="width: 100%;text-align: right;">
                    <tr><td>AMOUNT IN WORDS:</td><td> <i><?php echo "RUPEES "; echo strtoupper(no_to_words($amtPayable));  ?>ONLY </i></td></tr>
                </table>
                </div>
                <div style="width:100%; margin-top:30px">
                <div style="border-right-style: solid; border-width:1px;height: 190px; width:50%; float:left;margin-top: 0px; margin-right:23px;">
                <div> 
                
                  <p><b>Note:</b>Please make the payment of bill through NEFT/RGTS in below mention account.
                   <p></p>
                    <b>
                    New Alert Security & Intelligence Services.</br>
                    A/C No.712220110000462</br>
                    Bank Of Indaia,Sec-62,Noida</br>
                    IFSC:INDB0000714</br>
                    Account Type:Current</br>
                    </b>
                 </p>             
                </div>
                </div>
                <div style="height: 155px; margin-top:-30px;">               
                <div>
                 <h5>Terms & Condition(E & O.E.)</h5>              
                 <ol>
                	<!--<li>Goods once sold will not be taken back.</li>
                    <li>Interest @ 24% p.a will be charged if the payment is not made within the stipulated time.</li>-->
                    <li>Subject To 'Gaziabaad' Jurisdiction only.</li>
                </ol> 
                <div style="border-bottom: 1px solid #000;margin-left: 50%;"></div>              
                <h5 align="right" style="padding-top: 1px;">&nbsp;&nbsp;For&nbsp;<?php echo $companyName; ?></h5></div>
                </div>
                <p align="right" style="margin-bottom:0px;"><b>Authorised-Signatory</b></p>
      			</div>
      		</div>
    	</div>
    </div>
    	</div>
    </div>
</body>
</html>
