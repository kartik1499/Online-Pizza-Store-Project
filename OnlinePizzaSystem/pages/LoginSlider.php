<?php 

require 'database.php';
?>

<!DOCTYPE html>
<html>
<head>

	
	
	
</head>

<body>




<div id="toppanel">
	<div id="panel">
		<div class="content clearfix">
			<div class="left">
				<h1>Welcome to UT Dallas Pizza Store</h1>
				<h2>Serving the Best Quality Pizzas to the students</h2>		
				<p class="grey">Open Monday to Sunday (9 AM to 11:30 PM)</p>
				<!-- <h2>Download</h2> -->
				<!-- <p class="grey">To download this script go back to <a href="http://web-kreation.com/index.php/tutorials/nice-clean-sliding-login-panel-built-with-jquery" title="Download">article &raquo;</a></p> -->
			</div>
			
			<?php 			
			if(isset($_SESSION['username'])){?>
			<div class="left">
				<form action="#" method="post" id="chgfrm">
					<h2>Member Priveleges</h2>				
					<br />
					<a href="" class="overlayLinkprof" id="updatelink" data-action="updateprof-form.html">Update Profile</a>
					<br />
					<br />
					<a href="#" id="changepasslink" >Change Password</a>
					<br />
					<div style="display: none" id="changePassDiv">
					<label for="currPass" style="color:#ffffff">Current Password:</label>
					<br />
					<input type="password" autofocus="autofocus" name="currPass" id="currPass" required="required" pattern="^[a-zA-Z][a-zA-Z0-9-_\.\s]{6,20}$" />					
					<br />
					<label for="newPass" style="color:#ffffff">New Password: (Minimum 6 characters)</label>
					<br />
					<input type="password" id="newPass" name="newPass" required="required" pattern="^[a-zA-Z][a-zA-Z0-9-_\.\s]{6,20}$"/>
					
					<br />
					<input type="submit" id="change" name="submit"  value="Change" class="bt_login" />
					</div>
					
					<br />
					<a href="#" class="overlayLinkorder" id="updatelink" data-action="updateprof-form.html">View Order History</a>
				</form>
			</div> 
			
			
			<div class="left right" id="box">
				<form class="clearfix"  method="post" action="logout.php">
					<h1 class="padlock">Welcome, <?php echo $_SESSION['FIRST_NAME']." ".$_SESSION['LAST_NAME'];?></h1>
					<input type="submit" name="submit" value="Logout" class="bt_login"/>  
					
					<!-- <a href="logout.php">Logout</a> -->
										
					
				</form>
			</div>
		</div>
	</div> <!-- /login -->	

    <!-- The tab on top -->	
	<div class="tab">
		<ul class="login">
	    	<li class="left">&nbsp;</li>
	        <li>Hello, <?php echo $_SESSION['FIRST_NAME'];?>!</li>
			<li class="sep">|</li>
			<li id="toggle">
				<a id="open" class="open" href="#">My Account | Logout</a>
				<a id="close" style="display: none;" class="close" href="#">Close Panel</a>			
			</li>
	    	<li class="right">&nbsp;</li>
		</ul> 
	</div> <!-- / top -->
	
</div> <!--panel -->




<div id="container">
		<div id="content" style="padding-top:100px;">		
		
		
		
		<div class="overlayprof" style="display: none;">						
	<div class="login-wrapper">
		<div class="login-content">
			<a id="closepopupprof" class="closeprof">x</a>
			
			<h3>Update Profile</h3>
			
			
			<form method="POST" action=""  id="updatefrm" name="updatefrm">
				<div class="Row">
				<div class="Cell">
				<label for="fname">
					First Name:
					<input  type="text" name="fname" id="fnameu"  class="signupfrm" placeholder="Enter first name" pattern="^[a-zA-Z][a-zA-Z0-9-_\.\s]{2,20}$" required="required" />
						
				</label>				
				</div>
				<div class="Cell">
				<label for="lname">
					Last Name:
					<input type="text" name="lname"  id="lnameu" class="signupfrm" placeholder="Enter last name" pattern="^[a-zA-Z][a-zA-Z0-9-_\.\s]{2,20}$" required="required" />
				</label> 
				</div>
				</div>
				
				
				<div class="Row">								
				<div class="Cell">
				<label for="addline1">
					Contact Number:
					<input type="text" name="contactNo" id="contactNou" class="signupfrm" placeholder="Enter 10 digit number" pattern="^[0-9]{10}$" required="required" />
				</label>
				</div>
														
				</div>				
				
				
				
				<div class="Row">
				<div class="Cell">
				<label for="addline1">
					Address Line 1:
					<input type="text" name="addline1" id="addline1u" class="signupfrm" placeholder="Enter address line1" pattern="^[a-zA-Z0-9-_#,\.\s]{4,20}$" required="required" />
				</label>
				</div>
				<div class="Cell">
				<label for="addline2">
					Address Line 2:
					<input type="text" name="addline2" id="addline2u" class="signupfrm"  placeholder="Enter address line2" pattern="^[a-zA-Z0-9-_#,\.\s]{4,20}$"/>
				</label>
				</div>
				</div>
				
				
				<div class="Row">
				<div class="Cell">
				<label for="zipcode">
					Zipcode:
					<input type="text" name="zipcode" id="zipcodeu" class="signupfrm" placeholder="Enter numeric digits in zipcode" pattern="^[0-9]{5}$" required="required" />
				</label>
				</div>
				<div class="Cell">
				<label for="city">
					City:
					<input type="text" name="city" id="cityu"  class="signupfrm" placeholder="Enter City" pattern="^[a-zA-Z][a-zA-Z0-9-_\.\s]{1,20}$" required="required" />
				</label>
				</div>
				</div>
				
				
				
				<div class="Row">
				<div class="Cell">
				<label for="state">
					State:
					<input type="text" name="state" id="stateu" class="signupfrm" placeholder="Enter State" pattern="^[a-zA-Z][a-zA-Z0-9-_\.]{1,20}$" required="required" />
				</label>
				</div>
				<div class="Cell">
				<label for="country">
					Country:
					<input type="text" name="country" id="countryu" class="signupfrm"  placeholder="Enter Country" pattern="^[a-zA-Z][a-zA-Z0-9-_\.\s]{1,20}$" required="required" />
				</label>
				</div>
				</div>				
				<br />
				
				<button type="submit" id="update">Update</button>
				</form>
			</div>
			</div>
			</div>




			
			
			
			
			<div class="overlayorder" style="display: none;">						
	<div class="login-wrapper">
		<div class="login-content">
			<a id="closepopuporder" class="closeorder">x</a>
			
			<h2>Order History</h2>
			
			
			<form method="POST" id="orderfrm" name="orderfrm">			
				
				<?php 
				
				$Email=$_SESSION['username'];
				$orderid="";			
				$query_check_credentials = "SELECT * FROM USER_MASTER WHERE EMAIL_ID='".$Email."'";
				$result_check_credentials = mysql_query($query_check_credentials);
				$userid="";
				
				if (@mysql_num_rows($result_check_credentials) > 0) {
					// output data of each row
					while($row = mysql_fetch_assoc($result_check_credentials)) {
				
						$userid = $row["USER_ID"];
				
					}
				}
				
				$result=mysql_query("SELECT * FROM ORDERS_MASTER M WHERE M.USER_ID='".$userid."'");	
				?>
				<table  cellspacing="20" cellpadding="20">
				<tr>
				
				<th align="center">
				Order Id
				</th>
				
				<th align="center">
				Order Date
				</th>
				
				<th align="center">
				Order Price
				</th>
				
				<th align="center">
				Details
				</th>
				</tr>
				<?php 
				while($row = mysql_fetch_assoc($result)) {
									
					$orderid = $row['ORDER_ID'];
					$orderdate = $row['ORDER_DATE'];
					$order_price ='$ '.$row['TOTAL_ORDER_PRICE'];
					?>
					<tr>
					<td align="center"><?php echo $orderid;?>
					</td>
					<td align="center">
					<?php echo $orderdate;?>
					</td>
					<td align="center">
					<?php echo  $order_price?>
					</td>
					<td align="center">
					<a style="text-decoration: underline;" href="orderDetails.php?orderid=<?php echo $orderid;?>">View Order Details</a>
					</td>
					</tr>
				<?php 
				}
				?>
				
				</table>
				</form>
			</div>
			</div>
			</div>
			
			







			<?php }else{?>
			
			<div class="left">
				<form action="#" method="post">
					<h1>Not a member yet? Sign Up!</h1>				
					<h4>
					Click on Register link below to Sign Up
					</h4>
					<!-- <label class="grey" for="signup">Username:</label>
					<input class="field" type="text" name="signup" id="signup" value="" size="23" />
					<label class="grey" for="email">Email:</label>
					<input class="field" type="text" name="email" id="email" size="23" />
					<label>A password will be e-mailed to you.</label> -->
					<!-- <input type="submit" name="submit" value="Register" data-action="registration-form.html" class="bt_register" /> -->
					<a href="#" class="overlayLink" id="link1" data-action="registration-form.html">Register</a>
				</form>
			</div> 
			
			<div class="left right" id="box">
				<form class="clearfix"  method="post" action="" id="loginForm">
					<h1 class="padlock">Member Login</h1>
					<label class="grey" for="log">Email/Username:</label>
					<input  type="text" class="loginfrm" name="userName" id="userName" value="" size="23" required="required" />
					<label class="grey" for="pwd">Password:</label>
					<input  type="password" name="Password" class="loginfrm" id="Password" size="23" required="required"/>
	            	<!-- <label><input name="rememberme" id="rememberme" type="checkbox" checked="checked" value="forever" /> &nbsp;Remember me</label> -->
        			<input type="hidden" name="formsubmitted" value="TRUE" />
					<input type="submit" name="submit" id="login" value="Login" class="bt_login" />
					<!-- <a class="lost-pwd" href="#" id="lostpass">Lost your password?</a> -->
					<a href="signup.php" class="lost-pwd" id="link2" data-action="lost-pass.html">Lost your password?</a>
					
				</form>
			</div>
		</div>
	</div> <!-- /login -->	

    <!-- The tab on top -->	
	<div class="tab">
		<ul class="login">
	    	<li class="left">&nbsp;</li>
	        <li>Hello Guest!</li>
			<li class="sep">|</li>
			<li id="toggle">
				<a id="open" class="open" href="#">Log In | Register</a>
				<a id="close" style="display: none;" class="close" href="#">Close Panel</a>			
			</li>
	    	<li class="right">&nbsp;</li>
		</ul> 
	</div> <!-- / top -->
	
</div> <!--panel -->
	
	
	
	
	
	
	
	
	
	
	
	<div id="container">
		<div id="content" style="padding-top:100px;">
	
			
		<div class="overlayLost" style="display: none;">						
	<div class="login-wrapper">
		<div class="login-content">
			<a id="closepopupLost" class="closeLost">x</a>
			
			<h3>Recover your password</h3>
			
			
			<form method="get" action=""  id="lostfrm" name="lostfrm">
				<label for="username">
					Email/Username:
					<input  type="text" name="username" id="username" class="signupfrm" placeholder="Enter your email/Username"  required="required" />
						
				</label>				
				<br />
				<br />
				<br />
				<button type="submit" id="recover">Recover Password</button>
				</form>
			</div>
			</div>
			</div>	
			
			
			
			
			
			
			
			<div class="overlay" style="display: none;">						
	<div class="login-wrapper">
		<div class="login-content">
			<a id="closepopup" class="close">x</a>
			
	
			<h3>New User Sign Up</h3>
			
			
			
			<form method="post" action=""  id="frm" name="frm">								
				
				<div class="Row">
				<div class="Cell">
				<label for="fname">
					Name:
					<input  type="text" name="fname" id="fname" class="signupfrm" placeholder="Enter first name" pattern="^[a-zA-Z][a-zA-Z0-9-_\.\s]{2,20}$" required="required" />
						
				</label>				
				</div>
				<div class="Cell">
				<label for="lname">
					Last Name:
					<input type="text" name="lname"   id="lname" class="signupfrm" placeholder="Enter last name" pattern="^[a-zA-Z][a-zA-Z0-9-_\.\s]{2,20}$" required="required" />
				</label> 
				</div>
				</div>
				
				
				<div class="Row">
				
				
				<div class="Cell">
				<label for="addline1">
					Contact Number:
					<input type="text" name="contactNo" id="contactNo" class="signupfrm" placeholder="Enter 10 digit number" pattern="^[0-9]{10}$" required="required" />
				</label>
				</div>
				
				
				<div class="Cell">
				<label for="email">
					Email/Username:
					<input type="text" name="email" id="email" class="signupfrm" placeholder="Enter your email"  required="required" />
				</label>
				</div>				
				</div>				
				
				
				<div class="Row">
				<div class="Cell">
				<label for="password">
					Password:
					<input type="password" name="password" id="password" class="signupfrm" placeholder="Atleast 1 uppercase,lowercase & number" pattern="^[a-zA-Z][a-zA-Z0-9-_\.\s]{6,20}$" required="required" />
				</label>
				</div>
				
				<div class="Cell">
				<label for="verpassword">
					Re-Enter Password:
					<input type="password" name="verpassword" id="verpassword" class="signupfrm" placeholder="Verify your password" pattern="^[a-zA-Z][a-zA-Z0-9-_\.\s]{6,20}$" required="required" />
				</label>
				</div>
				
				
				</div>
				
				<div class="Row">
				<div class="Cell">
				<label for="addline1">
					Address Line 1:
					<input type="text" name="addline1" id="addline1" class="signupfrm" placeholder="Enter address line1" pattern="^[a-zA-Z0-9-_\.\s]{4,20}$" required="required" />
				</label>
				</div>
				<div class="Cell">
				<label for="addline2">
					Address Line 2:
					<input type="text" name="addline2" id="addline2" class="signupfrm" placeholder="Enter address line2" pattern="^[a-zA-Z0-9-_\.\s]{4,20}$"/>
				</label>
				</div>
				</div>
				
				
				<div class="Row">
				<div class="Cell">
				<label for="zipcode">
					Zipcode:
					<input type="text" name="zipcode" id="zipcode" class="signupfrm" placeholder="Enter numeric digits in zipcode" pattern="^[0-9]{5}$" required="required" />
				</label>
				</div>
				<div class="Cell">
				<label for="city">
					City:
					<input type="text" name="city" id="city" class="signupfrm" placeholder="Enter City" pattern="^[a-zA-Z][a-zA-Z0-9-_\.\s]{1,20}$" required="required" />
				</label>
				</div>
				</div>
				
				
				
				<div class="Row">
				<div class="Cell">
				<label for="state">
					State:
					<input type="text" name="state" id="state" class="signupfrm" placeholder="Enter State" pattern="^[a-zA-Z][a-zA-Z0-9-_\.]{1,20}$" required="required" />
				</label>
				</div>
				<div class="Cell">
				<label for="country">
					Country:
					<input type="text" name="country" id="country" class="signupfrm" placeholder="Enter Country" pattern="^[a-zA-Z][a-zA-Z0-9-_\.\s]{1,20}$" required="required" />
				</label>
				</div>
				</div>
				
				
				
				<div class="Row">
				<div class="Cell">
				
				Captcha  :
				<img src="generateCaptcha.php" class="signupfrm"/>
				
				</div>
				<div class="Cell">
				<label for="captchaVal">
					Enter Captcha:
					<input type="text" name="captchaVal" id="captchaVal" class="signupfrm" placeholder="Enter numbers shown in image" pattern="^[0-9]{5}$"  required="required" />
				</label>
				</div>
				</div>
				<br />
							
			<!--  <input type="submit" value="Sign Up" id="signup"> -->
			<button type="submit" id="signup">Sign Up</button>
			<!-- <button id="reset">Reset</button> -->
			&nbsp;
			<input type="button" id="reset" value="Reset" class="reset"/>
			</form>
		</div>
	</div>
</div>
	
	
	
	
	
	
	
			<?php }?>
			
	
	
	
			

						
			
			





</body>
</html>