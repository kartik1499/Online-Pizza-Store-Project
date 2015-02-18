<?php

require 'database.php';


	// Initialize a session:
	session_start();
	$error = array();//this aaray will store all error messages

	if (empty($_POST['userName'])) {//if the email supplied is empty
		//$error[] = 'You forgot to enter&nbsp; your Email/Username ';
		$msg_error='1';
	} else {

		if (preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $_POST['userName'])) {
			$Email = $_POST['userName'];
		} else {
			//$error[] = 'Your EMail Address is invalid&nbsp; ';
			$msg_error=$msg_error.',2';
		}
	}

	
	if (empty($_POST['Password'])) {
		//$error[] = 'Please Enter Your Password ';
		$msg_error=$msg_error.',3';
	} else {
		$Password = $_POST['Password'];
	}

	if (empty($error))//if the array is empty , it means no error found
	{
		$query_check_credentials = "SELECT * FROM USER_MASTER WHERE EMAIL_ID='".mysql_real_escape_string($Email)."'";
		$result_check_credentials = mysql_query($query_check_credentials);
		if(!$result_check_credentials){//If the QUery Failed
			//echo 'Query Failed ';
			$msg_error=$msg_error.',4';
		}
		
		
		$database_password=null;
		$is_active='N';
		
		if (@mysql_num_rows($result_check_credentials) > 0) {
			// output data of each row
			while($row = mysql_fetch_assoc($result_check_credentials)) {				
				
				$database_password = $row["USER_PASSWORD"];
				$is_active = $row["IS_ACTIVE"];
				
			}
			
			
			if($is_active=='N')
				//$msg_error= "Your account is inactive. Kindly activate it by clicking on the link sent to your email";
				$msg_error=$msg_error.',5';
			else
			 {
			 	# --- DECRYPTION ---
			 	$key = pack('H*', "bcb04b7e103a0cd8b54763051cef08bc55abe029fdebae5e1d417e2ffb2a00a3");
			 	$iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC);
			 	$ciphertext_dec = base64_decode($database_password);
			 	
			 	# retrieves the IV, iv_size should be created using mcrypt_get_iv_size()
			 	$iv_dec = substr($ciphertext_dec, 0, $iv_size);
			 	
			 	# retrieves the cipher text (everything except the $iv_size in the front)
			 	$ciphertext_dec = substr($ciphertext_dec, $iv_size);
			 	
			 	# may remove 00h valued characters from end of plain text
			 	$plaintext_dec = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $key,
			 	$ciphertext_dec, MCRYPT_MODE_CBC, $iv_dec);			 				 	
			 	
			 	$a=trim(strval($plaintext_dec));
			 	$b=trim(strval($Password));
			 	
			 	$equal=strcmp($a, $b);
			 	
			 	
			 	 if($equal!=0)
			 	{
			 		//$msg_error= "You have entered a wrong password.";
			 		$msg_error=$msg_error.',6';
			 	}
			 	else
			 	{
			 		
			 		$query = "SELECT FIRST_NAME, LAST_NAME, EMAIL_ID FROM USER_MASTER WHERE EMAIL_ID='".mysql_real_escape_string($Email)."'";
			 		$result_data = mysql_query($query);
			 		
			 		//$_SESSION = mysql_fetch_array($result_data);
			 		
			 		while($row = mysql_fetch_assoc($result_data)) {
			 		
			 			$_SESSION['FIRST_NAME'] = $row["FIRST_NAME"];
			 			$_SESSION['LAST_NAME'] = $row["LAST_NAME"];
			 			$_SESSION['username'] = $Email;
			 			
			 		}			 					 		
			 		
			 		if(isset($_SESSION['cart']))
			 		{
			 			$msg_error=$msg_error.',8';
			 		}
			 		//Assign the result of this query to SESSION Global Variable
			 		
			 		//header("Location: home.php");
			 	} 
			 	
			}
		}
			
		else
		{
			//$msg_error= 'Either Your Account is inactive or Email address /Password is Incorrect';
			$msg_error=$msg_error.',7';
		}
			
			

		/* if (@mysql_num_rows($result_check_credentials) == 1)//if Query is successfull
		{ // A match was made.

			$_SESSION = mysqli_fetch_array($result_check_credentials, MYSQLI_ASSOC);

			//Assign the result of this query to SESSION Global Variable

			header("Location: page.php");

		} */
	}
	/*  else {
		echo '<div> <ol>';
		foreach ($error as $key => $values) {
			echo '&nbsp;&nbsp; &nbsp;<li>'.$values.'</li>';
		}
		echo '</ol></div>';
	} */
	if(isset($msg_error)){
		echo $msg_error;
	}
	

?>