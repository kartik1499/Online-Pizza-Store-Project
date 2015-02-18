<?php
	
require 'database.php';


if (isset($_GET['email']) && preg_match('/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/',
		$_GET['email'])) {
			$email = $_GET['email'];
		}
		if (isset($_GET['key']) && (strlen($_GET['key']) == 15))		
		{
			$key = $_GET['key'];
		}
		
		
		if (isset($email) && isset($key)) {
					
			// Update the database to set the "activation" field to Y
		
			$query_activate_account = "UPDATE user_master SET IS_ACTIVE='Y' WHERE(EMAIL_ID ='$email' AND ACTIVATION_KEY='$key') LIMIT 1";
			$result_activate_account = mysql_query($query_activate_account);
		
			// Print a customized message:
			if ($result_activate_account) //if update query was successfull
			{
				echo '<div>Your account is now active. You may now <a href="index.php">Log in</a></div>';
		
			} else {
				echo '<div>Oops !Your account could not be activated. Please recheck the link or contact the system administrator.</div>';
		
			}
					
		
		} else {
			echo '<div>Error Occured .</div>';
		}


?>