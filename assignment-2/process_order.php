<?php   
    if (!isset($_POST["firstName"])) { //prevent direct access from URL
        header("Location: index.php");
        die();
    }
    function sanitise_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }   
   
    //an array to store user input
    //personal info
    $input['firstname'] = $firstname = sanitise_input($_POST["firstName"]);
    $input['lastname'] = $lastname = sanitise_input($_POST["lastName"]);
    $input['email'] = $email = sanitise_input($_POST["UserEmail"]);
    //address
    $input['address'] = $address = sanitise_input($_POST["StreetAdd"]);
    $input['town'] = $town = sanitise_input($_POST["Town/Suburb"]);
    $input['postcode'] = $postcode = sanitise_input($_POST["postCode"]);
    $input['state'] = $state = sanitise_input($_POST["state"]);    
    //contact
    $input['phonenum'] = $phonenum = sanitise_input($_POST["phoneNum"]);
    if (isset($_POST["contact"])) { //check_contact_box_input
        $contact = $_POST["contact"];
    }
    else $contact = "";
    $input['contact'] = $contact = sanitise_input($contact);
    //product 
    $input['pro_name'] = $proname = sanitise_input($_POST["pro_name"]);
    $input['pro_price'] = $proprice = sanitise_input($_POST["pro_price"]);
    $input['pro_quantity'] = $proquantity = sanitise_input($_POST["pro_quantity"]);
    $input['pro_total'] = $totalcost = sanitise_input($_POST["pro_total"]);
    //credit card
    $input['cardtype'] = $cardtype = sanitise_input($_POST["card_type"]);
    $input['cardname'] = $cardname = sanitise_input($_POST["name_cc"]);  
    $input['cardnum'] = $cardnum = sanitise_input($_POST["number_cc"]);
    $input['expirydate'] = $expirydate = sanitise_input($_POST["ex_date_cc"]);
    $input['cvv'] = $cvv = sanitise_input($_POST["cvv_cc"]);
    $input['comment'] = $comment = sanitise_input($_POST["comment"]);
    
    //validation     
    function input_validation($data, $validation_rule, $err_mess) {
        if ($data == "") {
            return "This field must not be empty"; //if input is empty, return empty-error message
        }
        else if ($validation_rule != "") { //for data having pattern to check against
            if (!preg_match($validation_rule, $data))           
                return $err_mess; //if input violates pattern, return wrong format message          
        } 
        else return ""; //if no error, return empty string
    } 
    //an array that stores error message of the fields
    $validation['firstname_err'] = input_validation($input['firstname'], "/^[a-zA-Z]{1,25}$/", "First name must contain less than 26 letters.");
    $validation['lastname_err'] = input_validation($input['lastname'], "/^[a-zA-Z]{1,25}$/", "Last name must contain less than 26 letters.");
    $validation['email_err'] = input_validation($input['email'], "/^[^\s@]+@[^\s@]+\.[^\s@]+$/", "Invalid email format");
    $validation['address_err'] = input_validation($input['address'], "/^.{1,40}$/", "Address must contain less than 41 characters.");
    $validation['town_err'] = input_validation($input['town'], "/^.{1,25}$/", "Town must contains less than 26 characters");
    $validation['postcode_err'] = input_validation($input['postcode'], "/^[0-9]{4}$/", "Post code must contain exactly 4 digits.");
    $validation['state_err'] = input_validation($input['state'], "", ""); //state has no pattern to check
    $validation['phonenum_err'] = input_validation($input['phonenum'], "/^[0-9]{1,10}$/", "Phone number must contain less than 11 digits.");
    $validation['contact_err'] = input_validation($input['contact'], "", "");//contact has no pattern to check   
    $validation['cardtype_err'] = input_validation($input['cardtype'], "", "");//cardtype has no pattern to check
    $validation['cardname_err'] = input_validation($input['cardname'], "/^[a-zA-Z]{1,40}$/", "Name on card must contain less than 41 letters.");    
    switch ($cardtype) { // cardnum is validated depending on cardtype
        case "":
            $validation['cardnum_err'] = "Choose your card type first";
            break;
        case "Visa":
            $validation['cardnum_err'] = input_validation($input['cardnum'], "/^4[0-9]{15}$/", "$cardtype must contain 16 digits and start with number 4.");
            break;
        case "Mastercard":
            $validation['cardnum_err'] = input_validation($input['cardnum'], "/^(5[1-5])[0-9]{14}$/", "$cardtype must contain 16 digits and start with digits 51 through to 55.");
            break; 
        case "American Express":
            $validation['cardnum_err'] = input_validation($input['cardnum'], "/^(34|37)[0-9]{13}$/", "$cardtype must contain 15 digits and starts with 34 or 37.");
            break;        
    }
    $validation['expirydate_err'] = input_validation($input['expirydate'], "/^(0[1-9]|1[0-2])\/[0-9]{2}$/", "Invalid date format.");
    $validation['cvv_err'] = input_validation($input['cvv'], "/^[0-9]{4}$/", "CVV must contain exactly 4 digits.");
    
    $validation_check = true; //record whether the order is valid or not
    foreach ($validation as $message) {
        if ($message != "") {
            $validation = http_build_query($validation); //convert array into query string for URL 
            $input = http_build_query($input);
            header("Location: fix_order.php?$input&$validation");
            $validation_check = false;
            break;
        }    
    }
    
    //database
    if ($validation_check) { //if validation_check is false, order won't be added to database
        require_once ("settings.php");
        $conn = @mysqli_connect($host, $user, $pwd, $sql_db);
        if (!$conn) {
            echo "<p>Something wrong happened, please try again later</p>";
        } else {
            $sql_table = "orders";
            $query = "CREATE TABLE IF NOT EXISTS $sql_table (
                                                order_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                                                order_time DATETIME NOT NULL, 
                                                order_status VARCHAR(10) NOT NULL,                                              
                                                firstname VARCHAR(25) NOT NULL,      
                                                lastname VARCHAR(25) NOT NULL,
                                                email VARCHAR(100) NOT NULL,
                                                address VARCHAR(40) NOT NULL,
                                                town VARCHAR(25) NOT NULL,
                                                postcode INT(4) UNSIGNED NOT NULL,
                                                state VARCHAR(10) NOT NULL,
                                                phonenum BIGINT(10) NOT NULL,
                                                contact VARCHAR(10) NOT NULL,
                                                product_name VARCHAR(50) NOT NULL,
                                                product_quantity INT NOT NULL,
                                                total_cost DOUBLE(10,2) NOT NULL,
                                                cardtype VARCHAR(20) NOT NULL,
                                                cardname VARCHAR(40) NOT NULL,
                                                cardnum BIGINT(16) NOT NULL,
                                                expirydate VARCHAR(10),
                                                cvv INT(4) UNSIGNED NOT NULL,
                                                comment TEXT )";
            $result = mysqli_query($conn, $query);
            $query = "INSERT INTO orders (order_time, 
                                          order_status, 
                                          firstname, 
                                          lastname, 
                                          email, 
                                          address, 
                                          town, 
                                          postcode, 
                                          state, 
                                          phonenum, 
                                          contact, 
                                          product_name, 
                                          product_quantity, 
                                          total_cost, 
                                          cardtype, 
                                          cardname, 
                                          cardnum, 
                                          expirydate, 
                                          cvv, 
                                          comment)
                                 VALUES (NOW(), 
                                        'PENDING', 
                                        '$firstname', 
                                        '$lastname', 
                                        '$email', 
                                        '$address', 
                                        '$town', 
                                        '$postcode', 
                                        '$state', 
                                        '$phonenum', 
                                        '$contact', 
                                        '$proname', 
                                        '$proquantity', 
                                        '$totalcost', 
                                        '$cardtype', 
                                        '$cardname', 
                                        '$cardnum', 
                                        '$expirydate', 
                                        '$cvv', 
                                        '$comment')";
            $result = mysqli_query($conn, $query);

            $query = "SELECT order_id, order_time, order_status FROM orders WHERE order_id = (SELECT MAX(order_id) FROM orders)";//query order id, time and status
            $result = mysqli_query($conn, $query);           
            $row = mysqli_fetch_assoc($result);
            $order_id = $row["order_id"];//get order id from record
            $order_time = $row["order_time"]; //get order time from record
            $order_status = $row["order_status"];//get order status from record
            $input = http_build_query($input); //convert array into query string for URL 
            header("Location: receipt.php?order_id=$order_id&order_time=$order_time&order_status=$order_status&$input");                                   
            mysqli_close($conn);
        }
    }   
?>