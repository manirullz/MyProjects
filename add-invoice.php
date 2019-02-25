<?php
session_start();
include_once('config.php');
if($_SESSION['admin_username']=="")
{
	header('Location:index.html');
}
if(isset($_POST['createinvoice']))
{	
	$companyName	= mysqli_real_escape_string($con,$_POST['companyName']);
	$tinNo			= $_POST['serviceTaxno'];
	$buyerTxno		= empty($_POST['buyertxno'])?' ':$_POST['buyertxno'];
	$buyerName		= mysqli_real_escape_string($con,ucfirst($_POST['clientName']));
	$poNo			= mysqli_real_escape_string($con,$_POST['poNo']);
	$poDate			= date('Y-m-d', strtotime($_POST['poDate']));
	$invNo			= mysqli_real_escape_string($con,$_POST['invNo']);
	$payTerm		= mysqli_real_escape_string($con,$_POST['payTerm']);
	$salesExe		= mysqli_real_escape_string($con,ucfirst($_POST['salesExe']));
	$mop			= mysqli_real_escape_string($con,$_POST['mop']);
	$supplier		= mysqli_real_escape_string($con,$_POST['supplier']);
	$hsn_no 		= mysqli_real_escape_string($con,$_POST['hsnno']);
	$working_days	= mysqli_real_escape_string($con,$_POST['working_days']);
	
	$pan_no         = mysqli_real_escape_string($con,$_POST['pan_no']);
	$pf_no          = mysqli_real_escape_string($con,$_POST['pf_no']);
	$esi_no         = mysqli_real_escape_string($con,$_POST['esi_no']);
	$address        = mysqli_real_escape_string($con,$_POST['address']);
	
	//$productname	= $_POST['itemName'];
	$Date	= $_POST['invoiceDate'];	
	//$date = str_replace('/', '-', $Date);
	
	$invoiceDate = date('Y-m-d', strtotime($Date));	
	
	for($i = 0; $i<=count($_POST['itemNo']); $i++)
  	{
	   $itemNo1 	= implode(',',$_POST['itemNo']);
	   $itemName1 	= implode(',',$_POST['itemName']);
	   $price1 		= implode(',',$_POST['price']);
	   $quantity1 	= implode(',',$_POST['quantity']);
	 //$discount1 	= implode(',',$_POST['discount']);
	   $total1 		= implode(',',$_POST['total']); 
	   $sac         = implode(',',$_POST['sac']);
    }
	
	
	$itemNo			= mysqli_real_escape_string($con,rtrim($itemNo1,","));
	$itemName		= mysqli_real_escape_string($con,rtrim($itemName1,","));
	$price			= mysqli_real_escape_string($con,rtrim($price1,","));
	$quantity		= mysqli_real_escape_string($con,rtrim($quantity1,","));
	//$discount		= mysqli_real_escape_string($con,rtrim($discount1,","));
	$total			= mysqli_real_escape_string($con,rtrim($total1,","));
	$subTotal		= $_POST['subTotal'];
	$discount		= $_POST['discount'];
	$discountAmt	= $_POST['discountamt'];
	$amtafterdis	= $_POST['amtafterdis'];
	$tax			= $_POST['tax'];
	$taxAmount		= $_POST['taxAmount'];
	
	/////Swach Modified/////
	$swachCess		= $_POST['swachCess'];
	$swachCessAmt	= $_POST['CessAmt'];
	/////Swach Modified/////
	
	$surcharge		= $_POST['surcharge'];
	$surchargeAmt	= $_POST['surchargeamt'];
	$totalAfterTax	= $_POST['totalAftertax'];
	
	//Payable AMt\\\\
	$totalAfterRound= $_POST['totalAfterRound'];
	//$amountPaid		= $_POST['amountPaid'];
	//$amountDue		= $_POST['amountDue'];
	
	date_default_timezone_set('Asia/Kolkata');
	$current_date= date('Y-m-d H:i:s');
	
	$insertInvoiceQuery	= "INSERT INTO invoice_master(invoice_no,companyName,tinNo,buyerName,buyertxno,poNo,podate,paymentTerm,salesExe,moPay,supplier,invoiceDate,serviceNo,serviceType,price,quantity,total,subTotal,discount,discountamt,amtaftrdisc,tax,taxAmount,swachCess,swachCessAmt,surcharge,surchargeamt,totalAfterTax,amtPayable,hsn_no,no_working_days,pf_no,pan_no,esi_no,address,dateModified)VALUES('".$invNo."','".$companyName."','".$tinNo."','".$buyerName."','".$buyerTxno."','".$poNo."','".$poDate."','".$payTerm."','".$salesExe."','".$mop."','".$supplier."','".$invoiceDate."','".$itemNo."','".$itemName."','".$price."','".$quantity."','".$total."',".$subTotal.",'".$discount."','".$discountAmt."','".$amtafterdis."','".$tax."','".$taxAmount."','".$swachCess."','".$swachCessAmt."','".$surcharge."','".$surchargeAmt."','".$totalAfterTax."','".$totalAfterRound."','".$sac."','".$working_days."','".$pf_no."','".$pan_no."','".$pf_no."','".$address."','".$current_date."')";
	
	$exeQuery	=	mysqli_query($con,$insertInvoiceQuery)or die(mysqli_error($con));
	$invoice_id	= mysqli_insert_id($con);
	
	header("Location:print-invoice.php?inv_id=".$invoice_id."");
	
}
?>