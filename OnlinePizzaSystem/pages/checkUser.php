<?php

require 'database.php';

$email = $_GET['email'];

$query = "SELECT * FROM USER_MASTER WHERE UPPER(EMAIL_ID)=UPPER('".mysql_real_escape_string($email)."')";

$result = mysql_query($query);

if(mysql_num_rows($result)>0){
echo "This Email/Username already exists. Please choose a different Email/Username";	
}

?>