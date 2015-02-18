<?php

require 'database.php';

session_start();
if(isset($_SESSION['username'])){
	

$Email = $_SESSION['username'];

$query = "SELECT * FROM USER_MASTER WHERE EMAIL_ID='".$Email."' LIMIT 1";
$result_data = mysql_query($query);

if(mysql_num_rows($result_data))
{
while($row = mysql_fetch_assoc($result_data)) {

	$_SESSION['FIRST_NAME'] = $row["FIRST_NAME"];
	$_SESSION['LAST_NAME'] = $row["LAST_NAME"];
	
	$_SESSION['CONTACT_NO'] = $row["CONTACT_NUMBER"];
	$_SESSION['ADD_LINE1'] = $row["ADDRESS_LINE1"];
	$_SESSION['ADD_LINE2'] = $row["ADDRESS_LINE2"];
	$_SESSION['ZIPCODE'] = $row["ZIP_CODE"];
	$_SESSION['CITY'] = $row["CITY"];
	$_SESSION['STATE'] = $row["STATE"];
	$_SESSION['COUNTRY'] = $row["COUNTRY"];
		
}
echo $_SESSION['FIRST_NAME'].':'.$_SESSION['LAST_NAME'].':'.$_SESSION['CONTACT_NO'].':'.$_SESSION['ADD_LINE1'].':'.$_SESSION['ADD_LINE2'].':'.$_SESSION['ZIPCODE'].':'.$_SESSION['CITY'].':'.$_SESSION['STATE'].':'.$_SESSION['COUNTRY'];
}
else {
	echo 'error';
}
}
else{
	header("Location: index.php");
}
?>