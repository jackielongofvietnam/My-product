<?php
require_once("settings.php");
$conn = @mysqli_connect($host, $user, $pwd, $sql_db);
$sql_table = "orders";
$id = $_POST['id'];
$query = "DELETE FROM $sql_table WHERE order_id = '$id'";
$deleteResult = mysqli_query($conn, $query);

header('Location: manager.php');

?>