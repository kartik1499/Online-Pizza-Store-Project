/**
 * 
 */

$(document).ready(function(){	
	$("#reorder").click(function(event){		
		event.preventDefault();
		try{
			openModal();
			$.ajax({
				
	            type:'POST',	   	            
	            url:'reorder.php',
	           
	            success:function(result) {	 
	            	closeModal();
	            	/*if(result!='')
	            	alert(result);*/
	            	if(result == 1)
	            		{
	            		alert("Please log in to place order");
	            		}
	            	else
	            		{
	            		//window.location.href="\\OnlinePizzaSystem\\pdfs\\"+result+".pdf";
	            		//var url="\\OnlinePizzaSystem\\pdfs\\"+result+".pdf";
	            		//window.open(url);
	            		
	            		alert('Your order has been received and your pizza will be delivered to your address in 30 minutes !');
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
	
});



function openModal() {
    document.getElementById('modal').style.display = 'block';
    document.getElementById('fade').style.display = 'block';
}

function closeModal() {
document.getElementById('modal').style.display = 'none';
document.getElementById('fade').style.display = 'none';
}