/**
 * 
 */
var price = 0;
var flag = false;
var finalPrice=0;
$(function(){
	
	$('select').selectric();
	$('.select').selectric();
	
	$("#category").change(function(event){
		
		//alert('changed val : '+ document.getElementById('category').value);
		var categoryId = document.getElementById('category').value;

		document.getElementById('itemPrice').innerHTML='';
		
		document.getElementById('items').options.length=0;
		$('#dropdownPizzaItems').hide();
		document.getElementById('baseItems').options.length=0;
		$('#dropdownPizzaBaseItems').hide();
		$('#dropdownPizzaToppingItems').hide();
		
		document.getElementById('softitems').options.length=0;
		$('#softDrinkItems').hide();
		
		if(categoryId=='')
		{
		alert('Please select a category !!');		
		flag=false;
		document.getElementById('itemPrice').innerHTML='<b>$ 0.00</b>';
		return false;
		}
		
		try{
			openModal();
			$.ajax({
				
	            type:'GET',	   	            
	            url:'GetItems.php',
	            data:'categoryId='+categoryId+'&variable=category',
	            success:function(data) {	 
	            	closeModal();	  	            	
	            	var itemsList = data.split('***');
	            
	            	if(categoryId==1)
	            	{
	            	var div = document.getElementById('dropdown');	            	
	            	/*var header = document.createElement('h3');
	            	header.innerHTML = 'Select an item :';
	            	div.appendChild(header);
	            	div.appendChild('<br />');*/
	            	var selectItem = document.getElementById('items');	            	
	            	var option = document.createElement('option');
            		option.value='';
            		option.text='--Select an item--';
            		selectItem.add(option);
            		
	            	for(var i=0;i<itemsList.length;i++)
	            		{
	            		var id = itemsList[i].split('#')[0];
	            		var name = itemsList[i].split('#')[1];	            		
	            		if(id!='' && id!='null' && id!='undefined' && id!=null)
	            		{
	            		var option1 = document.createElement('option');
	            		option1.value=id;
	            		option1.text=name;
	            		selectItem.add(option1);
	            		}
	            		
	            		}
	            	
	            	
	            	$('#items').selectric('refresh');	            	
	            	$('#dropdownPizzaItems').show();
	            	}
	            	else
	            		{
	            		
	            		
	            		
	            		var div = document.getElementById('dropdown');	            	
		            	
		            	var selectItem = document.getElementById('softitems');	            	
		            	var option = document.createElement('option');
	            		option.value='';
	            		option.text='--Select an item--';
	            		selectItem.add(option);
	            		
		            	for(var i=0;i<itemsList.length;i++)
		            		{
		            		var id = itemsList[i];
		            		var name = itemsList[i].split('#')[1];	            		
		            		if(id!='' && id!='null' && id!='undefined' && id!=null)
		            		{
		            		var option1 = document.createElement('option');
		            		option1.value=id;
		            		option1.text=name;
		            		selectItem.add(option1);
		            		}
		            		
		            		}
		            	
		            	
		            	$('#softitems').selectric('refresh');	            	
		            	$('#softDrinkItems').show();
	            		
	            		}
	            	$("html, body").animate({ scrollTop: $(window).height()}, 600);
	            	
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
	

	
	
	
	
$("#softitems").change(function(event){
			
		var val = document.getElementById('softitems').value;		
		price = val.split('#')[2];		
		document.getElementById('itemPrice').innerHTML='';
		document.getElementById('itemPrice').innerHTML='<b>$ '+price+'</b>';
		flag = true;
		$('#price').show();
		$("html, body").animate({ scrollTop: $(window).height()}, 600);		
				
		
	});

	
	
	
	$("#items").change(function(event){
				
		var itemId = document.getElementById('items').value;
		document.getElementById('baseItems').options.length=0;
		$('#dropdownPizzaBaseItems').hide();
		if(itemId=='')
			{
			alert('Please select an Item !!');	
			flag=false;
			document.getElementById('itemPrice').innerHTML='<b>$ 0.00</b>';
			return false;
			}
		
		try{
			openModal();
			$.ajax({
				
	            type:'GET',	   	            
	            url:'GetItems.php',
	            data:'itemId='+itemId+'&variable=items&categoryId=0',
	            success:function(data) {	 
	            	
	            	closeModal();
	            	$('input').iCheck('uncheck');
	            	var baseListData = data.split('@')[0];	            	
	            	
	            	var baseList = baseListData.split('*');
	            	var toppingsListData = data.split('@')[1];
	            	var toppingsList = toppingsListData.split('*');
	            	var selectItem = document.getElementById('baseItems');            		        		
	            	
	            	/*var selectTopping= document.getElementById('toppingItems');
	            	
	            	var option = document.createElement('option');
            		option.value='';
            		option.text='--Select a topping--';
            		selectTopping.add(option);
	            	*/
	            	for(var i=0;i<baseList.length;i++)
	            		{
	            		var id1 = baseList[i].split('#')[0]+'#';
	            		var id2 = baseList[i].split('#')[1];
	            		var id = id1.concat(id2);
	            		var name = baseList[i].split('#')[2];
	            		if(name!='' && name!='null' && name!='undefined' && name!=null)
	            		{
	            		var option1 = document.createElement('option');
	            		option1.value=id;
	            		option1.text=name;
	            		selectItem.add(option1);
	            		}
	            		
	            		}
	            	
	            	
	            /*	for(var i=0;i<toppingsList.length;i++)
            		{
            		var id1 = toppingsList[i].split('#')[0];
            		var id2 = toppingsList[i].split('#')[1];
            		var id = id1.concat(id2);
            		var name = toppingsList[i].split('#')[2];
            		if(id!='' && id!='null' && id!='undefined' && id!=null)
            		{
            		var option1 = document.createElement('option');
            		option1.value=id;
            		option1.text=name;
            		selectTopping.add(option1);
            		}
            		
            		}*/
	            	
	            	$('#baseItems').selectric('refresh');
	            	$('#dropdownPizzaBaseItems').show();
	            	
	            	/*$('#toppingItems').selectric('refresh');
	            	$('#dropdownPizzaToppingItems').show();
	            	*/
	            	var val = document.getElementById('baseItems').value;
	            	
	            	price = val.split('#')[1];
	            	document.getElementById('itemPrice').innerHTML='<b>$ '+price+'</b>';
	            	$('#price').show();	           
	            	flag=true;
	            	
	            	if(document.getElementById('toppingsCount').value==0)
	            	{
	            	for(var i=0;i<toppingsList.length;i++)
            		{
            		var id1 = toppingsList[i].split('#')[0];
            		var id2 = toppingsList[i].split('#')[1];
            		//var id = id1.concat(id2);
            		var name = toppingsList[i].split('#')[2];
            		if(name!='' && name!='null' && name!='undefined' && name!=null)
            		{
            			var chk = document.createElement('input');
    	            	chk.setAttribute('type','checkbox');
    	            	chk.setAttribute('value',id2);
    	            	chk.setAttribute('id','chk'+id1);
    	            	
    	            	var label = document.createElement('label')
    	            	label.htmlFor = "chk"+id1;
    	            	label.appendChild(document.createTextNode(name+', $ '+id2));
    	            	var br = document.createElement('br');
    	            	document.getElementById('dropdownPizzaToppingItems').appendChild(chk);
    	            	document.getElementById('dropdownPizzaToppingItems').appendChild(label);
    	            	document.getElementById('dropdownPizzaToppingItems').appendChild(br);
            		}
            		
            		}
	            	}
	            	document.getElementById('toppingsCount').value=10;
	            	$('#dropdownPizzaToppingItems').show();
	            	
	            	$('input').iCheck({
	            	    checkboxClass: 'icheckbox_polaris',
	            	    radioClass: 'iradio_polaris',
	            	    increaseArea: '-10%' // optional
	            	  });
	            	
	            	$('input').on('ifChecked', function(event){
	            		  //alert(event.type + ' callback');
	            		  callMe();
	            		});
	            	
	            	$('input').on('ifUnchecked', function(event){
	            		  //alert(event.type + ' callback');
	            		callMe();
	            		});
	            	
	            	
	            	$("html, body").animate({ scrollTop: $(window).height()}, 600);
	                
	            	
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
	

	
	$("#baseItems").change(function(event){
		
		var val = document.getElementById('baseItems').value;
		price = val.split('#')[1];
		document.getElementById('itemPrice').innerHTML='';
		document.getElementById('itemPrice').innerHTML='<b>$ '+price+'</b>';
		$('#price').show();
		$("html, body").animate({ scrollTop: $(window).height()}, 600);		
		
		$('input').iCheck('uncheck');
		
	});


	$('input').iCheck({
	    checkboxClass: 'icheckbox_polaris',
	    radioClass: 'iradio_polaris',
	    increaseArea: '-10%' // optional
	  });

	
$("#display").submit(function(event){
	
	if(price>finalPrice)
		finalPrice=price;
	
		if(!flag)
			{
			alert("Please select an item");
			event.preventDefault();
			return false;
			}
		else
			{
			var checked="";
			
			
			document.getElementById('categorySelected').value=document.getElementById('category').value;			
			
			
			if(document.getElementById('categorySelected').value==1)
				{
				for(var a = 1; a<=10;a++){
					
					
					if(document.getElementById('chk'+a).checked)
						{			
						//checked = checked+document.getElementById('chk'+a).value+",";
						checked = checked+a+",";
						}
					
				}
				checked = checked.substring(0,checked.length-1);						
				
				document.getElementById('baseSelected').value=document.getElementById('baseItems').value.split("#")[0];
				document.getElementById('toppingsSelected').value=checked;
				document.getElementById('itemSelected').value=document.getElementById('items').value;
				}
			else
				document.getElementById('itemSelected').value=document.getElementById('softitems').value.split('#')[0];						
						
			return true;
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



function callMe()
{
	
	var sum = 0;
	
	for(var a = 1; a<=10;a++){
		
		
		if(document.getElementById('chk'+a).checked)
			{			
			sum=sum+parseFloat(document.getElementById('chk'+a).value);
			}
		
	}
	
	var newprice = parseFloat(price)+sum;
	
	
	document.getElementById('itemPrice').innerHTML='<b>$ '+newprice+'</b>';
	flag=true;
	finalPrice = newprice;
}


