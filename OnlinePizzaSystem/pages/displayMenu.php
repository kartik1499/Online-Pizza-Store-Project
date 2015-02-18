<html>
<head>

<link rel="stylesheet" href="/OnlinePizzaSystem/css/style.css" type="text/css" media="screen" />
<link rel="stylesheet" href="/OnlinePizzaSystem/css/selectric.css" type="text/css" media="screen" />
<link rel="stylesheet" href="/OnlinePizzaSystem/css/slide.css" type="text/css" media="screen" />
<link rel="stylesheet" href="/OnlinePizzaSystem/css/polaris.css" type="text/css" media="screen" />
<link rel="stylesheet" href="/OnlinePizzaSystem/css/display.css" type="text/css" media="screen" />

<script src="/OnlinePizzaSystem/js/jquery.min.js"></script>
<script src="/OnlinePizzaSystem/js/slide.js" type="text/javascript"></script>
<script src="/OnlinePizzaSystem/js/jquery.selectric.js" type="text/javascript"></script>
<script src="/OnlinePizzaSystem/js/jquery.selectric.placeholder.js" type="text/javascript"></script>
<script src="/OnlinePizzaSystem/js/displayMenu.js" type="text/javascript"></script>
<script src="/OnlinePizzaSystem/js/icheck.js" type="text/javascript"></script>

<!-- Sliding effect -->
	
	
	
	<script type="text/javascript" src="/OnlinePizzaSystem/js/jssor.js"></script>
    <script type="text/javascript" src="/OnlinePizzaSystem/js/jssor.slider.js"></script>
    
    <title>
    MenuPage
    </title>
</head>

<body>
	
		<div id="fade"></div>
        <div id="modal">
            <img id="loader" src="/OnlinePizzaSystem/images/loading.gif" />
        </div>
        
		<?php
			session_start();
			require 'database.php';
			include 'LoginSlider.php';
		?>
		
		
	
	
	
		<div id="slider1_container" style="position: relative; display:none; top: 0px; left: 0px; width: 1400px; height: 750px; overflow: hidden; ">

        

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
    <a style="text-decoration: underline;color: blue" href="index.php"><h2>Home</h2></a>

    <br />
		
		<h2>Our Menu :</h2>
		<br />
		
		<form name="displayMenu" id="display" action="shoppingCart.php" method="post">
		<div id="dropdown">
		<h3>Select a category :</h3>
		<br />
		<select id="category" name="category">
			<option value="">--Select a category--</option>
			<?php 
			$query = "SELECT * FROM CATEGORIES_MASTER";
			
			$result_data = mysql_query($query);
			
			if(mysql_num_rows($result_data))
			{
				while($row = mysql_fetch_assoc($result_data)) {
			
					?><option value="<?php echo $row['CATEGORY_ID']?>"><?php echo $row['CATEGORY_DESCRIPTION']?></option><?php 	
				}
			}
			?>
			
		</select>
		
		</div>
		<br />
		<div id="softDrinkItems" style="display: none">
		<h3>Select an item :</h3>
		<br />
		<select id="softitems">
		</select>
		</div>
		
		
		<br />
		
		
		
		<div id="dropdownPizzaItems" style="display: none">
		<h3>Select an item :</h3>
		<br />
		<select id="items">
		</select>
		</div>
		
		<br />
		<div id="dropdownPizzaBaseItems" style="display: none">
		<h3>Select a Base for your Pizza :</h3>
		<br />
		<select id="baseItems">
		</select>
		</div>
		
		
		<br />
	 
		
		<div id="dropdownPizzaToppingItems" style="display: none">
		<h3>Add extra toppings for your Pizza :</h3>
		<br />		
		</div>
	
		<br />
		<input type="hidden" id="toppingsCount" value="0">
		
		
		
		<br />
		 
		 <div id="price" style="display: none">
		 <h4>Item Price : </h4>
		 <label id="itemPrice"></label>
		 </div>
		
		
		<input type="submit" value="Add To Cart" id="addCart" class="btn">
		<input type="hidden" name="categorySelected" id="categorySelected" value="" />
		<input type="hidden" name="itemSelected" id="itemSelected" value="" />
		<input type="hidden" name="baseSelected" id="baseSelected" value="" />
		<input type="hidden" name="toppingsSelected" id="toppingsSelected" value="" />
		<input type="hidden" name="command" id="command" value="add" />
		
		</form>
		</div>
		</div>
		
		</body>

</html>