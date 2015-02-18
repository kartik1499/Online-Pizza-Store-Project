<?php
session_start();
require('fpdf.php');

include 'functions.php';
require 'database.php';


class PDF extends FPDF
{
		
	var $widths;
	var $aligns;
	
	function SetWidths($w)
	{
		//Set the array of column widths
		$this->widths=$w;
	}
	
	function SetAligns($a)
	{
		//Set the array of column alignments
		$this->aligns=$a;
	}
	
	function Row($data)
	{
		//Calculate the height of the row
		$nb=0;
		for($i=0;$i<count($data);$i++)
			$nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
			$h=5*$nb;
			//Issue a page break first if needed
		$this->CheckPageBreak($h);
		//Draw the cells of the row
		for($i=0;$i<count($data);$i++)
		{
		$w=$this->widths[$i];
			$a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
			//Save the current position
			$x=$this->GetX();
			$y=$this->GetY();
			//Draw the border
			$this->Rect($x,$y,$w,$h);
			//Print the text
		$this->MultiCell($w,5,$data[$i],0,$a);
		//Put the position to the right of the cell
		$this->SetXY($x+$w,$y);
		}
		//Go to the next line
		$this->Ln($h);
		}
	
		function CheckPageBreak($h)
		{
		//If the height h would cause an overflow, add a new page immediately
		if($this->GetY()+$h>$this->PageBreakTrigger)
			$this->AddPage($this->CurOrientation);
		}
	
		function NbLines($w,$txt)
		{
		//Computes the number of lines a MultiCell of width w will take
		$cw=&$this->CurrentFont['cw'];
			if($w==0)
			$w=$this->w-$this->rMargin-$this->x;
			$wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
			$s=str_replace("\r",'',$txt);
			$nb=strlen($s);
			if($nb>0 and $s[$nb-1]=="\n")
				$nb--;
				$sep=-1;
				$i=0;
				$j=0;
				$l=0;
						$nl=1;
						while($i<$nb)
						{
						$c=$s[$i];
						if($c=="\n")
						{
						$i++;
						$sep=-1;
						$j=$i;
						$l=0;
						$nl++;
						continue;
						}
							if($c==' ')
								$sep=$i;
								$l+=$cw[$c];
									if($l>$wmax)
									{
									if($sep==-1)
									{
									if($i==$j)
										$i++;
									}
									else
										$i=$sep+1;
										$sep=-1;
									$j=$i;
									$l=0;
									$nl++;
									}
										else
											$i++;
										}
											return $nl;
										}
	
	

}










