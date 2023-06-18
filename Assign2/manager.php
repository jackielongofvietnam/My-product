<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Managing</title>
<meta charset="utf-8">
<meta name="description" content="Assignment 2">
<meta name="keywords" content="PHP, File, input, output">
<link rel="stylesheet" href="./style/manager.css">
<link rel="stylesheet" href="style/style.css">
</head>
<body>
    <?php include_once 'includes/header.inc'; ?> 
    <?php
        //security
        function sanitise_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
       
        //connect to the database
        require_once("settings.php");  //connect info
        $conn = @mysqli_connect($host, $user, $pwd, $sql_db);
        //successful
        $sql_table = "orders";
        //SQL selects all products

        $query = "SELECT * FROM $sql_table";
        $distictProductQuery = "SELECT DISTINCT product_name FROM $sql_table";
        //executing SQL query
        $result = mysqli_query($conn, $query);
        $productResult = mysqli_query($conn, $distictProductQuery);

        //check if the connection successful
        if (!$result){
            echo "<p>Something wrong with ", $query, "</p>";
            exit();
        }
    ?>

	<form method="post" action="manager.php">
        <div id="searchOptionsContainer">
            <div class="formGroup">
                <label for="firstName">Customer first name: </label>
                <input type="text" name="firstName" id="firstName">
            </div>

            <div class="formGroup">
                <label for="lastName">Customer last name: </label>
                <input type="text" name="lastName" id="lastName">
            </div>


            <div class="formGroup">
                <label for="prod">Product:</label>
                <select name="prod" id="prod">
                    <option value="" selected>ALL</option>
                    <?php
                        while ($row = mysqli_fetch_assoc($productResult)) {
                            echo "<option value=\"", $row["product_name"],"\">",$row["product_name"] ,"</option>";
                        }
                    ?>
                </select>
            </div>

            <div class="formGroup">
                <label for="status">Status:</label>
                <select name="status" id="status">
                    <option value="" selected>ALL</option>
                    <option value="PENDING">PENDING</option>
                    <option value="FULFILLED">FULFILLED</option>
                    <option value="PAID">PAID</option>
                    <option value="ARCHIVED">ARCHIVED</option>
                </select>
            </div>

            <div class="formGroup">
                <label for="sort">Sort by: </label>
                <select name="sort" id="sort">
                    <option value="DESC" selected>Descending in cost</option>
                    <option value="ASC">Ascending in cost</option>
                </select>
            </div>

            <input class='confirmButton' type="submit" value="Search">
        </div>
	</form>

    <?php
        $sql_table = "orders";
        if (isset($_POST['status'])) {
            $status = sanitise_input($_POST['status']);
        }        
        if (isset($_POST['firstName'])) {
            $fname = sanitise_input($_POST['firstName']);
        }
        if (isset($_POST['lastName'])) {
            $lastName = sanitise_input($_POST['lastName']);
        }
        if (isset($_POST['sort'])) {
            $sort = sanitise_input($_POST['sort']);
        }
        else $sort = "DESC";
        if (isset($_POST['prod'])) {
            $product = sanitise_input($_POST['prod']);
        }
                          
        //making WHERE clause
        $whereClause = "";
        if (!empty($fname)) {
            if ($whereClause != ""){
                $whereClause .= " OR ";
            }
            $whereClause .= "firstname = '$fname'";
        } 
        if (!empty($lastName)) {
            if ($whereClause != ''){
                $whereClause .= " OR ";
            }
            $whereClause .= " lastname = '$lastName'  ";
        } 
        if (!empty($product)) {
            if ($whereClause != ""){
                $whereClause .= " OR ";
            }
            $whereClause .= "product_name = '$product'";
        } 
        if (!empty($status)) {
            if ($whereClause != ""){
                $whereClause .= " OR ";
            }
            $whereClause .= "order_status = '$status'";
        } 

        if ($whereClause == ""){
            $NewQuery = "SELECT order_id, firstname, lastname, product_name, order_status, phonenum, email, total_cost FROM orders ORDER BY total_cost $sort";
        }else{
            $NewQuery = "SELECT order_id, firstname, lastname, product_name, order_status, phonenum, email, total_cost FROM orders WHERE $whereClause ORDER BY total_cost $sort";
        }
        
        $resultOfNewQuery = mysqli_query($conn, $NewQuery);
        //echo
        echo "<table>\n";
        echo "<tr>\n";
        echo "<th>Order ID</th>\n";
        echo "<th>First Name</th>\n";
        echo "<th>Last Name</th>\n";
        echo "<th>Ordered Product</th>\n";
        echo "<th>Order Status</th>\n";
        echo "<th>Phone Number</th>\n";
        echo "<th>Email</th>\n";
        echo "<th>Total cost</th>\n";
        echo "<th>Cancel Order</th>\n";
        echo "<th>Modify Status</th>\n";
        //retrieve current record
        if (!$resultOfNewQuery){
            echo "<p>Something wrong with ", $NewQuery, "</p>";
        } else {
            while ($row = mysqli_fetch_assoc($resultOfNewQuery)){
                echo "<tr>\n";
                echo "<td>", $row["order_id"] ,"</td>\n";
                echo "<td>", $row["firstname"] ,"</td>\n";
                echo "<td>", $row["lastname"] ,"</td>\n";
                echo "<td>", $row["product_name"] ,"</td>\n";
                echo "<td>", $row["order_status"] ,"</td>\n";
                echo "<td>", $row["phonenum"] ,"</td>\n";
                echo "<td>", $row["email"] ,"</td>\n";
                echo "<td>", $row["total_cost"] ,"</td>\n";
    

    ?>
                <!--Delete order by posting to delete_order.php-->
                <td>
                    <form class='deleteForm' action="delete_order.php" method="post">
                        <input type="hidden" name="id" value="<?= $row['order_id'] ?>">
                        <input <?= $row['order_status'] !== 'PENDING' ? "disabled" : "" ?> class="deleteButton" type="submit" value="Cancel">
                    </form>
                </td>


                <!--Updating order status by posting to update_order.php-->
                <td>
                    <form class='updateForm' action="update_order.php" method="post">
                        <input type="hidden" name="order_id" value="<?= $row['order_id'] ?>">
                        <input class="updateButton" type="submit" value="Update">
                    </form>
                </td>                


    <?php 
            echo "</tr>\n";
            } 
        }
        echo "</table>\n";
    ?>
</body>
</html>