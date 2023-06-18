<?php
    require_once("settings.php");
    $conn = @mysqli_connect($host, $user, $pwd, $sql_db);
    $sql_table = "orders";
    // retrieve the form data
    $status = $_POST['status'];
    $order_id = $_POST['order_id'];
    // build the SQL UPDATE statement
    $UpdateQuery = "UPDATE $sql_table SET order_status = '$status' WHERE order_id = $order_id";

    // execute the UPDATE statement using your database connection object
    $updateResult = mysqli_query($conn, $UpdateQuery);

    // check if the UPDATE was successful and handle any errors
    if ($updateResult === FALSE) {
        die("Error updating order");
    } else {
    // redirect the user to the manage.php page
        header("Location: manager.php");
        exit();
    }
?>