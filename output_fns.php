<?php 

	// header
	function do_html_header($title){

		if (empty($_SESSION['items'])) {
			
			$_SESSION['items'] = '0';
		}
		if (empty($_SESSION['total_price'])) {

			$_SESSION['total_price'] = '0';

		}

		?>
		<!DOCTYPE html>
		<html lang="en">
		<head>
			<meta charset="UTF-8">
			<title><?php echo $title; ?></title>

			<meta name="viewport" content="width=device-width, initial-scale=1">
			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
			
		</head>
		<body>

			<?php
				navigation();
			?>

			<div class="container">
				
				<h1> <?php echo $title; ?> </h1>
		
		<?php
	}

	// footer
	 function do_html_footer(){
		?>
				</div>
				<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
				<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
			</body>
		</html>
		<?php
	}


	// navigation
	 function navigation(){

		?>
		<nav class="navbar navbar-inverse">
		  <div class="container-fluid">
		    <div class="navbar-header">
		      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span> 
		      </button>
		      <a class="navbar-brand" href="#">Thai</a>
		    </div>
		    <div class="collapse navbar-collapse" id="myNavbar">
		      <ul class="nav navbar-nav">
		        <li class="active"><a href="index.php">Home</a></li>
		        
		      </ul>
		      <ul class="nav navbar-nav navbar-right">
		    
		        <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
		        <li><a href="#"> <?php echo $_SESSION['total_price'] ;?> </a> </li>
		        <li><a href="show_cart.php"><span class="glyphicon glyphicon-cart"></span> <?php echo $_SESSION['items'] ;?> </a></li>
		        <li><a href="show_cart.php"><span class="glyphicon glyphicon-cart"></span> View Cart</a></li>
		      </ul>
		    </div>
		  </div>
		</nav>
		<?php
	}
	 function do_html_url($url,$title){
		?>

		<a href="<?php echo $url; ?>"><?php echo $title; ?></a>

		<?php
	}

	 function display_category($stmt){
		

				if($stmt->rowCount() == 0){
					echo "<p>No categories currently available</p>";
					return;
				}

				echo "<ul>";
				while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
					 extract($result);

					 $url =  "show_cat.php?catid=$id";
					 $title = $catname;
					 echo "<li>";
					 	do_html_url($url,$title);
					 echo "</li>";

				}
				echo "</ul>";
	
	}

	function display_books($stmt){
		
		if($stmt->rowCount() == 0){
			echo "<p>No books currently available</p>";
			return;
		}
		

			echo "<table class='table table-hover table-responsive table-bordered'>";
				echo "<tr>";
					echo "<th>Isbn</th>";	
					echo "<th>Author</th>";	
					echo "<th>Title</th>";	
					echo "<th>Category</th>";	
					echo "<th>Price</th>";
					echo "<th>Description</th>";
				echo "</tr>";

			 	while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
			 		extract($result);
			 		$url  =  "show_book.php?isbn=$isbn&catname=$catname";
			 		$title = $title;
			 		echo "<tr>";
			 		    echo "<td> $isbn </td>"; 
			 		    echo "<td> $author </td>"; 
			 		    echo "<td>";
			 		    	do_html_url($url,$title);
			 		    echo "</td>"; 
			 		    echo "<td> $catname </td>"; 
			 		    echo "<td> $price </td>"; 
			 		    echo "<td> $description </td>";
			 		  
			 		echo "</tr>";
			 		
			 	}
			        
			echo"</table>";

		
	}
	function display_book_details($book,$catname){
		extract($book);
 	
		?>
		<table class='table table-hover table-responsive table-bordered'>
			<tr>
				<th>Isbn</th>
				<th>Author</th>	
				<th>Title</th>	
				<th>Category</th>
				<th>Price</th>
				<th>Description</th>
			</tr>
		 		
	 		<tr>
	 		    <td> <?php echo $isbn;?> </td>
	 		    <td> <?php echo $author;?> </td>
	 		    <td> <?php echo $title ;?> </td>
	 		    <td> <?php echo $catname; ?> </td>
	 		    <td> <?php echo $price;?> </td>
	 		    <td> <?php echo $description;?> </td>
	 		  
	 		</tr>	 			 	
		       
		</table>
		<?php
	}

	function display_button($target,$tit,$title){
		?>

			<a class="btn btn-primary" href="<?php echo $target; ?>" title= "<?php echo $tit; ?>"><?php echo $title; ?></a>
		<?php
	}


	function display_cart($cart, $change = true, $images = 0){
		?>
			<table class="table table-hover table-responsive table-bordered">
				<form action="show_cart.php" method="post">
					<tr>
						<td>Item</td>
						<td>Price</td>
						<td>Quanity</td>
						<td>Total</td>
					</tr>
					<?php
						foreach ($cart as $isbn => $quanity) {
							$stmt =  $GLOBALS['book']->get_books_details($isbn);
							extract($stmt);
							?>
								<tr>
									<td> <?php echo $title; ?> </td>
									<td> <?php echo $price; ?> </td>
									<td>
										<?php
										if($change == true){
											?>
										<input type="number" min = "0" name="num" value="<?php echo $quanity; ?>">
											 <?php
										}else{
											echo $quanity;
										}
										
										?>
									</td>
									<td><?php echo number_format($price * $quanity,2); ?> </td>
								</tr>						

							<?php
						}

					?>
					<tr>
						<td></td>
						<td></td>
						<td> <?php echo $_SESSION['items'] ;?></td>
						<td> <?php echo $_SESSION['total_price'];?> </td>
					</tr>
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td>
					<?php

						if($change == true){
						?>
							<input type="submit" class="btn btn-danger" name="save" value="Save">
						<?php
					}

					?>
						</td>
					</tr>
				</form>
			</table>
		<?php

	}

	function display_checkout_form(){
		?>
		<h3>Your Detail</h3>
		<table  class="table table-hover table-responsive table-bordered">
		
			<form action="purchase.php" method="post">
				<tr>
					<th>Name</th>
					<td>
						<input class="form-control" type="text" name="name">
					</td>
				</tr>
				<tr>
					<th>Address</th>
					<td>
						<input class="form-control" type="text" name="address">
					</td>
				</tr>
				<tr>
					<th>City</th>
					<td>
						<input class="form-control" type="text" name="city">
					</td>
				</tr>
				<tr>
					<th>State/Province</th>
					<td>
						<input class="form-control" type="text" name="province">
					</td>
				</tr>
				<tr>
					<th>SDT</th>
					<td>
						<input class="form-control" type="text" name="phonenum">
					</td>
				</tr>
				<tr>
					<th>Country</th>
					<td>
						<input class="form-control" type="text" name="country">
					</td>
				</tr>
				<tr>
					<td>
						<h3>Shipping Address</h3>
					</td>
				</tr>
				<tr>
					<th>Name</th>
					<td>
						<input class="form-control" type="text" name="ship_name">
					</td>
				</tr>
				<tr>
					<th>Address</th>
					<td>
						<input class="form-control" type="text" name="ship_address">
					</td>
				</tr>
				<tr>
					<th>City</th>
					<td>
						<input class="form-control" type="text" name="ship_city">
					</td>
				</tr>
				<tr>
					<th>State/Province</th>
					<td>
						<input class="form-control" type="text" name="ship_province">
					</td>
				</tr>
				<tr>
					<th>SDT</th>
					<td>
						<input class="form-control" type="text" name="ship_phonenum">
					</td>
				</tr>
				<tr>
					<th>Country</th>
					<td>
						<input class="form-control" type="text" name="ship_country">
					</td>
				</tr>								
				<tr>
					<td></td>
					<td>
						<input class="btn btn-info" type="submit" value="Purchase">
					</td>
				</tr>
			</form>
		</table>
		<h3>Please press Purchase to confirm your purchase or Continue Shopping to Add or remove items.</h3>

			<?php
	}
	function display_shipping($ship_price){
		?>
			<table  class="table table-hover table-responsive table-bordered">
				<tr>
					<td>Shipping</td>
					<td><?php echo $ship_price; ?></td>
				</tr>
				<tr>
					<td>
						TOTAL INCLUDING SHIPPING
					</td>
					<td>
						<?php echo $_SESSION['total_price'] + $ship_price; ?>
					</td>
				</tr>
			</table>

		<?php
	}

	function display_card_form($name){
		echo "Cart form is here";
	}
 ?>