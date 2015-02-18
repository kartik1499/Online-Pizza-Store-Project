<?php

require 'database.php';

session_start();
if(isset($_SESSION['username'])){
	
	
	
	
	
	
	
	
	
	
	
	if(isset($_POST['fname'])
			&& isset($_POST['lname'])			
			&& isset($_POST['contactNo'])
			&& isset($_POST['addline1'])
			&& isset($_POST['zipcode'])
			&& isset($_POST['city'])
			&& isset($_POST['state'])
			&& isset($_POST['country']))
	{
	$fname=$_POST['fname'];
	$lname=$_POST['lname'];
	$email=$_SESSION['username'];
	$contactNo=$_POST['contactNo'];
	$addline1=$_POST['addline1'];
	$addline2=$_POST['addline2'];
	$zipcode=$_POST['zipcode'];
	$city=$_POST['city'];
	$state=$_POST['state'];
	$country=$_POST['country'];
	
	if(empty($fname)||empty($lname)||empty($contactNo)||empty($addline1)||empty($zipcode)||empty($city)
			||empty($state)||empty($country))
	{
		echo "Please fill all mandatory fields.";
	}
	else
	{
	
				try{		
						
					$query = "UPDATE USER_MASTER SET FIRST_NAME='".mysql_real_escape_string($fname)."', 
								LAST_NAME='".mysql_real_escape_string($lname)."',
								CONTACT_NUMBER='".mysql_real_escape_string($contactNo)."',
								ADDRESS_LINE1='".mysql_real_escape_string($addline1)."',
								ADDRESS_LINE2='".mysql_real_escape_string($addline2)."',
								ZIP_CODE='".mysql_real_escape_string($zipcode)."',
								CITY='".mysql_real_escape_string($city)."',
								STATE='".mysql_real_escape_string($state)."',
								COUNTRY='".mysql_real_escape_string($country)."' WHERE EMAIL_ID='".$email."' LIMIT 1";
					
					if($result=mysql_query($query))
						{	
							echo 'pass';
						}						
	
					}
					catch(Exception $e)
					{
						    echo $sql . "<br>" . $e->getMessage();
				 	}						
					
				}
	
}
	
	
	
	
	
	
}
else
{
	header("Location: index.php");
}
?>