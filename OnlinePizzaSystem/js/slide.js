
var score=0;

$(document).ready(function() {
	
	$("#password").on("focus keyup", function () {        
		
		score = 0;
        var a = $(this).val();
        var desc = new Array();
        $("#ver").hide();
        // strength desc
      /*  desc[0] = "Too short";
        desc[1] = "Weak";
        desc[2] = "Good";
        desc[3] = "Strong";
        desc[4] = "Best";*/
         
        desc[0] = "Too short";
        desc[1] = "Good";
        desc[2] = "Strong";
        
        
        $("#pwd_strength_wrap").fadeIn(400);
        
        // password length
        if (a.length >= 6) {
            $("#length").removeClass("invalid").addClass("valid");
            score++;
        } else {
            $("#length").removeClass("valid").addClass("invalid");
        }
 
        // at least 1 digit in password
        /*if (a.match(/\d/)) {
            $("#pnum").removeClass("invalid").addClass("valid");
            score++;
        } else {
            $("#pnum").removeClass("valid").addClass("invalid");
        }*/
 
        // at least 1 capital & lower letter in password
        if (a.match(/[A-Z]/) && a.match(/[a-z]/)) {
            $("#capital").removeClass("invalid").addClass("valid");
            score++;
        } else {
            $("#capital").removeClass("valid").addClass("invalid");
        }
 
        // at least 1 special character in password {
        /*if ( a.match(/.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/) ) {
                $("#spchar").removeClass("invalid").addClass("valid");
                score++;
        } else {
                $("#spchar").removeClass("valid").addClass("invalid");
        }*/
 
 
        if(a.length > 0) {
                //show strength text
                $("#passwordDescription").text(desc[score]);
                // show indicator
                $("#passwordStrength").removeClass().addClass("strength"+score);
        } else {
                $("#passwordDescription").text("Password not entered");
                $("#passwordStrength").removeClass().addClass("strength"+score);
        }
        
		
	});
	 
	$("#password").blur(function () {
		
		$("#pwd_strength_wrap").fadeOut(10);
	    $("#ver").show();
	    $("#verpassword").focus();
	});
	
	
	// Expand Panel
	$("#open").click(function(){
		$("div#panel").slideDown("slow");	
	});	
	
	// Collapse Panel
	$("#close").click(function(){
		$("div#panel").slideUp("slow");	
	});		
	
	// Switch buttons from "Log In | Register" to "Close Panel" on click
	$("#toggle a").click(function () {
		$("#toggle a").toggle();
	});		
		
	
	$("#reset").click(function(){
		resetData();
	});
	
	$("#changepasslink").click(function(){
		document.getElementById('currPass').value='';
		document.getElementById('newPass').value='';
		$("#changePassDiv").fadeToggle(1000);
	});
	
	
	
	
$("#change").click(function(event){
	if($("#chgfrm")[0].checkValidity()){
		event.preventDefault();				
		var currPass = document.getElementById('currPass').value;
		var newPass = document.getElementById('newPass').value;
		try{
			openModal();
			$.ajax({
				
	            type:'POST',	   	            
	            url:'ChangePassword.php',
	            data:'currpass='+currPass+'&newpass='+newPass,
	            success:function(data) {	 
	            	closeModal();	            	
	            	if(data=='error')
	            		{
	            		alert('Error occured while changing your password. Please try again later');
	            		
	            		}
	            	else if(data=='1')
	            		{
	            		alert('The entered current password is wrong.');
	            		}	            	
	            	else
	            		{
	            		alert('Your Password has been changed successfully.');
	            		document.getElementById('currPass').value='';
	            		document.getElementById('newPass').value='';
	            		$("#changePassDiv").fadeOut(1000);
	            		}
	            	
	            		            	
	            	
	            },
	            error:function(XMLHttpRequest, textStatus, errorThrown){
	            	closeModal();
	                alert("error="+XMLHttpRequest.status+" error2="+textStatus+" error3="+errorThrown);
	                document.getElementById('currPass').value='';
            		document.getElementById('newPass').value='';
	                return false;
	            }
	        });
			}
			catch(e)
			{
				alert(e);
			}						
	}
	else
	{
	 console.log("invalid form");
	}
	});
	
	
	
	
	

	$("#loginLink").click(function( event ){
		event.preventDefault();
    	$(".overlay").fadeToggle("fast");
  	});
	
	$(".overlayLink").click(function(event){
		
		event.preventDefault();
		
		resetData();
		var action = $(this).attr('data-action');
		/*
		$.get( "ajax/" + action, function( data ) {
		
			$( ".login-content" ).html( data );
		
		});	*/
		
		$(".overlay").fadeToggle("fast");
	});
	
	$(".close").click(function(){
		$(".overlay").hide();
	});
	
	
	
	
	
	
	
	
$(".overlaylinkprof").click(function(event){
		//alert('1');
		event.preventDefault();				
		//var action = $(this).attr('data-action');
		
		try{
			openModal();
			$.ajax({
				
	            type:'GET',	            
	            url:'GetProfileData.php',
	            success:function(data) {	 
	            	closeModal();
	            	//alert(data);	            	
	            	if(data=='error')
	            		{
	            		alert('Error occured while retrieving your data. Please try again later');	            		
	            		}
	            	else
	            		{
	            		var result=data.split(':');
	            		document.getElementById('fnameu').value=result[0];
	            		document.getElementById('lnameu').value=result[1];
	            		document.getElementById('contactNou').value=result[2];
	            		document.getElementById('addline1u').value=result[3];
	            		document.getElementById('addline2u').value=result[4];
	            		document.getElementById('zipcodeu').value=result[5];
	            		document.getElementById('cityu').value=result[6];
	            		document.getElementById('stateu').value=result[7];
	            		document.getElementById('countryu').value=result[8];
	            		//document.getElementById('fname').value="<?php echo $_SESSION['FIRST_NAME']?>";
	            		$(".overlayprof").fadeToggle("fast");
	            		}
	            		            	
	            	
	            },
	            error:function(XMLHttpRequest, textStatus, errorThrown){
	            	closeModal();
	                alert("error="+XMLHttpRequest.status+" error2="+textStatus+" error3="+errorThrown)
	                return false;
	            }
	        });
			}
			catch(e)
			{
				alert(e);
			}
		
		
		//$(".overlayprof").fadeToggle("fast");
	});
	
	$(".closeprof").click(function(){
		$(".overlayprof").hide();
	});
	
	
	

$("#update").click(function(event){
		
		event.preventDefault();		
		var fname=document.getElementById('fnameu').value;
		var lname=document.getElementById('lnameu').value;				
		var addline1=document.getElementById('addline1u').value;
		var addline2=document.getElementById('addline2u').value;
		var zipcode=document.getElementById('zipcodeu').value;
		var city=document.getElementById('cityu').value;
		var state=document.getElementById('stateu').value;
		var country=document.getElementById('countryu').value;
		var contactNo=document.getElementById('contactNou').value;
		try{
			openModal();
			
			$.ajax({				
	            type:'POST',	            
	            url:'UpdateProfile.php',
	            data:'fname='+fname+'&lname='+lname+'&addline1='+addline1+'&addline2='+addline2+'&zipcode='+zipcode+'&city='+city+'&state='+state+'&country='+country+'&contactNo='+contactNo,
	            success:function(data) {	
	            	closeModal();
	            		            	
	            	if(data=='pass')
	            		{
	            		alert('Your data has been updated successfully!');
	            		
	            		}
	            	else
	            		{
	            		alert('Error occured while updating your data. Please try again later');
	            		//alert(data);
	            		}
	            		            	
	            	
	            },
	            error:function(XMLHttpRequest, textStatus, errorThrown){
	            	closeModal();
	                alert("error="+XMLHttpRequest.status+" error2="+textStatus+" error3="+errorThrown)
	                return false;
	            }
	        });
			}
			catch(e)
			{
				alert(e);
			}
		
		
		//$(".overlayprof").fadeToggle("fast");
	});
	
	
	
$(".lost-pwd").click(function(event){
		
		event.preventDefault();				
		var action = $(this).attr('data-action');
		
		
		$(".overlayLost").fadeToggle("fast");
	});
	
	$(".closeLost").click(function(){
		$(".overlayLost").hide();
	});
	
	
	
	
	
	
	
	
	
$(".overlaylinkorder").click(function(event){
			
		event.preventDefault();				
		//var action = $(this).attr('data-action');
		
		try{
			openModal();
			$.ajax({
				
	            type:'GET',	            
	            url:'GetProfileData.php',
	            success:function(data) {	 
	            	closeModal();
	            	//alert(data);	            	
	            	if(data=='error')
	            		{
	            		alert('Error occured while retrieving your data. Please try again later');
	            		
	            		}
	            	else
	            		{
	            		
	            		$(".overlayorder").fadeToggle("fast");
	            		}
	            		            	
	            	
	            },
	            error:function(XMLHttpRequest, textStatus, errorThrown){
	            	closeModal();
	                alert("error="+XMLHttpRequest.status+" error2="+textStatus+" error3="+errorThrown)
	                return false;
	            }
	        });
			}
			catch(e)
			{
				alert(e);
			}
		
			
	});
	
	$(".closeorder").click(function(){
		$(".overlayorder").hide();
	});
	
	
	
	
	
	$(document).keyup(function(e) {
		if(e.keyCode == 27 && $(".overlay").css("display") != "none" ) { 
			event.preventDefault();
			$(".overlay").fadeToggle("fast");
		}
	});

	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	/*var form = document.getElementById("frm");
	form.noValidate = true;
	 
	// set handler to validate the form
	// onsubmit used for easier cross-browser compatibility
	form.onsubmit = validateForm;
	 
	function validateForm(event) {
		
		event.preventDefault();
	 
	    // fetch cross-browser event object and form node
	    event = (event ? event : window.event);
	    var
	        form = (event.target ? event.target : event.srcElement),
	        f, field, formvalid = true;
	 
	    // loop all fields
	    for (f = 0; f < form.elements; f++) {
	 
	        // get field
	        field = form.elements[f];
	 
	        // ignore buttons, fieldsets, etc.
	        if (field.nodeName !== "INPUT" && field.nodeName !== "TEXTAREA" && field.nodeName !== "SELECT") continue;
	 
	        // is native browser validation available?
	        if (typeof field.willValidate !== "undefined") {
	 
	            // native validation available
	            if (field.nodeName === "INPUT" && field.type !== field.getAttribute("type")) {
	 
	                // input type not supported! Use legacy JavaScript validation
	                field.setCustomValidity(LegacyValidation(field) ? "" : "error");
	 
	            }
	 
	            // native browser check
	            field.checkValidity();
	 
	        }
	        else {
	 
	            // native validation not available
	            field.validity = field.validity || {};
	 
	            // set to result of validation function
	            field.validity.valid = LegacyValidation(field);
	 
	            // if "invalid" events are required, trigger it here
	 
	        }
	 
	        if (field.validity.valid) {
	 
	            // remove error styles and messages
	 
	        }
	        else {
	 
	            // style field, show error, etc.
	 
	            // form is invalid
	            formvalid = false;
	        }
	 
	    }
	 
	    // cancel form submit if validation fails
	    if (!formvalid) {
	        if (event.preventDefault) event.preventDefault();
	    }
	    return formvalid;
	}
	 
	 
	// basic legacy validation checking
	function LegacyValidation(field) {
	 
	    var
	        valid = true,
	        val = field.value,
	        type = field.getAttribute("type"),
	        chkbox = (type === "checkbox" || type === "radio"),
	        required = field.getAttribute("required"),
	        minlength = field.getAttribute("minlength"),
	        maxlength = field.getAttribute("maxlength"),
	        pattern = field.getAttribute("pattern");
	 
	    // disabled fields should not be validated
	    if (field.disabled) return valid;
	 
	    // value required?
	    valid = valid && (!required ||
	        (chkbox && field.checked) ||
	        (!chkbox && val !== "")
	    );
	 
	    // minlength or maxlength set?
	    valid = valid && (chkbox || (
	        (!minlength || val.length >= minlength) &&
	        (!maxlength || val.length <= maxlength)
	    ));
	 
	    // test pattern
	    if (valid && pattern) {
	        pattern = new RegExp(pattern);
	        valid = pattern.test(val);
	    }
	 
	    return valid;
	}
	*/
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	$("#email").change(function(event){
		
		
		var email=document.getElementById('email').value;		
		
		if(email!='' && email!='undefined'){
		
			try{
				openModal();
				$.ajax({
					
		            type:'GET',
		            data:'email='+email,
		            url:'checkUser.php',
		            success:function(data) {
		            	closeModal();
		            	if(data!='' && data!='undefined' && data!=null)
		            	{
		            	alert(data);
		            	document.getElementById('email').value='';
		            	}
		                
		            },
		            error:function(XMLHttpRequest, textStatus, errorThrown){
		            	closeModal();
		                alert("error="+XMLHttpRequest.status+" error2="+textStatus+" error3="+errorThrown)
		                return false;
		            }
		        });
				}
				catch(e)
				{
					alert(e);
				}
				
			
		}
		
	});
	
	
	
	
        $("#lostpass").click(function () {
        	alert('1');
            $("#dialog").dialog({modal: true, height: 50, width: 50 });
        });
	
	
	
	
	
	
	$("#login").click(function(event){		
		
		if($("#loginForm")[0].checkValidity()){
		event.preventDefault();	
			var userName=document.getElementById('userName').value;
			var password=document.getElementById('Password').value;						
			
			
			try{
				openModal();
			$.ajax({
				
	            type:'POST',
	            data:'userName='+userName+'&Password='+password,
	            url:'login.php',
	            beforeSend: function(){ $("#login").val('Loading...');},
	            success:function(data) {	            	
	            	//alert(data);
	            	closeModal();
	            	var result = data.split(',');
	            	var errorMsg='';
	            	
	            	
	            	for(var i=0;i<result.length;i++)
	            		{
	            		if(result[i]=='1')
	            			errorMsg=errorMsg+'Please enter your email/UserName\n';
	            		if(result[i]=='2')
	            			errorMsg=errorMsg+'Your EMail Address is invalid\n';
	            		if(result[i]=='3')
	            			errorMsg=errorMsg+'Please Enter Your Password\n';
	            		if(result[i]=='4')
	            			errorMsg=errorMsg+'Query Failed\n';
	            		if(result[i]=='5')
	            			errorMsg=errorMsg+'Your account is inactive. Kindly activate it by clicking on the link sent to your email/n';
	            		if(result[i]=='6')
	            			errorMsg=errorMsg+'You have entered a wrong password\n';
	            		if(result[i]=='7')
	            			errorMsg=errorMsg+'Either Your Account is inactive or Email address /Password is Incorrect\n';
	            		if(result[i]=='8')
	            			cart=true;
	            		}
	            	
	            	if(errorMsg!='')
	            		{
	            		
	            		//$('#box').shake();
	            		alert(errorMsg);
	            		document.getElementById('Password').value='';
	            		$("#login").val('Login');
	            		}
	            	else
	            		{
	            		//$("body").load("home.php").hide().fadeIn(1500).delay(6000);
	            	/*	cart=false;
	            		if(cart)
	            			{
	            				document.getElementById('command').value='update';
	            				window.location.href='shoppingCart.php';
	            			}
	            		else*/	            			
	            		window.location.href='home.php';
	            		}
	                
	            },
	            error:function(XMLHttpRequest, textStatus, errorThrown){
	            	closeModal();
	            	$('#box').shake();
	            	$("#login").val('Login');
	                alert("error="+XMLHttpRequest.status+" error2="+textStatus+" error3="+errorThrown)
	                return false;
	            }
	        });
			}
			catch(e)
			{
				alert(e);
			}
			
			
			
		}
		else
			{
			 console.log("invalid form");
			}
			
		});
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	$("#recover").click(function(event){		
		
		if($("#lostfrm")[0].checkValidity()){
		event.preventDefault();	
			
		var username=document.getElementById('username').value;				
			try{
				openModal();
			$.ajax({				
	            type:'GET',
	            data:'userName='+username,
	            url:'RecoverPassword.php',
	            success:function(data) {
	            	closeModal();
	            	document.getElementById('username').value='';
	            	alert(data);
	                
	            },
	            error:function(XMLHttpRequest, textStatus, errorThrown){
	            	closeModal();
	            	document.getElementById('username').value='';
	                alert("error="+XMLHttpRequest.status+" error2="+textStatus+" error3="+errorThrown)
	                return false;
	            }
	        });
			}
			catch(e)
			{
				alert(e);
			}
			
			
			
		}
		else
			{
			 console.log("invalid form");
			}
			
		});
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	

	
	
	
$("#signup").click(function(event){		
		
	if($("#frm")[0].checkValidity()){
	event.preventDefault();	
	
		if(!validateCaptcha())
			{
			alert('The entered captcha value does not match with the image value');
			document.getElementById('captchaVal').value='';
			return false;
			}
						
		if(score<2)
			{
			alert('Please enter password as per the mentioned rules');
			return false;
			}
		var password=document.getElementById('password').value;
		var verpassword=document.getElementById('verpassword').value;
		
		if(password!='' && password!='undefined' && verpassword!='' && verpassword!='undefined')
			{
			if(password!=verpassword)
				{
				alert('Passwords do not match');
				return false;
				}
			}
		
		
		
		
		
		
		var fname=document.getElementById('fname').value;
		var lname=document.getElementById('lname').value;
		var email=document.getElementById('email').value;
		
		var addline1=document.getElementById('addline1').value;
		var addline2=document.getElementById('addline2').value;
		var zipcode=document.getElementById('zipcode').value;
		var city=document.getElementById('city').value;
		var state=document.getElementById('state').value;
		var country=document.getElementById('country').value;
		var contactNo=document.getElementById('contactNo').value;
		
		
		try{
			openModal();
		$.ajax({
			
            type:'POST',
            data:'fname='+fname+'&lname='+lname+'&email='+email+'&password='+password+'&verpassword='+verpassword+'&addline1='+addline1+'&addline2='+addline2+'&zipcode='+zipcode
            +'&city='+city+'&state='+state+'&country='+country+'&contactNo='+contactNo,
            url:'insertData.php',
            success:function(data) {
            	closeModal();
            	resetData();
            	alert(data);
                
            },
            error:function(XMLHttpRequest, textStatus, errorThrown){
            	closeModal();
                alert("error="+XMLHttpRequest.status+" error2="+textStatus+" error3="+errorThrown)
                return false;
            }
        });
		}
		catch(e)
		{
			alert(e);
		}
		
		
		
	}
	else
		{
		 console.log("invalid form");
		}
		
	});
	
	
$textInputs = $('input.input-text');
$textInputs.on('keyup', function() {
    var $validTextInputs = $('input.input-text:valid'),
        $submit = $('#signup');
    console.log($textInputs.length, $validTextInputs.length);
    if($textInputs.length === $validTextInputs.length){
        //all text fields are valid
        $submit.attr('disabled', null);
    } else {
        //not all text fields are valid
        $submit.attr('disabled', '');
    }
});
	
	
	 var _SlideshowTransitions = [
	                              //Fade
	                              { $Duration: 1200, $Opacity: 2 }
	                              ];

	                              var options = {
	                                  $AutoPlay: true,                                    //[Optional] Whether to auto play, to enable slideshow, this option must be set to true, default value is false
	                                  $AutoPlaySteps: 1,                                  //[Optional] Steps to go for each navigation request (this options applys only when slideshow disabled), the default value is 1
	                                  $AutoPlayInterval: 3000,                            //[Optional] Interval (in milliseconds) to go for next slide since the previous stopped if the slider is auto playing, default value is 3000
	                                  $PauseOnHover: 1,                               //[Optional] Whether to pause when mouse over if a slider is auto playing, 0 no pause, 1 pause for desktop, 2 pause for touch device, 3 pause for desktop and touch device, 4 freeze for desktop, 8 freeze for touch device, 12 freeze for desktop and touch device, default value is 1

	                                  $ArrowKeyNavigation: true,   			            //[Optional] Allows keyboard (arrow key) navigation or not, default value is false
	                                  $SlideDuration: 500,                                //[Optional] Specifies default duration (swipe) for slide in milliseconds, default value is 500
	                                  $MinDragOffsetToSlide: 20,                          //[Optional] Minimum drag offset to trigger slide , default value is 20
	                                  //$SlideWidth: 600,                                 //[Optional] Width of every slide in pixels, default value is width of 'slides' container
	                                  //$SlideHeight: 300,                                //[Optional] Height of every slide in pixels, default value is height of 'slides' container
	                                  $SlideSpacing: 0, 					                //[Optional] Space between each slide in pixels, default value is 0
	                                  $DisplayPieces: 1,                                  //[Optional] Number of pieces to display (the slideshow would be disabled if the value is set to greater than 1), the default value is 1
	                                  $ParkingPosition: 0,                                //[Optional] The offset position to park slide (this options applys only when slideshow disabled), default value is 0.
	                                  $UISearchMode: 1,                                   //[Optional] The way (0 parellel, 1 recursive, default value is 1) to search UI components (slides container, loading screen, navigator container, arrow navigator container, thumbnail navigator container etc).
	                                  $PlayOrientation: 1,                                //[Optional] Orientation to play slide (for auto play, navigation), 1 horizental, 2 vertical, 5 horizental reverse, 6 vertical reverse, default value is 1
	                                  $DragOrientation: 3,                                //[Optional] Orientation to drag slide, 0 no drag, 1 horizental, 2 vertical, 3 either, default value is 1 (Note that the $DragOrientation should be the same as $PlayOrientation when $DisplayPieces is greater than 1, or parking position is not 0)

	                                  $SlideshowOptions: {                                //[Optional] Options to specify and enable slideshow or not
	                                      $Class: $JssorSlideshowRunner$,                 //[Required] Class to create instance of slideshow
	                                      $Transitions: _SlideshowTransitions,            //[Required] An array of slideshow transitions to play slideshow
	                                      $TransitionsOrder: 1,                           //[Optional] The way to choose transition to play slide, 1 Sequence, 0 Random
	                                      $ShowLink: true                                    //[Optional] Whether to bring slide link on top of the slider when slideshow is running, default value is false
	                                  },

	                                  $BulletNavigatorOptions: {                                //[Optional] Options to specify and enable navigator or not
	                                      $Class: $JssorBulletNavigator$,                       //[Required] Class to create navigator instance
	                                      $ChanceToShow: 2,                               //[Required] 0 Never, 1 Mouse Over, 2 Always
	                                      $AutoCenter: 1,                                 //[Optional] Auto center navigator in parent container, 0 None, 1 Horizontal, 2 Vertical, 3 Both, default value is 0
	                                      $Steps: 1,                                      //[Optional] Steps to go for each navigation request, default value is 1
	                                      $Lanes: 1,                                      //[Optional] Specify lanes to arrange items, default value is 1
	                                      $SpacingX: 10,                                   //[Optional] Horizontal space between each item in pixel, default value is 0
	                                      $SpacingY: 10,                                   //[Optional] Vertical space between each item in pixel, default value is 0
	                                      $Orientation: 1                                 //[Optional] The orientation of the navigator, 1 horizontal, 2 vertical, default value is 1
	                                  },

	                                  $ArrowNavigatorOptions: {
	                                      $Class: $JssorArrowNavigator$,              //[Requried] Class to create arrow navigator instance
	                                      $ChanceToShow: 2,                               //[Required] 0 Never, 1 Mouse Over, 2 Always
	                                      $Steps: 1                                       //[Optional] Steps to go for each navigation request, default value is 1
	                                  }
	                              };
	                              var jssor_slider1 = new $JssorSlider$("slider1_container", options);

	                              //responsive code begin
	                              //you can remove responsive code if you don't want the slider scales while window resizes
	                              function ScaleSlider() {
	                                  var parentWidth = jssor_slider1.$Elmt.parentNode.clientWidth;
	                                  if (parentWidth)
	                                      jssor_slider1.$ScaleWidth(Math.min(parentWidth, 600));
	                                  else
	                                      window.setTimeout(ScaleSlider, 30);
	                              }

	                              ScaleSlider();

	                              if (!navigator.userAgent.match(/(iPhone|iPod|iPad|BlackBerry|IEMobile)/)) {
	                                  $(window).bind('resize', ScaleSlider);
	                              }

	                              
	                              
	                              
	                              
	                              
	                              
	                              $("#logout").click(function(event){
	                            		
	                            	  window.location.href='logout.php';
	                            	  	
	                            	  });	                              
	                              
	                              

	            

	                              
	                              
	                              	                              
	                              
	                           	                              
	                              
	                              
});



function resetData()
{	
	document.getElementById('fname').value='';
	document.getElementById('lname').value='';
	document.getElementById('email').value='';
	document.getElementById('password').value='';
	document.getElementById('verpassword').value='';
	document.getElementById('addline1').value='';
	document.getElementById('addline2').value='';
	document.getElementById('zipcode').value='';
	document.getElementById('city').value='';
	document.getElementById('state').value='';
	document.getElementById('country').value='';
	document.getElementById('contactNo').value='';
	document.getElementById('captchaVal').value='';
}


function validateCaptcha()
{

	if(captcha==document.getElementById('captchaVal').value)
		return true;
	else
		return false;
	
}






function openModal() {
    document.getElementById('modal').style.display = 'block';
    document.getElementById('fade').style.display = 'block';
}

function closeModal() {
document.getElementById('modal').style.display = 'none';
document.getElementById('fade').style.display = 'none';
}