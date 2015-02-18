<?php

require 'database.php';



if (preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/", $_GET['userName']))  {
			$userName = $_GET['userName'];
			
			$query = "SELECT USER_PASSWORD FROM USER_MASTER WHERE EMAIL_ID='".$userName."' LIMIT 1";
			$result_data = mysql_query($query);
			
			if (@mysql_num_rows($result_data) > 0) {
			$database_password=null;
			
			while($row = mysql_fetch_assoc($result_data)) {
			
				$database_password = $row["USER_PASSWORD"];
				 
			}
			
			
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
				
			$userPassword=trim(strval($plaintext_dec));
			
			
			$subject="Password Recovery for UTD Pizza Store Account";
			$message_body="Your password for username/Email: ".$userName." is : ".$userPassword.". Please use this password to login to your account. \n This is a system generated email. Please do not reply to it.";
			
			if(mail($userName,	$subject,$message_body))
			{
				echo "Your password has been sent to ".$userName." . Kindly use that password to login to your account";
			}
			else {
				echo "There was an error sending email to your email Id. Please try again later";
				
			}
			
			}
			else {
				echo "Sorry! This emailId/Username does not exist";
			}
			
			
		}
		else
		{
			echo "Please enter a valid EmailId / Username";
		}
?>