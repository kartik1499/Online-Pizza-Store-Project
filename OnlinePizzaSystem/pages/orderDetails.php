<?php
require 'database.php';
include 'functions.php';
?>

<!DOCTYPE HTML>
<html>
<head>


<title>
Order Details
</title>


	
    <!-- jQuery - the core -->
    	<script src="/OnlinePizzaSystem/js/jquery-1.3.2.min.js" type="text/javascript"></script>
	<!-- Sliding effect -->
	<script src="/OnlinePizzaSystem/js/slide.js" type="text/javascript"></script>
	<script src="http://code.jquery.com/jquery-latest.min.js"></script>
	
	<script src="/OnlinePizzaSystem/js/reorder.js" type="text/javascript"></script>
	
	<link rel="stylesheet" href="/OnlinePizzaSystem/css/display.css" type="text/css" media="screen" />
<link rel="stylesheet" href="/OnlinePizzaSystem/css/style.css" type="text/css" media="screen" />
  	<link rel="stylesheet" href="/OnlinePizzaSystem/css/slide.css" type="text/css" media="screen" />
</head>



<body>

<div id="fade"></div>
        <div id="modal">
            <img id="loader" src="/OnlinePizzaSystem/images/loading.gif" />
        </div>
        
<?php

session_start();
 if(!isset($_SESSION['username'])){
header("Location: index.php");
}

include 'LoginSlider.php';
?>

<?php 
$orderid = $_GET['orderid'];

$_SESSION['orderid'] = $orderid;

?>
<a style="text-decoration: underline;color: blue" href="index.php"><h2>Home</h2></a>
<div style="position: absolute;top:150px;left: 100px;width: 700px">
<h2>Your Order Details for Order ID: <?php echo $orderid;?></h2>

<br />

<table  cellspacing="20" cellpadding="20" ">
				<tr>
				
				<th align="center">
				Item Name
				</th>
				
				<th align="center">
				Base Description
				</th>
				
				<th align="center">
				Toppings
				</th>
				
				<th align="center">
				Quantity
				</th>
				
				<th align="center">
				Total Pizza Price (in $)
				</th>
				
				</tr>
<?php 


$query = "SELECT I.ITEM_NAME, I.ITEM_ID, B.BASE_TYPE_ID, B.BASE_TYPE_DESCRIPTION, P.PIZZA_SEQ_NO, P.QUANTITY, P.TOTAL_PIZZA_PRICE FROM PIZZAS_ORDERED P  JOIN ITEMS_MASTER I ON I.ITEM_ID=P.ITEM_ID JOIN PIZZA_BASE_TYPE B ON B.BASE_TYPE_ID=P.BASE_TYPE_ID WHERE P.ORDER_ID='".$orderid."'";
$result= mysql_query($query);

while($row = mysql_fetch_assoc($result)) {
	
	$itemname = $row['ITEM_NAME'];
	$basedescription = $row['BASE_TYPE_DESCRIPTION'];
	$total_price = $row['TOTAL_PIZZA_PRICE'];
	$quantity = $row['QUANTITY'];
	$pizza_seq_no = $row['PIZZA_SEQ_NO'];
	
	$get_pizza_no = "SELECT * FROM PIZZA_TOPPINGS_MAPPING M WHERE M.PIZZA_SEQUENCE_NO='".$pizza_seq_no."'";
	$order_query = mysql_query($get_pizza_no);
	$toppingid="";
	
	if (@mysql_num_rows($order_query) > 0) {
		// output data of each row
		while($row = mysql_fetch_assoc($order_query)) {
				
			$toppingid = $toppingid.$row["TOPPING_ID"].",";
				
		}
	}
	
	$toppingid = substr($toppingid, 0,-1);
	
	$topping_name = get_topping_name($toppingid);
	
	?>
						<tr>
						<td align="center"><?php echo $itemname;?>
						</td>
						
						<td align="center"><?php echo $basedescription;?>
						</td>
						
						<td align="center"><?php echo $topping_name;?>
						</td>
						
						<td align="center"><?php echo $quantity;?>
						</td>
						
						<td align="center"><?php echo $total_price;?>
						</td>
						</tr>
						<?php 
				
}

?>

</table>

<br />

<div align="center">
<input type="button" value="Order this Selection" id="reorder" class="btn" >
</div>
</div>
		</div>
			</div>
</body>

</html>