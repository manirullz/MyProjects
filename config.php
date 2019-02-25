<?php
/*
Site : www.iashumani.com
Author :ashu
*/
define('DB_HOST', 'localhost');
define('DB_NAME', 'websbaba_billing');
define('DB_USERNAME','websbaba_ebill');
define('DB_PASSWORD','admin@123');

//define('DB_HOST', 'localhost');
//define('DB_NAME', 'invader_invoice');
//define('DB_USERNAME','root');
//define('DB_PASSWORD','');


$con = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME)or die('Could not connect:'.mysql_error());
