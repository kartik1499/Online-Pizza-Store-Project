<!DOCTYPE html>

<html>
<head>
<title>
UTD Pizza Store
</title>

<!-- stylesheets -->
  	<link rel="stylesheet" href="/OnlinePizzaSystem/css/style.css" type="text/css" media="screen" />
  	<link rel="stylesheet" href="/OnlinePizzaSystem/css/slide.css" type="text/css" media="screen" />
	
    <!-- jQuery - the core -->
	<script src="/OnlinePizzaSystem/js/jquery-1.3.2.min.js" type="text/javascript"></script>
	<script src="/OnlinePizzaSystem/js/jquery-latest.min.js"></script>
	<!-- Sliding effect -->
	<script src="/OnlinePizzaSystem/js/slide.js" type="text/javascript"></script>
	
	
	<script type="text/javascript" src="/OnlinePizzaSystem/js/jssor.js"></script>
    <script type="text/javascript" src="/OnlinePizzaSystem/js/jssor.slider.js"></script>

	<!-- <script src="http://code.jquery.com/jquery-latest.min.js"></script> -->
	
	
	
	
	
<!-- <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/redmond/jquery-ui.css" rel="stylesheet" type="text/css"/>
  
  <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script> -->
	
	
</head>


<body>


<?php 

require 'database.php';


session_start();

if(isset($_SESSION['username'])){
	header("Location: home.php");
}
$_SESSION['secure']=rand(10000, 99999);

//echo $_SESSION['secure'];
?>


<div id="fade"></div>
        <div id="modal">
            <img id="loader" src="/OnlinePizzaSystem/images/loading.gif" />
        </div>

	<!-- Login -->
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
					<a href="signup.php" class="overlayLink" id="link1" data-action="registration-form.html">Register</a>
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
					First Name:
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
					<input type="password" name="password" id="password" class="signupfrm" placeholder="Enter password"  required="required" />
				</label>
				</div>
				
				<div id="pwd_strength_wrap">
                <div id="passwordDescription">Password not entered</div>
                <div id="passwordStrength" class="strength0"></div>
                <div id="pswd_info">
                        <strong>Strong Password Tips:</strong>
                        <ul>
                                <li class="invalid" id="length">At least 6 characters</li>
                                
                                <li class="invalid" id="capital">At least one lowercase &amp; one uppercase letter</li>
                                
                        </ul>
                </div><!-- END pswd_info -->
        		</div><!-- END pwd_strength_wrap -->
				
				 
				<div class="Cell" id="ver">
				<label for="verpassword">
					Re-Enter Password:
					<input type="password" name="verpassword" id="verpassword" class="signupfrm" placeholder="Verify your password"  required="required" />
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














<h2>UT DALLAS PIZZA STORE</h2>
<br />

<?php include 'menubar.html';?>
<br />


<div id="slider1_container" style="position: absolute; top: 230px; left:100px;  width: 1400px; height: 750px; overflow: hidden; ">

        

        <!-- Slides Container -->
        <div u="slides" style="cursor: move; position: absolute; left: 0px;top: 0px; width: 1400px; height: 750px; overflow: hidden;">
            <div>
                <img u="image" src="../images/pizza_1.jpg" />
            </div>
            <div>
                <img u="image" src="../images/pizza_2.jpg" />
            </div>
            <div>
                <img u="image" src="../images/wings.jpg" />
            </div>
           
        </div>

        <!-- Bullet Navigator Skin Begin -->
        
        <!-- bullet navigator container -->
        <div u="navigator" class="jssorb05" style="position: absolute; bottom: 16px; right: 6px;">
            <!-- bullet navigator item prototype -->
            <div u="prototype" style="POSITION: absolute; WIDTH: 16px; HEIGHT: 16px;"></div>
        </div>
        <!-- Arrow Left -->
        <span u="arrowleft" class="jssora12l" style="width: 30px; height: 46px; top: 350px; left: 0px;">
        </span>
        <!-- Arrow Right -->
        <span u="arrowright" class="jssora12r" style="width: 30px; height: 46px; top: 350px; right: 0px">
        </span>
        
    </div>


<br />
<div class="visitor">

<h3>
You are visitor number : <?php 
include 'count.php';
hit_count();
?>
</h3>
</div>



</div><!-- / content -->		
</div>
	<!-- / container -->
	

<script type="text/javascript">
var captcha = <?php echo $_SESSION['secure'];?>

</script>
		
</body>
</html>