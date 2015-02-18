
$(document).ready(function(){	
	
	
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
	
	
	
	
	
	$("#signup").click(function(event){		
		
		if($("#frm")[0].checkValidity()){
		event.preventDefault();	
		
			if(!validateCaptcha())
				{
				alert('The entered captcha value does not match with the image value');
				document.getElementById('captchaVal').value='';
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
	            	var cart=false;
	            	
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
	            		
	            		if(cart)
	            			{
	            				document.shopping.command.value='update';
	            				document.shopping.submit();
	            			}
	            		else	          			
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
	

	
	
	$("#placeorder").click(function(event){			
		event.preventDefault();
		try{
			openModal();
			$.ajax({
				
	            type:'POST',	   	            
	            url:'PlaceOrder.php',
	           
	            success:function(result) {	 
	            	closeModal();	  
	            	//alert(result);
	            	if(result == 1)
	            		{
	            		alert("Please log in to place order");
	            		}
	            	else
	            		{
	            		//window.location.href="\\OnlinePizzaSystem\\pdfs\\"+result+".pdf";
	            		/*var url="\\OnlinePizzaSystem\\pdfs\\"+result+".pdf";
	            		window.open(url);
	            		*/
	            		
	            		alert('Your order has been received and your pizza will be delivered to your address in 30 minutes !. The order receipt has been mailed to your Email ID');
	            		window.location.href="index.php";
	            		}
	            	
	            },
	            error:function(XMLHttpRequest, textStatus, errorThrown){
	            	closeModal();
	                alert("error="+XMLHttpRequest.status+" error2="+textStatus+" error3="+errorThrown);	               
	                return false;
	            }
	        });
			}
			catch(e)
			{
				alert(e);
			}
		
	});
	

	
	
	
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
		
	
	
$(".overlaylinkprof").click(function(event){
		
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
		
		
		//$(".overlayprof").fadeToggle("fast");
	});
	
	$(".closeorder").click(function(){
		$(".overlayorder").hide();
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

	
	
});



function openModal() {
    document.getElementById('modal').style.display = 'block';
    document.getElementById('fade').style.display = 'block';
}

function closeModal() {
document.getElementById('modal').style.display = 'none';
document.getElementById('fade').style.display = 'none';
}

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
