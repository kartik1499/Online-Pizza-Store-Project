<?php
require 'database.php';

$variable = $_GET['variable'];

				$a=trim(strval($variable));
			 	$b=trim(strval('category'));
			 	$categoryId = $_GET['categoryId'];
			 	$equal=strcmp($a, $b);
			 	if($equal==0 && $categoryId==1)
			 	{
			 		$query = "SELECT * FROM ITEMS_MASTER WHERE CATEGORY_ID='".$categoryId."' ORDER BY ITEM_NAME ASC";
			 		$result_data = mysql_query($query);			 					 		
			 		
			 		while($row = mysql_fetch_assoc($result_data)) {
			 		
			 			echo $row['ITEM_ID'].'#'.$row['ITEM_NAME'].'#'.$row['ITEM_DESCRIPTION'].'***';
			 			 
			 		}
			 	}
			 	
			 	if($equal==0 && $categoryId==3)
			 	{
			 		$query = "SELECT * FROM ITEMS_MASTER WHERE CATEGORY_ID='".$categoryId."' ORDER BY ITEM_NAME ASC";
			 		
			 		$query = "SELECT ITEM_ID, ITEM_NAME, EXTRA_ITEM_PRICE FROM ITEMS_MASTER JOIN EXTRAS_MASTER ON ITEM_ID = EXTRA_ITEM_ID WHERE CATEGORY_ID='".$categoryId."' ORDER BY ITEM_NAME ASC";
			 		$result_data = mysql_query($query);
			 	
			 		while($row = mysql_fetch_assoc($result_data)) {
			 	
			 			echo $row['ITEM_ID'].'#'.$row['ITEM_NAME'].'#'.$row['EXTRA_ITEM_PRICE'].'***';
			 	
			 		}
			 	}
			 	
			 	$c=trim(strval('items'));
			 	$equalItem = strcmp($a, $c);
			 	
			 	if(isset($_GET['itemId'])){
			 	$itemId = $_GET['itemId'];
			 	if($equalItem==0)
			 	{
			 		$query = "SELECT * FROM PIZZA_BASE_TYPE WHERE ITEM_ID='".$itemId."' ORDER BY BASE_TYPE_DESCRIPTION ASC";
			 		$result_data = mysql_query($query);
			 	
			 		while($row = mysql_fetch_assoc($result_data)) {
			 	
			 			echo $row['BASE_TYPE_ID'].'#'.$row['BASE_TYPE_PRICE'].'#'.$row['BASE_TYPE_DESCRIPTION'].'*';
			 	
			 		}
			 		
			 		
			 		echo '@';
			 		
			 		$query = "SELECT * FROM PIZZA_TOPPING_TYPE ORDER BY TOPPING_DESCRIPTION ASC";
			 		$result_data = mysql_query($query);
			 			
			 		while($row = mysql_fetch_assoc($result_data)) {
			 				
			 			echo $row['TOPPING_ID'].'#'.$row['TOPPING_PRICE'].'#'.$row['TOPPING_DESCRIPTION'].'*';
			 				
			 		}
			 		
			 		
			 	}
		}
			 	

?>