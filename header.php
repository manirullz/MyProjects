<?php
session_start();
if($_SESSION['admin_username']=="")
{
	header('Location:index.html');
}
 ?>
<!DOCTYPE HTML>
<html>
<head>
<title> New Alert Security & Intelligence Services </title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
 <!-- Bootstrap Core CSS -->
<link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' />
<!-- Custom CSS -->
<link href="css/style.css" rel='stylesheet' type='text/css' />
<link href="css/font-awesome.css" rel="stylesheet"> 
<!-- jQuery -->
<script src="js/jquery.min.js"></script>
<!----webfonts--->
<link href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900' rel='stylesheet' type='text/css'>
<!---//webfonts--->  
<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

<link type="text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=Droid+Sans:400,700|Noto+Serif:400,700"> 
    <!-- Bootstrap core CSS -->
    <link href="invoice/css/jquery-ui.min.css" rel="stylesheet">
    <!--<link href="invoice/css/bootstrap.min.css" rel="stylesheet">-->
    <link href="invoice/css/datepicker.css" rel="stylesheet">
    <link href="invoice/css/font-awesome.min.css" rel="stylesheet">
    <!--<link href="invoice/css/style.css" rel="stylesheet">-->

    <!-- Custom styles for this template -->
    <link href="invoice/css/sticky-footer-navbar.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="invoice/js/ie.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div id="wrapper">
     <!-- Navigation -->
        <nav class="top1 navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">Billing Master</a>
            </div>
           
			<div class="navbar-right" style="margin-top: 15px;">
            <a href="logout.php">Logout</a>
              </div>
            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="create-invoice.php"><i class="fa fa-dashboard fa-fw nav_icon"></i>Create Invoice</a>
                        </li>
                         <li>
                            <a href="invoice_list.php"><i class="fa fa-dashboard fa-fw nav_icon"></i>Invoice List</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-envelope nav_icon"></i>Product Master<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="view-products.php">View Products</a>
                                </li>
                                <li>
                                    <a href="add-product.php">Add Products</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="tax-manager.php"><i class="fa fa-flask nav_icon"></i>Tax Manager</a>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>