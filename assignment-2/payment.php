<?php
    if (!isset($_GET['pro_name']) || !isset($_GET['pro_price']))
    {
        header("Location: product.php");
        die();
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Glory Furniture</title>
        <meta charset="UTF-8">
        <meta name="description" content="Creating Web Applications">
        <meta name="keywords" content="HTML, CSS, JavaScript">
        <meta name="author" content="Thanh Tam Vo">
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
                    <div class="user-box">
                        <input class="inputAnimation" id="firstName" type="text" name="firstName" required pattern="[\s\S]*" title="Maximum alphabetical characters is 25">
                        <label class="labelAnimation" for="firstName">First name</label>
                    </div>
                      
                    <div class="user-box">
                        <input class="inputAnimation" id="lastName" type="text" name="lastName" required pattern="[\s\S]*" title="Maximum alphabetical characters is 25">
                        <label class="labelAnimation" for="lastName">Last Name</label>
                    </div>
            
                    <div class="user-box">
                        <input class="inputAnimation" id="UserEmail" type="text" name="UserEmail" required pattern="[\s\S]*" title="The input must match the email format">
                        <label class="labelAnimation" for="UserEmail">Email</label>
                    </div>
                    
                    <fieldset>
                        <legend>Address</legend>
                        <div class="user-box address">
                            <input class="inputAnimation" id="StreetAddress" type="text" name="StreetAdd" required pattern="[\s\S]*" title="Maximum characters is 40">
                            <label class="labelAnimation" for="StreetAddress">Street Address</label>
                        </div>
    
                        <div class="user-box">
                            <input class="inputAnimation" id="town" type="text" name="Town/Suburb" required pattern="[\s\S]*" title="Maximum characters is 25">
                            <label class="labelAnimation" for="town">Suburb</label>
                        </div>
    
                        <div class="user-box">
                            <input class="inputAnimation" id="postCodeID" type="number" name="postCode" required pattern="[\s\S]*" title="The postcode contains exactly 4 digits">
                            <label class="labelAnimation" for="postCodeID">Your postcode</label>
                        </div>

                        <div class="user-select-box">
                            <label class="selectLabelAnimation" for="UserState" id="labelState">State</label>
                            <select class="selectAnimation" name="state" id="UserState" required>
                                <option value="">Choose your state</option>
                                <option value="VIC">VIC</option>
                                <option value="NSW">NSW</option>
                                <option value="QLD">QLD</option>
                                <option value="ND">ND</option>
                                <option value="WA">WA</option>
                                <option value="SA">SA</option>
                                <option value="TAS">TAS</option>
                                <option value="ACT">ACT</option>
                            </select>
                        </div>
                    </fieldset>
    
                    <div class="user-box">
                        <input class="inputAnimation" id="phoneNum" type="number" name="phoneNum" required pattern="[\s\S]*" title="Maximum of digits is 10">
                        <label class="labelAnimation" for="phoneNum">Phone number</label>
                    </div>
            
                    <div class="user-box contact">
                        <p>Prefered contact</p>
                        <input id="email" type="radio" name="contact" value="Email" required>
                        <label for="email">Email</label>
                        <input id="post" type="radio" name="contact" value="Post" required>
                        <label for="post">Post</label>
                        <input id="number" type="radio" name="contact" value="Number" required>
                        <label for="number">Number</label>
                    </div>

                    <fieldset>
                        <legend>Credit card payment</legend>

                        <div class="user-select-box">
                            <label class="selectLabelAnimation" for="card_type" >Credit card type</label>
                            <select class="selectAnimation" name="card_type" id="card_type" required>
                                <option value="">Choose your card</option>
                                <option value="Visa">Visa</option>
                                <option value="Mastercard">Mastercard</option>
                                <option value="American Express">American Express</option>
                            </select>
                        </div>

                        <div class="user-box address">
                            <input class="inputAnimation" id="name_cc" type="text" name="name_cc" required pattern="[\s\S]*" title="Maximum characters is 40">
                            <label class="labelAnimation" for="name_cc">Name on credit card</label>
                        </div>
    
                        <div class="user-box">
                            <input class="inputAnimation" id="number_cc" type="number" name="number_cc" required pattern="[\s\S]*" title="Maximum characters for Visa and Mastercard is 16, for American Express is 15">
                            <label class="labelAnimation" for="number_cc">Credit card number</label>
                        </div>
    
                        <div class="user-box">
                            <input class="inputAnimation" id="ex_date_cc" type="text" name="ex_date_cc" required pattern="[\s\S]*" title="Format: dd/mm/yyyy">
                            <label class="labelAnimation" for="ex_date_cc">Credit card expiry date &lpar;mm/yy&rpar;</label>
                        </div>

                        <div class="user-box">
                            <input class="inputAnimation" id="cvv_cc" type="number" name="cvv_cc" required pattern="[0-9]{4}" title="The postcode contains exactly 4 digits">
                            <label class="labelAnimation" for="cvv_cc">CVV</label>
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
                        <h3>Product details</h3>
                        <?php
                            $pro_name = $_GET['pro_name'];
                            $pro_price = $_GET['pro_price'];

                            $pro_deets = "$pro_name: $pro_price$ x ";
                            echo "<span id='proDetails'>".$pro_deets."</span>";
                            echo "<input id='proPrice' type='hidden' name='pro_price' value=".$pro_price.">"
                        ?>
                        <input id="proQuantity" type="number" name="pro_quantity" min=1 value="1">
                        <span id="proTotal"><?php echo " = ".$pro_price."$."?></span>
                        
                        <!-- Product POST data (except quantity) -->
                        <input id="proName" type="hidden" name="pro_name" value=<?php echo $pro_name?>>
                        <input id="proTotall" type="hidden" name="pro_total" value=<?php echo $pro_price?>>
                        <br>
                    </div>

                    <textarea name="comment" id="commendField" cols="50" rows="10" placeholder="Specify particular aspect you are interested in..."></textarea>

                    <div class="buttoninput">
                        <input type="submit" value="Checkout">
                    </div>
                </form>
            </div>
       </main>

        
       <?php include_once 'includes/footer.inc'; ?>
    </body>
</html>