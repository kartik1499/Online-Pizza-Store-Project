

<html>
<head>
<title>
HomePage
</title>



<link rel="stylesheet" href="/OnlinePizzaSystem/css/style.css" type="text/css" media="screen" />
  	<link rel="stylesheet" href="/OnlinePizzaSystem/css/slide.css" type="text/css" media="screen" />
	
    <!-- jQuery - the core -->
	<script src="/OnlinePizzaSystem/js/jquery-1.3.2.min.js" type="text/javascript"></script>
	<!-- Sliding effect -->
	<script src="/OnlinePizzaSystem/js/slide.js" type="text/javascript"></script>
	<script src="http://code.jquery.com/jquery-latest.min.js"></script>
<script type="text/javascript" src="/OnlinePizzaSystem/js/jssor.js"></script>
    <script type="text/javascript" src="/OnlinePizzaSystem/js/jssor.slider.js"></script>
	
</head>
<body>


<?php

session_start();
 if(!isset($_SESSION['username'])){
header("Location: index.php");
}

//file_get_contents('LoginSlider.php');

include 'LoginSlider.php';
?>
<div id="fade"></div>
        <div id="modal">
            <img id="loader" src="/OnlinePizzaSystem/images/loading.gif" />
        </div>
        
        <h2>UT DALLAS PIZZA STORE</h2>
<br />

        			<?php include 'menubar.html';?>
<br />


<div id="slider1_container" style="position: absolute; top: 230px; left:100px;  width: 1400px; height: 750px; overflow: hidden; ">

        

        <!-- Slides Container -->
        <div u="slides" style="cursor: move; position: absolute; left: 0px; top: 0px; width: 1400px; height: 750px; overflow: hidden;">
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
    
<!--     
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
			
			
 -->			

			
			
			</div>
			</div>

<!-- <a href="logout.php">Logout</a> -->
</body>
</html>