if(!isset($_SESSION['username'])){
	echo "1";
}
else
{
	try {
				
		$Email=$_SESSION['username'];
		$oldorderid=$_SESSION['orderid'];		
		$query_check_credentials = "SELECT * FROM USER_MASTER WHERE EMAIL_ID='".$Email."'";
		$result_check_credentials = mysql_query($query_check_credentials);		
		$userid="";
		$sum=0;
		if (@mysql_num_rows($result_check_credentials) > 0) {
			// output data of each row
			while($row = mysql_fetch_assoc($result_check_credentials)) {
		
				$userid = $row["USER_ID"];				
		
			}
		}
		
		
		$get_order_id = "SELECT * FROM ORDERS_MASTER WHERE ORDER_ID='".$oldorderid."'";
		$order_query = mysql_query($get_order_id);
		
		if (@mysql_num_rows($order_query) > 0) {
			// output data of each row
			while($row = mysql_fetch_assoc($order_query)) {
					
				$sum = $row["TOTAL_ORDER_PRICE"];
					
			}
		}
		
		$query = "INSERT INTO ORDERS_MASTER VALUES (NULL,'".mysql_real_escape_string($userid)."','IN PROCESS',NULL,'".mysql_real_escape_string($sum)."','')";
		
				
		if($result=mysql_query($query))
		{
						
			
			$get_order_id = "SELECT * FROM ORDERS_MASTER where USER_ID='".$userid."' ORDER BY ORDER_DATE DESC LIMIT 1";
			$order_query = mysql_query($get_order_id);

			if (@mysql_num_rows($order_query) > 0) {
				// output data of each row
				while($row = mysql_fetch_assoc($order_query)) {
			
					$neworderid = $row["ORDER_ID"];
			
				}
			}
			
			
			
			
			$get_order_id = "SELECT * FROM PIZZAS_ORDERED where ORDER_ID='".$oldorderid."'";
			$order_query = mysql_query($get_order_id);
			
			if (@mysql_num_rows($order_query) > 0) {
				// output data of each row
				while($row = mysql_fetch_assoc($order_query)) {
											
				$itemid=$row["ITEM_ID"];
				$baseid=$row["BASE_TYPE_ID"];
				//$toppingid=$row["ORDER_ID"];
			
				$q=$row["QUANTITY"];					
								
				$amount = $row["TOTAL_PIZZA_PRICE"];

				$pizza_query="INSERT INTO PIZZAS_ORDERED VALUES (NULL, '".$itemid."','".$neworderid."','".$baseid."','".$amount."','".$q."')";				
				mysql_query($pizza_query);
				

				$get_pizza_no = "SELECT * FROM PIZZAS_ORDERED WHERE ITEM_ID='".$itemid."' AND BASE_TYPE_ID='".$baseid."' AND ORDER_ID='".$neworderid."' ORDER BY PIZZA_SEQ_NO DESC LIMIT 1";
				$order_query = mysql_query($get_pizza_no);
				
				if (@mysql_num_rows($order_query) > 0) {
					// output data of each row
					while($row = mysql_fetch_assoc($order_query)) {
							
						$newpizza_seq_no = $row["PIZZA_SEQ_NO"];
							
					}
				}
				
				
				$get_pizza_no = "SELECT * FROM PIZZAS_ORDERED WHERE ITEM_ID='".$itemid."' AND BASE_TYPE_ID='".$baseid."' AND ORDER_ID='".$oldorderid."' ORDER BY PIZZA_SEQ_NO DESC LIMIT 1";
				$order_query = mysql_query($get_pizza_no);
				
				if (@mysql_num_rows($order_query) > 0) {
					// output data of each row
					while($row = mysql_fetch_assoc($order_query)) {
							
						$oldpizza_seq_no = $row["PIZZA_SEQ_NO"];
							
					}
				}
				

				
				
				$get_pizza_no = "SELECT * FROM PIZZA_TOPPINGS_MAPPING M WHERE M.PIZZA_SEQUENCE_NO='".$oldpizza_seq_no."'";
				$order_query = mysql_query($get_pizza_no);
				$toppingid="";
				
				if (@mysql_num_rows($order_query) > 0) {
					// output data of each row
					while($row = mysql_fetch_assoc($order_query)) {
							
						$toppingid = $toppingid.$row["TOPPING_ID"].",";
							
					}
				}
				
				$toppingid = substr($toppingid, 0,-1);
				
				$topping_array = split(",", $toppingid);
				
				for($k=0;$k<count($topping_array);$k++)
				{
					$topping_query = "INSERT INTO PIZZA_TOPPINGS_MAPPING VALUES ('".$newpizza_seq_no."','".$topping_array[$k]."')";
					mysql_query($topping_query);
				}
				
				
			}
			
		}
			
		}
		
		//PDF Creation and mailing
		
		/* $pdf = new PDF();		
		$pdf->AddPage();
		$pdf->SetFont('Arial','B',11);		
		$name="C:\\xampp\\htdocs\\OnlinePizzaSystem\\pdfs\\";
		$t=time();
		$filename=$name.$t.".pdf";		
		$destinationurl="F";
		
		$header = array('Serial No', 'Item Name', 'Base Description', 'Toppings','Price','Quantity','Amount');	
		
		$pdf->SetWidths(array(15,30,35,60,15,18,18));
		$pdf->Row($header);
		
		$pdf->SetWidths(array(15,30,35,60,15,18,18));
		$pdf->SetFont('Arial','',10);
		$max=count($_SESSION['cart']);
		for($i=0;$i<$max;$i++){
			$itemid=$_SESSION['cart'][$i]['itemid'];
			$baseid=$_SESSION['cart'][$i]['baseid'];
			$toppingid=$_SESSION['cart'][$i]['tid'];
		
			$q=$_SESSION['cart'][$i]['qty'];
			$itemname=get_item_name($itemid);
			$basename=get_base_name($baseid);
			$toppingname=get_topping_name($toppingid);
		
			$cost=get_pizza_price($baseid,$toppingid);
			$price="$ ".$cost;
			$amount = "$ ".$cost*$q;
			
			$data = array($i+1,$itemname,$basename,$toppingname,$price,$q,$amount);
			
			$pdf->Row($data);
			
		}
		
		$pdf->Ln();
		$pdf->SetWidths(array(100));
		$pdf->SetFont('Arial','B',11);
		
		
		$order_price="Total Order Price is : $ ".$sum;
		
		$data = array($order_price);
		
		$pdf->Row($data);
		
		$pdf->Output($filename,$destinationurl);
		echo $t;
		
		unset($_SESSION['cart']);
		unset($_SESSION['sum']); */
		
		$subject ="Your order summary" ;
		$body='Your Order with Order ID: '.$orderid.' has been placed. The order price is '.$sum.' . Thank you for shopping with us.';		
		mail($Email,$subject,$body);
		
	}
	
	catch (Exception $e) {
		echo $e;
		die($e);
	}
	
}



?>