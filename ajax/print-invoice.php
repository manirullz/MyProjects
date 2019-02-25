<?php 
include_once('../config.php');
//extract($_POST);

$invoice_id	= mysqli_real_escape_string($con,$_POST['id']);
$status		= mysqli_real_escape_string($con,$_POST['status']);
$sql=mysqli_query($con,"UPDATE invoice_master SET invoice_status='".$status."' WHERE invoice_id=".$invoice_id."");
echo 1;
?>