<!DOCTYPE html>
<html lang="en">
<head>
<title>Updating order</title>

<meta charset="utf-8">
<meta name="description" content="Assignment 2">
<meta name="keywords" content="PHP, File, input, output">
<link rel="stylesheet" href="./style/update_order.css" type="text/css">

</head>
<body>
    <?php
        require_once("settings.php");
        $conn = @mysqli_connect($host, $user, $pwd, $sql_db);
        $sql_table = "orders";
        $order_id = $_POST['order_id'];
        $infoQuery = "SELECT firstname, lastname, product_name, order_status, phonenum, email, total_cost FROM $sql_table WHERE order_id = '$order_id'";

        $resultInfoQuery = mysqli_query($conn, $infoQuery);
        $data = mysqli_fetch_assoc($resultInfoQuery);
    ?>

	<h1>Update Order <?= $order_id ?></h1>
            <!--execute result
            $result = mysqli_query($conn, $query);
            //check if the connection successful-->

    <div class="OrderInfo">
        <p>Customer Name: <?= $data['firstname'] ?> <?= $data['lastname'] ?></p>
        <p>Customer Phone number: <?= $data['phonenum'] ?></p>
        <p>Ordered Product: <?= $data['product_name'] ?></p>
        <p>Total cost: $<?= $data['total_cost'] ?></p>
        <p>Order Status:  <?= $data['order_status'] ?></p>
    </div>
    
    <form id="editForm" action="update_execute.php" method="post">
        <label for="status">Status</label>
        <select name="status" id="status">
            <option value="PENDING" <?= $data['order_status'] == 'PENDING' ? 'selected' : '' ?>>PENDING</option>
            <option value="FULFILLED" <?= $data['order_status'] == 'FULFILLED' ? 'selected' : '' ?>>FULFILLED</option>
            <option value="PAID" <?= $data['order_status'] == 'PAID' ? 'selected' : '' ?>>PAID</option>
            <option value="ARCHIVED" <?= $data['order_status'] == 'ARCHIVED' ? 'selected' : '' ?>>ARCHIVED</option>
        </select>

        <div id='editOptions'>
            <a href="manager.php">Cancel</a>
            <input type="hidden" name="order_id" value="<?= $order_id ?>">
            <input class="confirmButton" type="submit" value="Save">
        </div>
    </form>

</body>
</html>

