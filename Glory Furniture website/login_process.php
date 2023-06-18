<?php
    
    require_once("settings.php");
    $conn = @mysqli_connect($host, $user, $pwd, $sql_db);
    $sql_table = "adminManagement";
    // retrieve the form data
    session_start();
    // Check if the form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        // Get the username and password from the form
        $username = $_POST['username'];
        $password = $_POST['accountPassword'];

        // build the SQL statement
        $query = "SELECT * FROM $sql_table WHERE user_name = '$username' AND password = '$password'";

        // Execute the query
        $result = mysqli_query($conn, $query);
        // If the user exists, log them in and redirect them to the protected page
        if (mysqli_num_rows($result) > 0) {
            $_SESSION["username"] = $username;
            header("Location: manager.php");
            exit;
        } else {
            // If the user does not exist, show an error message
            header("Location: login.php");
        }

        // Close the database connection
        mysqli_close($conn);
    }
    
    

?>