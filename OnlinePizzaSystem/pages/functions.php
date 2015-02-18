<?php

function get_item_name($itemid){
	$result=mysql_query("select upper(ITEM_NAME) as ITEM_NAME from ITEMS_MASTER where item_id=$itemid");
	$row=mysql_fetch_array($result);
	return $row['ITEM_NAME'];
}

function get_base_name($baseid){
	$result=mysql_query("SELECT UPPER(BASE_TYPE_DESCRIPTION) AS BASE_TYPE_DESCRIPTION FROM PIZZA_BASE_TYPE WHERE BASE_TYPE_ID=$baseid");
	$row=mysql_fetch_array($result);
	return $row['BASE_TYPE_DESCRIPTION'];
}



function get_topping_name($toppingid){
	
	$toppings="";
	if($toppingid!=null && $toppingid!=""){
	$result=mysql_query("SELECT UPPER(TOPPING_DESCRIPTION) AS TOPPING_DESCRIPTION FROM PIZZA_TOPPING_TYPE WHERE TOPPING_ID IN (".$toppingid.")");	
	
	while($row = mysql_fetch_assoc($result)) {
	
		$toppings = $toppings.$row['TOPPING_DESCRIPTION'].",";
	
	}
	$toppings = substr($toppings, 0,-1);
	}
	if($toppings=="")
		$toppings="None";
	return $toppings;
}


function get_pizza_price($baseid,$toppingid){
	
	
	$result = mysql_query("SELECT B.BASE_TYPE_PRICE AS BASE_PRICE FROM PIZZA_BASE_TYPE B WHERE B.BASE_TYPE_ID='".$baseid."'");
	$row=mysql_fetch_array($result);
	$basePrice= $row['BASE_PRICE'];
	
	$toppingPrice=0;
	if($toppingid!=null && $toppingid!="") 
	{
	$result=mysql_query("SELECT SUM(T.TOPPING_PRICE) AS TOPPING_PRICE FROM PIZZA_TOPPING_TYPE T WHERE T.TOPPING_ID IN (".$toppingid.")");
	$row=mysql_fetch_array($result);
	$toppingPrice= $row['TOPPING_PRICE'];
	}
	
	
	$totalPrice = $basePrice+$toppingPrice;
	return $totalPrice;
}


function addtocart($itemid,$baseid,$toppingid,$q,$categoryid){
	if($itemid<1 or $q<1) return;

	if(isset($_SESSION['cart']) && is_array($_SESSION['cart'])){
		if(product_exists($itemid,$baseid,$toppingid,$categoryid)) return;
		$max=count($_SESSION['cart']);
		$_SESSION['cart'][$max]['itemid']=$itemid;
		$_SESSION['cart'][$max]['baseid']=$baseid;
		$_SESSION['cart'][$max]['tid']=$toppingid;
		$_SESSION['cart'][$max]['qty']=$q;
		$_SESSION['cart'][$max]['categoryid']=$categoryid;
	}
	else{
		$_SESSION['cart']=array();
		$_SESSION['cart'][0]['itemid']=$itemid;
		$_SESSION['cart'][0]['baseid']=$baseid;
		$_SESSION['cart'][0]['tid']=$toppingid;
		$_SESSION['cart'][0]['qty']=$q;
		$_SESSION['cart'][0]['categoryid']=$categoryid;
	}

	
}



function addsofttocart($itemid,$q,$categoryid){
	if($itemid<1 or $q<1) return;

	if(isset($_SESSION['cart']) && is_array($_SESSION['cart'])){
		if(product_exists($itemid,"","",$categoryid)) return;
		$max=count($_SESSION['cart']);
		$_SESSION['cart'][$max]['itemid']=$itemid;
		$_SESSION['cart'][$max]['baseid']="";
		$_SESSION['cart'][$max]['tid']="";
		$_SESSION['cart'][$max]['qty']=$q;
		$_SESSION['cart'][$max]['categoryid']=$categoryid;
	}
	else{
		$_SESSION['cart']=array();
		$_SESSION['cart'][0]['itemid']=$itemid;
		$_SESSION['cart'][0]['baseid']="";
		$_SESSION['cart'][0]['tid']="";
		$_SESSION['cart'][0]['qty']=$q;
		$_SESSION['cart'][0]['categoryid']=$categoryid;
	}


}



function product_exists($itemid,$baseid,$toppingid,$categoryid){
	$itemid=intval($itemid);
	$baseid=intval($baseid);
	$categoryid=intval($categoryid);
	$max=count($_SESSION['cart']);
	$flag=0;
	for($i=0;$i<$max;$i++){
		if($categoryid==1)
		{
		if($itemid==$_SESSION['cart'][$i]['itemid'] && $baseid==$_SESSION['cart'][$i]['baseid'] && $toppingid==$_SESSION['cart'][$i]['tid']){
			$flag=1;
			break;
		}
		}
		else
		{
			if($itemid==$_SESSION['cart'][$i]['itemid'])
			{
				$flag=1;
				break;
			}
		}
	}
	return $flag;
}





function remove_product($itemid){
	$itemid=intval($itemid);
	$max=count($_SESSION['cart']);
	for($i=0;$i<$max;$i++){
		if($itemid==$_SESSION['cart'][$i]['itemid']){
			unset($_SESSION['cart'][$i]);
			break;
		}
	}
	$_SESSION['cart']=array_values($_SESSION['cart']);
	$cartCount=count($_SESSION['cart']);
	if($cartCount==0)
	unset($_SESSION['cart']);
}




function get_order_total(){
	$max=count($_SESSION['cart']);
	$sum=0;
	for($i=0;$i<$max;$i++){
		$baseid=$_SESSION['cart'][$i]['baseid'];
		$toppingid=$_SESSION['cart'][$i]['tid'];
		$q=$_SESSION['cart'][$i]['qty'];
		$itemid=$_SESSION['cart'][$i]['itemid'];
		$categoryid=$_SESSION['cart'][$i]['categoryid'];
		if($categoryid==1)
			$price=get_pizza_price($baseid,$toppingid);
		else
			$price=get_drink_price($itemid);
		
		$sum+=$price*$q;
	}
	$_SESSION['sum']=$sum;
	return $sum;
	
	
}



function get_drink_price($itemid){


	$result = mysql_query("SELECT E.EXTRA_ITEM_PRICE AS ITEM_PRICE FROM EXTRAS_MASTER E WHERE E.EXTRA_ITEM_ID='".$itemid."'");
	$row=mysql_fetch_array($result);
	$softPrice= $row['ITEM_PRICE'];

	return $softPrice;
}



function get_soft_name($itemid){


	$result = mysql_query("SELECT ITEM_NAME FROM ITEMS_MASTER WHERE ITEM_ID='".$itemid."'");
	$row=mysql_fetch_array($result);
	$softPrice= $row['ITEM_NAME'];

	return $softPrice;
}


?>


