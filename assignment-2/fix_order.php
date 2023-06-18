<?php
    if (!isset($_GET['pro_name']) || !isset($_GET['pro_price']))
    {
        header("Location: index.php");
        die();
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Glory Furniture</title>
        <meta charset="UTF-8">
        <meta name="description" content="Fix Order Page">
        <meta name="keywords" content="HTML, CSS, JavaScript, PHP">
        <meta name="author" content="Quoc Anh Vu">
        <link rel="stylesheet" href="style/style.css">         
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    </head>      
    <body>
        <?php include_once 'includes/header.inc'; ?> 
        <!-- Adding Javascript for the product details -->
       <script type="text/javascript">
            jQuery(document).ready(function($){
                $('#proQuantity').change(function(){
                    var pro_price = $('#proPrice').val();
                    var pro_quantity = $(this).val();
                    var pro_total = parseFloat(pro_price * pro_quantity);
                    $('#proTotal').html(" = " + pro_total + "$.");
                    $('#proTotall').attr('value', pro_total);
                });
            });
       </script>
       <main id="payment">            
            <div class="container">
                <form id="regform" method="post" action="process_order.php" novalidate>
					<!-- First Name -->
                    <div class="user-box">
                        <?php
                            echo '<input class="inputAnimation" id="firstName" type="text" name="firstName" required pattern="[\s\S]*" value="',$_GET['firstname'],'" title="Maximum alphabetical characters is 25">';
                            echo '<label class="labelAnimation" for="firstName">First name</label>';                                                  
                            if (isset($_GET['firstname_err']))
								echo '<div class="error-mess" id="firstName-err">', $_GET['firstname_err'], '</div>';
                        ?>
                    </div>
                      
					<!-- Last Name -->  
                    <div class="user-box">
						<?php
                            echo '<input class="inputAnimation" id="lastName" type="text" name="lastName" required pattern="[\s\S]*" value="',$_GET['lastname'],'" title="Maximum alphabetical characters is 25">';
                            echo '<label class="labelAnimation" for="lastName">Last name</label>';                                                  
                            if (isset($_GET['lastname_err']))
								echo '<div class="error-mess" id="lastName-err">', $_GET['lastname_err'], '</div>';
                        ?>
                    </div>
					
					<!-- Email -->
                    <div class="user-box">
						<?php
                            echo '<input class="inputAnimation" id="UserEmail" type="text" name="UserEmail" required pattern="[\s\S]*" value="',$_GET['email'],'" title="The input must match the email format">';
                            echo '<label class="labelAnimation" for="UserEmail">Email</label>';                                                  
                            if (isset($_GET['email_err']))
								echo '<div class="error-mess" id="userEmail-err">', $_GET['email_err'], '</div>';
                        ?>
                    </div>
                    
					<!-- Address -->
                    <fieldset>
                        <legend>Address</legend>
						<!-- Street -->
                        <div class="user-box address">
						<?php
                            echo '<input class="inputAnimation" id="StreetAddress" type="text" name="StreetAdd" required pattern="[\s\S]*" value="',$_GET['address'],'" title="Maximum characters is 40">';
                            echo '<label class="labelAnimation" for="StreetAddress">Street Address</label>';                                                  
                            if (isset($_GET['address_err']))
								echo '<div class="error-mess" id="address-err">', $_GET['address_err'], '</div>';
                        ?>
                        </div>
    
						<!-- Suburb -->
                        <div class="user-box">
							<?php
								echo '<input class="inputAnimation" id="town" type="text" name="Town/Suburb" required pattern="[\s\S]*" value="',$_GET['town'],'" title="Maximum characters is 25">';
								echo '<label class="labelAnimation" for="town">Suburb</label>';                                                  
								if (isset($_GET['town_err']))
									echo '<div class="error-mess" id="town-err">', $_GET['town_err'], '</div>';
							?>
                        </div>
    
						<!-- Postcode -->
                        <div class="user-box">
							<?php
								echo '<input class="inputAnimation" id="postCodeID" type="number" name="postCode" required pattern="[\s\S]*" value="',$_GET['postcode'],'" title="The postcode contains exactly 4 digits">';
								echo '<label class="labelAnimation" for="postCodeID">Your postcode</label>';                                                  
								if (isset($_GET['postcode_err']))
									echo '<div class="error-mess" id="postCode-err">', $_GET['postcode_err'], '</div>';
							?>
                        </div>
						
						<!-- State | Use a foreach loop to compare each option with $_GET['state'].
						If they are the same, add *selected* attribute to the option -->
                        <div class="user-select-box">
							<?php
								echo '<label class="selectLabelAnimation" for="UserState" id="labelState">State</label>&nbsp;';
								echo '<select class="selectAnimation" name="state" id="UserState" required>';
								$states = array('VIC', 'NSW', 'QLD', 'ND', 'WA', 'SA', 'TAS', 'ACT');
								
								if ($_GET['state'] == '') {
									echo '<option value="" selected>Choose your state</option>';
								} else
									echo '<option value="">Choose your state</option>';
								
								foreach ($states as $state) {
									if ($state == $_GET['state'])
										echo '<option value="',$state,'" selected>',$state,'</option>';
									else
										echo '<option value="',$state,'">',$state,'</option>';
								}
								echo '</select>';	
								if ($_GET['state_err'] != "")
									echo '<div class="error-mess" id="state-err">', $_GET['state_err'], '</div>';
							?>
                        </div>
                    </fieldset>
					
					<!-- Phone number -->
                    <div class="user-box">
						<?php
							echo '<input class="inputAnimation" id="phoneNum" type="number" name="phoneNum" required pattern="[\s\S]*" value="',$_GET['phonenum'],'" title="Maximum of digits is 10">';
							echo '<label class="labelAnimation" for="phoneNum">Phone number</label>';                                                  
							if (isset($_GET['phonenum_err']))
							echo '<div class="error-mess" id="phoneNum-err">', $_GET['phonenum_err'], '</div>';
						?>
                    </div>
            
					<!-- Prefered contact | Use a foreach loop to compare each option with $_GET['contact'].
					If they are the same, add *checked* attribute to the option -->
                    <div class="user-box contact">
                        <p>Prefered contact</p>                       						
						<?php						
							$contacts = array('Email', 'Post', 'Number');
							
							foreach ($contacts as $contact) {
								if ($_GET['contact'] == $contact) {
									echo '<input id="', $contact, '" type="radio" name="contact" value="', $contact, '" checked required>';
									echo '<label for="', $contact, '">', $contact, '</label>';
								} else {
									echo '<input id="', $contact, '" type="radio" name="contact" value="', $contact, '" required>';
									echo '<label for="', $contact, '">', $contact, '</label>';
								}
							}							
							if ($_GET['contact_err'] != "")
								echo '<div class="error-mess" id="contact_err">', $_GET['contact_err'], '</div>';
						?>
                    </div>

					<!-- Credit card information -->
                    <fieldset>
                        <legend>Credit card payment</legend>
						
						<!-- Credit card type -->
                        <div class="user-select-box">							
                        <label class="selectLabelAnimation" for="card_type" >Credit card type</label>
                            <select class="selectAnimation" name="card_type" id="card_type" required>
                                <option value="">Choose your card</option>
                                <option value="Visa">Visa</option>
                                <option value="Mastercard">Mastercard</option>
                                <option value="American Express">American Express</option>
                            </select>
                            <?php
								if ($_GET['cardtype_err'] != "")
									echo '<div class="error-mess" id="cardtype_err">', $_GET['cardtype_err'], '</div>';
							?>
                        </div>
						
						<!-- Name on credit card -->
                        <div class="user-box address">
                            <input class="inputAnimation" id="name_cc" type="text" name="name_cc" required pattern="[\s\S]*" title="Maximum characters is 40">
                            <label class="labelAnimation" for="name_cc">Name on credit card</label>
                            <?php								                                        
								if (isset($_GET['cardname_err']))
								echo '<div class="error-mess" id="cardName-err">', $_GET['cardname_err'], '</div>';
							?>
                        </div>
    
						<!-- Credit card number -->
                        <div class="user-box">
                            <input class="inputAnimation" id="number_cc" type="number" name="number_cc" required pattern="[\s\S]*" title="Maximum characters for Visa and Mastercard is 16, for American Express is 15">
                            <label class="labelAnimation" for="number_cc">Credit card number</label>
                            <?php								                                            
								if (isset($_GET['cardnum_err']))
								echo '<div class="error-mess" id="cardNum-err">', $_GET['cardnum_err'], '</div>';
							?>
                        </div>
    
						<!-- Credit card expiry date (mm/yy) -->
                        <div class="user-box">
                            <input class="inputAnimation" id="ex_date_cc" type="text" name="ex_date_cc" required pattern="[\s\S]*" title="Format: dd/mm/yyyy">
                            <label class="labelAnimation" for="ex_date_cc">Credit card expiry date &lpar;mm/yy&rpar;</label>
                            <?php								                                          
								if (isset($_GET['expirydate_err']))
								echo '<div class="error-mess" id="expiryDate-err">', $_GET['expirydate_err'], '</div>';
							?>
                        </div>

						<!-- CVV -->
                        <div class="user-box">                         
                            <input class="inputAnimation" id="cvv_cc" type="number" name="cvv_cc" required pattern="[0-9]{4}" title="The postcode contains exactly 4 digits">
                            <label class="labelAnimation" for="cvv_cc">CVV</label>
                            <?php								                                             
								if (isset($_GET['cvv_err']))
								echo '<div class="error-mess" id="cvv-err">', $_GET['cvv_err'], '</div>';
							?>
                        </div>

                        
                    </fieldset>

                    <div class="user-box enquire">
                        <!-- <label for="proEnq">Product Enquiring</label>
                        <select name="product" id="proEnq" required>
                            <option value="">Choose your product</option>
                            <option value="Table" data=10>Table</option>
                            <option value="Chair" data=20>Chair</option>
                            <option value="Other" data=300>Other...</option>
                        </select> -->
						
						<!-- Calculate the total price -->
                        <h3>Product details</h3>
                        <?php
                            $pro_name = $_GET['pro_name'];
                            $pro_price = $_GET['pro_price'];
                            $pro_quantity = $_GET['pro_quantity'];
                            $pro_total = $_GET['pro_total'];
                            $pro_deets = "$pro_name: $pro_price$ x ";
                            echo "<span id='proDetails'>".$pro_deets."</span>";
                            echo "<input id='proPrice' type='hidden' name='pro_price' value=".$pro_price.">"
                        ?>
                        <input id="proQuantity" type="number" name="pro_quantity" min=1 value=<?php echo $pro_quantity?>>
                        <span id="proTotal"><?php echo " = ".$pro_total."$."?></span>
                        
                        <!-- Product POST data (except quantity) -->
                        <input id="proName" type="hidden" name="pro_name" value=<?php echo $pro_name?>>
                        <input id="proTotall" type="hidden" name="pro_total" value=<?php echo $pro_total?>>
                        <br>
                    </div>
					
					<!-- Customer's comment -->
                    <?php 
                        echo '<textarea name="comment" id="commendField" cols="50" rows="10" placeholder="Specify particular aspect you are interested in...">', $_GET['comment'],'</textarea>';
                    ?>                  

                    <div class="buttoninput">
                        <input type="submit" value="Checkout">
                    </div>
                </form>
            </div>
       </main>

        
       <?php include_once 'includes/footer.inc'; ?>
    </body>
</html>
                      
                    