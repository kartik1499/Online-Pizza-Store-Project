<?php 

$conn_error='Could not connect to database';
$mysql_host='localhost';
$mysql_user='kartik';
$mysql_password='password';
$mysql_db='utdpizzastore';

if(!(@mysql_connect($mysql_host,$mysql_user,$mysql_password) && @mysql_select_db($mysql_db)))
{
	die($conn_error);
	
}	

?>