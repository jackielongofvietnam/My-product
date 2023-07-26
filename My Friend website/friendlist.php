<?php 
    //prevent access to friendlist page before logging in
    session_start();
    if (!isset($_SESSION["email"])) { //if $_SESSION["email"] is not set, redirect to log-in and die() all below code
        header("Location: login.php");
        die(); 
    }   
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="description" content="Web application development" />
    <meta name="keywords" content="PHP" />
    <meta name="author" content="Nguyen  Ngo Thanh Long" />
    <link rel="stylesheet" href="style.css">
    <title>My Friends System</title>
</head>
<body>
    <?php include_once "include/header.php" ?>
    
    <main id="friendlist">
        <div id="main_content">
             
            <?php
                require_once ("include/db_connection.php"); //include db info
                try { //try-catch db connection error
                    $db_conn = @mysqli_connect($host, $user, $pswd, $dbnm);
                    
                    //find the profile name for the friend list title
                    $query = "SELECT profile_name FROM friends WHERE friend_email = '". $_SESSION["email"]. "'";
                    $result = mysqli_query($db_conn, $query);
                    $row = mysqli_fetch_row($result);
                    echo "<h2>Friend list of $row[0]</h2>";

                    $user_id = $_SESSION["user_id"];
                    //Each of the friend list's rows has a hidden input to store friend id. 
                    //Click the unfriend button will trigger the below SQL to delete the corresponding myfriends record.                   
                    if (isset($_POST["friend_id"])) { //if there is a friend to delete
                        //Only delete myfriends record that has ids of the current user and the unfriended 
                        $friend_id = $_POST["friend_id"];
                        $query = "DELETE FROM myfriends WHERE (friend_id2 = $friend_id AND friend_id1 = $user_id)
                                                        OR (friend_id1 = $friend_id AND friend_id2 = $user_id)"; 
                        $result = mysqli_query($db_conn, $query);
                        $affected_row = mysqli_affected_rows($db_conn);
                        if ($affected_row > 0) {
                            //minus 1 to num_of_friends field of current user and the added friend
                            $query = "UPDATE friends SET num_of_friends = num_of_friends - 1 WHERE friend_id = $user_id"; 
                            mysqli_query($db_conn, $query);
                            $query = "UPDATE friends SET num_of_friends = num_of_friends - 1 WHERE friend_id = $friend_id";
                            mysqli_query($db_conn, $query);
                        }                                              
                    }

                    //print out friend list 
                    //The 2 inner queries bi-directionally finds friends' id of the current user in myfriends table
                    //The outer one retrieves id and name of the current user's friends based on their id  
                    $query = "SELECT friend_id, profile_name FROM friends 
                             WHERE friend_id IN (SELECT friend_id2 FROM myfriends WHERE friend_id1 = $user_id) 
                                OR friend_id IN (SELECT friend_id1 FROM myfriends WHERE friend_id2 = $user_id)";
                    $result = mysqli_query($db_conn, $query);
                    $friend_count = mysqli_num_rows($result); //count number of friends
                    echo "<p>Total number of friends: $friend_count.</p>";
                    
                    //display friend list table
                    if ($friend_count > 0) { //only display table if there is at least one friend
                        echo "<table>";
                        $row = mysqli_fetch_row($result);
                        while ($row) {
                        echo '<tr>
                                <td>', $row[1], '</td>
                                <td> 
                                    <form method="post" action="', $_SERVER['PHP_SELF'], '">
                                        <input type="hidden" name ="friend_id" value="', $row[0], '">
                                        <input type="submit" value="Unfriend">
                                    </form>
                                </td>
                            </tr>'; //there is a hidden input with the value of friend's id
                        $row = mysqli_fetch_row($result);
                        }
                        echo "</table>";
                    } else {
                        echo "<p><strong>You have no friend. Navigate to the Add friend page to find new friend.</strong></p>";
                    }  
                    mysqli_free_result($result);               
                    mysqli_close(($db_conn));
                } catch (Exception $e) { //print error if db connection is failed
                    echo "<h3 style=\"margin-left: 190px\">Error:</h3>
                          <p>Couldn't connect to database. Please try again later.</p>";                         
                }
            ?>
        </div>       
    </main>
    
    <?php include_once "include/footer.php" ?>
</body>
</html>