<?php
include_once('config.php');
if(isset($_POST['addproduct']))
{
	$product_code		= $_POST['prod_code'];
	$product_name		= $_POST['prod_name'];
	//$product_quantity	= $_POST['prod_quantity'];
	//$product_unittype	= $_POST['unit_type'];
	$product_price_monthly	= $_POST['price'];
	
	$product_price_perday  = ($_POST['price']/31);
	
	$add_product	= "INSERT INTO products(productCode,productName,buyPrice,MSRP)VALUES('".$product_code."','".$product_name."','".$product_price_perday."','".$product_price_monthly."')";
	mysqli_query($con,$add_product)or die(mysqli_error($con));
	header('Location:view-products.php');
}

//forgot pasword
if(isset($_POST['forgot-password']))
{
		 $email= $_POST['useremail'];
		
		$query = "SELECT login_id FROM login_master where email='".$email."'";
        $result = mysqli_query($con,$query);
        $Results = mysqli_fetch_array($result);
 		//echo count($Results);
        if(count($Results)>=1)
        {
            $encrypt = md5(1290*3+$Results['login_id']);
            $message = "Your password reset link send to your e-mail address.";
            $to=$email;
            $subject="Forget Password";
            $from = 'info@invadertech.com';
            $body='Hi, <br/> <br/>Your User ID is '.$Results['login_id'].' <br><br><a>Click here to reset your password http://annex.invadertech.com/reset.php?encrypt='.$encrypt.'&action=reset</a>   <br/> <br/>--<br>.';
            $headers = "From: " . strip_tags($from) . "\r\n";
            $headers .= "Reply-To: ". strip_tags($from) . "\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
 
            mail($to,$subject,$body,$headers);
			
			header('Location:index.html?msg=An email has been sent to your email');
        }
        else
        {
          $message = "Account not found please signup now!!";
        }
}

if(isset($_POST['genrate_reciept']))
{	
	$inv_id		= $_POST['inv_id'];
	$pay_date	= date('Y-m-d',strtotime($_POST['pay_date']));	
	$pay_mode	= $_POST['pay_mode'];
	$payType_no	= $_POST['cheque_no'];	
	$inv_amt	= $_POST['billed_amt'];
	$paid_amt	= $_POST['paid_amt'];
	$balance	= $_POST['bal_amt'];
	$created_by	= @$_SESSION['userId'];
	$created_on	= date('Y-m-d H:i:s');
	if($pay_mode!='CASH')
	{
		$bank_charge	= $_POST['bank_charge'];
	}
	else
	{
		$bank_charge	= 0;
	}
		
	$getPayment			= "SELECT * FROM payment_detail WHERE invoice_id=".$inv_id." ORDER BY pay_id DESC LIMIT 1";
	$exePayment			= mysqli_query($con,$getPayment)or die(mysqli_error($con));
	$count				= mysqli_num_rows($exePayment);
	while($resultPay			= mysqli_fetch_array($exePayment))
	{
		$balanceAmt			= intval($resultPay['balance_amt']); 
	}
		
	 if($balanceAmt >0 && $count==1)
		 {	
			$payQuery	= "INSERT INTO payment_detail(invoice_id,pay_date,pay_mode,payType_no,invoice_amt,paid_amt,bank_charge,balance_amt,created_by,created_on,status) VALUES(".$inv_id.",'".$pay_date."','".$pay_mode."','".$payType_no."','".$inv_amt."','".$paid_amt."','".$bank_charge."','".$balance."','".$created_by."','".$created_on."','1')";
			mysqli_query($con,$payQuery)or die(mysqli_error($con));
	
			$pay_id	= mysqli_insert_id($con);
			header("Location:pay-reciept.php?pay_id=".$pay_id."");	
		 }
	if($count==0)
	{
		$payQuery	= "INSERT INTO payment_detail(invoice_id,pay_date,pay_mode,payType_no,invoice_amt,paid_amt,bank_charge,balance_amt,created_by,created_on,status) VALUES(".$inv_id.",'".$pay_date."','".$pay_mode."','".$payType_no."','".$inv_amt."','".$paid_amt."','".$bank_charge."','".$balance."','".$created_by."','".$created_on."','1')";
			mysqli_query($con,$payQuery)or die(mysqli_error($con));
				
			$pay_id	= mysqli_insert_id($con);
			header("Location:pay-reciept.php?pay_id=".$pay_id."");	
	}
	else
	{
		echo "Reciept Already Genrated";
	}
}
?>