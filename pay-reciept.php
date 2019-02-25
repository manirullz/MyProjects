<?php
include_once('config.php');
include_once('inttoword.php');
if(isset($_REQUEST['pay_id']))
{
	$pay_id		= $_REQUEST['pay_id'];
	$getReciept	= "SELECT * FROM payment_detail WHERE pay_id=".$pay_id."";
	$exeGetReciept	= mysqli_query($con,$getReciept);
	$arrayReciept	= mysqli_fetch_array($exeGetReciept);
	$invoice_id		= $arrayReciept['invoice_id'];
	$payDate		= $arrayReciept['pay_date'];
	$payMode		= $arrayReciept['pay_mode'];
	$payType_no		= $arrayReciept['payType_no'];
	$bank_charge	= $arrayReciept['bank_charge'];
	$invoice_amt	= $arrayReciept['invoice_amt'];
	//$invoice_amt	= 2109;
	$splitAmt		= explode(".",$invoice_amt);
	@$invoice_amtBefore	= $splitAmt[0];
	@$invoice_amtAfter	= $splitAmt[1];
	$paid_amt		= $arrayReciept['paid_amt']+$bank_charge;
	$splitPaid		= explode(".",$paid_amt);
	$paid_amtBefore	= $splitPaid[0];
	$paid_amtAfter	= $splitPaid[1];
	$balance_amt	= intval($arrayReciept['balance_amt']);
	
	$getInvoice		= "SELECT * FROM invoice_master WHERE invoice_id=".$invoice_id."";
	$exeInvoice		= mysqli_query($con,$getInvoice);
	$arrayInvoice	= mysqli_fetch_array($exeInvoice);
	$invoiceNo		= $arrayInvoice['invoice_no'];
	$companyName	= $arrayInvoice['companyName'];
	$buyerName		= $arrayInvoice['buyerName'];
	$invoiceDate	= $arrayInvoice['invoiceDate'];
	$serviceTxNo 	= $arrayInvoice['serviceTaxno'];

}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Payment Reciept-<?php echo $buyerName;  ?></title>
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
<body onload="window.print();">
<div style="padding:5px;">
<div style="width:100%">  
                <div style="width:100%;" align="right">(Original Copy)</div>
                <div style="width:100%;" align="center">
                <h2 style="margin-bottom: -16px;"><?php echo $companyName; ?></h2><br>                
                 <sub>Plot No.89, Sector-44,<br>
                Gurgaon-122003,Haryana(India)<br>                
                Ph.+91-124-4215577 Email:info@invadertech.com<br>               
                </sub>
                </div><br />
                <div align="center"><b>Payment Reciept</b></div>
<label>Date: <?php echo date("F j, Y",strtotime($payDate)) ;?></label>

<dl>
  <dt>To,</dt>
  <dt><?php echo $buyerName; ?></dt>
  <br /><br />
   <dt><b>Subject : Receipt of Payment</b></dt>
   <br />
  <dt>Dear Sir,</dt>

  <p> We earnestly acknowledege your payment of Rs.<?php echo $paid_amt ?>/- (<?php echo "RUPEES "; echo strtoupper(no_to_words($paid_amtBefore)); ?><?php if(!empty($paid_amtAfter)&&($paid_amtAfter>0)){ echo "&amp "; echo strtoupper(no_to_words($paid_amtAfter)); echo" PAISE "; } ?>ONLY ), which was received via <?php echo $payMode ?>  <?php if($payMode!='CASH'){ echo"("; echo"Ref. No. "; echo $payType_no; echo ")";} ?> Dated <?php echo date("F j, Y",strtotime($payDate)) ;?> against our tax invoice/bill no. <?php echo $invoiceNo; ?> dated <?php echo date("F j, Y",strtotime($invoiceDate)) ;?> amounting to Rs.<?php echo $invoice_amt; ?>/- (<?php echo "RUPEES ";  echo strtoupper(no_to_words($invoice_amtBefore)); ?><?php if(!empty($invoice_amtAfter)&&($invoice_amtAfter>0)){ echo "&amp "; echo strtoupper(no_to_words($invoice_amtAfter)); echo" PAISE "; } ?>ONLY ). </p>
 
  <p>We appreciate your swiftness regarding initiating the business and look forward for long term relationship.</p>
 <dd style="float:right"><b>For <?php echo $companyName; ?></b></dd><br /><br />
 <dt style="float:right"> Authorized Signatory</dt>
</dl>
</div>
<!--------------------------------------------------------------DUPLICATE COPY ------------------------------------------------------------>
<div class="breakhere" style="padding:5px;">
<div style="width:100%">  
                <div style="width:100%;" align="right">(Duplicate Copy)</div>
                <div style="width:100%;" align="center">
                <h2 style="margin-bottom: -16px;"><?php echo $companyName; ?></h2><br>                
                 <sub>Plot No.89, Sector-44,<br>
                Gurgaon-122003,Haryana(India)<br>                
                Ph.+91-124-4215577 Email:info@invadertech.com<br>              
                </sub>
                </div><br />
                <div align="center"><b>Payment Reciept</b></div>
<label>Date: <?php echo date("F j, Y",strtotime($payDate)) ;?></label>

<dl>
  <dt>To,</dt>
  <dt><?php echo $buyerName; ?></dt>
  <br /><br />
   <dt><b>Subject : Receipt of Payment</b></dt>
   <br />
  <dt>Dear Sir,</dt>

  <p> We earnestly acknowledege your payment of Rs.<?php echo $paid_amt ?>/- (<?php echo "RUPEES "; echo strtoupper(no_to_words($paid_amtBefore)); ?><?php if(!empty($paid_amtAfter)&&($paid_amtAfter>0)){ echo "&amp "; echo strtoupper(no_to_words($paid_amtAfter)); echo" PAISE "; } ?>ONLY ), which was received via <?php echo $payMode ?>  <?php if($payMode!='CASH'){ echo"("; echo"Ref. No. "; echo $payType_no; echo ")";} ?> Dated <?php echo date("F j, Y",strtotime($payDate)) ;?> against our tax invoice/bill no. <?php echo $invoiceNo; ?> dated <?php echo date("F j, Y",strtotime($invoiceDate)) ;?> amounting to Rs.<?php echo $invoice_amt; ?>/- (<?php echo "RUPEES ";  echo strtoupper(no_to_words($invoice_amtBefore)); ?><?php if(!empty($invoice_amtAfter)&&($invoice_amtAfter>0)){ echo "&amp "; echo strtoupper(no_to_words($invoice_amtAfter)); echo" PAISE "; } ?>ONLY ). </p>
 
  <p>We appreciate your swiftness regarding initiating the business and look forward for long term relationship.</p>
 <dd style="float:right"><b>For <?php echo $companyName; ?></b></dd><br /><br />
 <dt style="float:right"> Authorized Signatory</dt>
</dl>
</div>
</body>
</html>
