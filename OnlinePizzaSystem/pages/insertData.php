

<?php 

			require 'database.php';
			//echo "yes";
			DEFINE('WEBSITE_URL', 'http://localhost/OnlinePizzaSystem/pages');
			
			if(isset($_POST['fname'])
				&& isset($_POST['lname'])
				&& isset($_POST['email'])
				&& isset($_POST['contactNo'])	
				&& isset($_POST['password'])
				&& isset($_POST['verpassword'])
				&& isset($_POST['addline1'])
				&& isset($_POST['zipcode'])
				&& isset($_POST['city'])
				&& isset($_POST['state'])
				&& isset($_POST['country']))
			{			
				
				$fname=$_POST['fname'];
				$lname=$_POST['lname'];
				$email=$_POST['email'];
				$contactNo=$_POST['contactNo'];
				$password=$_POST['password'];
				$verpassword=$_POST['verpassword'];
				$addline1=$_POST['addline1'];
				$addline2=$_POST['addline2'];
				$zipcode=$_POST['zipcode'];
				$city=$_POST['city'];
				$state=$_POST['state'];
				$country=$_POST['country'];
				
				if(empty($fname)||empty($lname)||empty($email)||empty($contactNo)||empty($password)||empty($verpassword)||empty($addline1)||empty($zipcode)||empty($city)
						||empty($state)||empty($country))
				{
					echo "Please fill all mandatory fields.";
				}
				else 
				{
					if($password!=$verpassword)
					{
						echo "Entered Passswords do not match";
					}
					else 
					{
						//echo "An email with activation link has been sent to ".$email." . Kindly activate your account by clicking on that link in the email";
						
						if (!(preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/",$email))) {
									//regular expression for email validation
									
									echo  'Your EMail Address is invalid  ';
									
								} 
								
						else {
							try{																			
						
						# --- ENCRYPTION ---
						
						# the key should be random binary, use scrypt, bcrypt or PBKDF2 to
						# convert a string into a key
						# key is specified using hexadecimal
						$key = pack('H*', "bcb04b7e103a0cd8b54763051cef08bc55abe029fdebae5e1d417e2ffb2a00a3");
						
						# show key size use either 16, 24 or 32 byte keys for AES-128, 192
						# and 256 respectively
						$key_size =  strlen($key);
						
						//$plaintext = "This string was AES-256 / CBC / ZeroBytePadding encrypted.";
						
    					# create a random IV to use with CBC encoding
						$iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC);
						$iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
						
						# creates a cipher text compatible with AES (Rijndael block size = 128)
						# to keep the text confidential
						# only suitable for encoded input that never ends with value 00h
						# (because of default zero padding)
						$ciphertext = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $key,
						$password, MCRYPT_MODE_CBC, $iv);
						
						# prepend the IV for it to be available for decryption
						$ciphertext = $iv . $ciphertext;
						
						# encode the resulting cipher text so it can be represented by a string
						$ciphertext_base64 = base64_encode($ciphertext);
						
						$hash_password=$ciphertext_base64;
						//echo $hash_password." : ";
						//echo "\n";
						$characters = 'abcdefghijklmnopqrstuvwxyz0123456789';
						
						$string = '';
						$random_string_length=15;
						for ($i = 0; $i < $random_string_length; $i++) {
							$string .= $characters[rand(0, strlen($characters) - 1)];
						}
						
						
						$activation_key=$string;
						//echo $activation_key;
						 $query = "INSERT INTO user_master VALUES (NULL,'".mysql_real_escape_string($fname)."','".mysql_real_escape_string($lname)."','".mysql_real_escape_string($email)."','".mysql_real_escape_string($hash_password)."','".mysql_real_escape_string($activation_key)."','N','CUSTOMER',NULL,'".mysql_real_escape_string($addline1)."','".mysql_real_escape_string($addline2)."','".mysql_real_escape_string($zipcode)."','".mysql_real_escape_string($city)."','".mysql_real_escape_string($state)."','".mysql_real_escape_string($country)."','".mysql_real_escape_string($contactNo)."')";
						
						// echo "\n : query: ";
						//echo $query;
						
						if($result=mysql_query($query))						
						{
							//echo "5";
							$subject="Registration confirmation for UTD Pizza Store";
							//$activation_link=WEBSITE_URL . '/activate.php?email=' . urlencode($email) . "&key=$activation_key";
							$activation_link=WEBSITE_URL . '/activate.php?email=' .$email . "&key=$activation_key";
							$message_body="Kindly click on this link: ".$activation_link." to activate your UTD Pizza Store account. \n This is a system generated email. Please do not reply to it.";
							
							if(mail($email,	$subject,$message_body))
							{
								echo "Thank you for registering. A confirmation email with activation link has been sent to ".$email." . Kindly activate your account by clicking on that link in the email";
							}
							else {
								echo "There was an error sending activation mail to your email Id. Please signup with a valid eMail Address";
								//delete the registered user.
							}
						} 

						}
						catch(Exception $e)
						    {
						    echo $sql . "<br>" . $e->getMessage();
						    }
						
						
						}	
					}
				}
				
			}
			
			?>