<?php
	if (!isset($_GET["firstname"])) { //prevent direct access from URL
        header("Location: index.php");
        die();
    }
?>
<!DOCTYPE html>
<html lang="en">
	<head>
        <title>Glory Furniture</title>
        <meta charset="UTF-8">
        <meta name="description" content="Receipt Page">
        <meta name="keywords" content="HTML, CSS, PHP">
        <meta name="author" content="Quoc Anh Vu">
        <link rel="stylesheet" href="style/style.css">  
		<link rel="stylesheet" href="style/receipt.css"> 
    </head>	
	<body>
		<?php include_once 'includes/header.inc'; ?>
		<main id="receipt">
			<div class="container">
				<h1 id="confirmedMessageHeader">Your order is confirmed!</h1>
				<hr>
				<div id="detailsContainer">
					<!-- Customer Information: Name, Phone Number, Postcode, Email, Prefered Contact -->
					<div id="cusInfo">
						<?php
							echo '<h2>Customer Information</h2>';
							echo '<p>', $_GET['firstname'], ' ', $_GET['lastname'], '</p>';
							
							echo '<p><strong>Phone Number</strong>';
							echo '<br>';
							echo $_GET['phonenum'], '</p>';
							
							echo '<p><strong>Postcode</strong>';
							echo '<br>';
							echo $_GET['postcode'], '</p>';
							
							echo '<p><strong>Email</strong>';
							echo '<br>';
							echo '<a href="mailto:', $_GET['email'], '">', $_GET['email'], '</a><br></p>';
							
							echo '<p><strong>Prefered Contact</strong>';
							echo '<br>';
							echo $_GET['contact'], '</p>';
						?>
					</div>
					
					<!-- Shipping Details: Address, Credit Card Information -->
					<div id="shippingDetails">
						<?php
							echo '<h2>Shipping details</h2>';
							echo '<p><strong>Address</strong><br>';
							echo $_GET['address'], '<br>';
							echo $_GET['town'], ', ', $_GET['state'], '</p>';
							
							echo '<p><strong>Payment via</strong>';
							echo '<br>';
							
							echo $_GET['cardtype'];
							if ($_GET['cardtype'] == 'American Express')
								echo ' (***************)';
							else
								echo ' (****************)';
							echo '<br>';
							
							echo 'Name on card: ', $_GET['cardname'];
							echo '<br>';
							
							echo 'Expiry date: ', $_GET['expirydate'];
							echo '<br>';
							
							echo 'CVV: ****';
							echo '</p>';
						?>
					</div>
				</div>
				<hr>
				
				<!-- Product List Table: Order ID, Order Time, Order Status, Product Name, Price, Quantity, Total Price -->
				<div id="productList">
					<?php
						echo '<h2>Product List</h2>';
						
						echo "<table id=\"productTable\">\n
							<tr>\n
								<th id=\"productTableIDColumn\">Order ID</th>\n
								<th id=\"productTableOrderTimeColumn\">Order Time</th>\n
								<th id=\"productTableOrderStatusColumn\">Order Status</th>\n
								<th id=\"productTableProductColumn\">Product Name</th>\n
								<th id=\"productTablePriceColumn\">Price</th>\n
								<th id=\"productTableQuantityColumn\">Quantity</th>\n
								<th id=\"productTableTotalColumn\">Total</th>\n
							</tr>\n
							
							<tr>\n
								<td>", $_GET['order_id'], "</td>\n
								<td>", $_GET['order_time'], "</td>\n
								<td>", $_GET['order_status'], "</td>\n
								<td>", $_GET['pro_name'], "</td>\n
								<td>$", $_GET['pro_price'], "</td>\n
								<td>", $_GET['pro_quantity'], "</td>\n
								<td>$", $_GET['pro_total'], "</td>\n
							</tr>\n
							</table>\n"
					?>
				</div>
				<br><hr>
				
				<!-- Customer's comment -->
				<?php
					echo '<h3>Comments</h3>';
					if (!empty($_GET['comment']))
						echo '<p id="receiptComment">', $_GET['comment'], '</p>';
					else
						echo '<p id="receiptComment">There is no comment.</p>';
				?>
				
			</div>
		</main>
		
		<?php include_once 'includes/footer.inc'; ?>
	</body>
</html>