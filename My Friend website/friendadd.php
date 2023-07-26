<?php 
    //prevent access to friendadd page before logging in
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
    
    <main id="friendadd">
        <div id="main_content">      
            <?php 
                require_once ("include/db_connection.php"); //include db info
                try { //try-catch db connection error
                    $db_conn = @mysqli_connect($host, $user, $pswd, $dbnm);
                    
                    //find the profile name for the add friend title
                    $query = "SELECT profile_name FROM friends WHERE friend_email = '". $_SESSION["email"]. "'";
                    $result = mysqli_query($db_conn, $query);
                    $row = mysqli_fetch_row($result);
                    echo "<h2>Add friend page of $row[0]</h2>";

                    $user_id = $_SESSION["user_id"];
                    //add friend for the current user using $_POST["friend_id"] set by 'Add friend' button
                    if (isset($_POST["friend_id"])) {
                        $friend_id = $_POST["friend_id"];
                        $query = "SELECT * FROM myfriends WHERE friend_id1 = $user_id AND friend_id2 = $friend_id";
                        $result = mysqli_query($db_conn, $query);
                        if (mysqli_num_rows($result) == 0) {
                            $query = "INSERT INTO myfriends VALUE ($user_id, $friend_id)";
                            mysqli_query($db_conn, $query);
                            //add 1 to num_of_friends field of current user and the added friend
                            $query = "UPDATE friends SET num_of_friends = num_of_friends + 1 WHERE friend_id = $user_id"; 
                            mysqli_query($db_conn, $query);
                            $query = "UPDATE friends SET num_of_friends = num_of_friends + 1 WHERE friend_id = $friend_id";
                            mysqli_query($db_conn, $query);
                        }                      
                    }

                    //Pagination and mutual friends
                    //Pagination: save the query result into an array. Declare an offset for that array and number of result per page.
                    //Slice a sub-array from the initial array which start from the offset with the length of the number of result per page.
                    //Everytime the page moves, the offset will also move to with the number of step equivalent to the number of result per page.                 
                    $page_offset = isset($_GET["page_offset"]) ? $_GET["page_offset"] : 0;                    
                    $friends_per_page = 5; 
                    //The 2 inner queries bi-directionally finds friend_id of current user's friends
                    //The outer one finds id and name of friends who aren't the current user and doesn't have id belong to the inner queries' result.
                    $query = "SELECT friend_id, profile_name FROM friends WHERE friend_id != $user_id 
                            AND (
                                friend_id NOT IN (SELECT friend_id2 FROM myfriends WHERE friend_id1 = $user_id)
                                AND friend_id NOT IN (SELECT friend_id1 FROM myfriends WHERE friend_id2 = $user_id)
                            )"; 
                    $result = mysqli_query($db_conn, $query);
                    $friend_count = mysqli_num_rows($result);
                    echo "<p>Total number of friends to add: $friend_count.</p>";
                    if ($friend_count > 0) { //only display table if there is at least one friend
                        $rows = mysqli_fetch_all($result); //fetch query result into an array 

                        //Slice a sub-array to display 
                        //There are 2 type of pages: completed page which displays 5 results 
                        //and incompleted page which displays less than 5 results (usually last page or when query only returns less than 5 rows)
                        if ($page_offset + $friends_per_page < $friend_count) { //completed page's offset needs 4 or more steps to reach the last result 
                            $display_friend = array_slice($rows, $page_offset, $friends_per_page);
                        } else { //incompleted page
                            $display_friend = array_slice($rows, $page_offset);
                        }  
                        echo "<table>";
                        
                        //make an array of friends' id of the current user
                        $query = "SELECT * FROM myfriends WHERE friend_id1 = $user_id OR friend_id2 = $user_id";
                        $result = mysqli_query($db_conn, $query);
                        $friends_of_user = [];
                        while ($row = mysqli_fetch_row($result)) {
                            //Since in a row, current user's id is either in friend_id1 or friend_id2, 
                            //we want to retrieve the id of the user's friend in the correct column
                            if ($row[0] == $user_id) { //if user's id is in first column, friend's id should be in the second one
                                $friends_of_user[] = $row[1];
                            } else { // and vice-versa
                                $friends_of_user[] = $row[0];
                            }
                        }
                        
                        //loop through each friend to display them
                        foreach ($display_friend as $friend) {
                            //index [0] is id, [1] is profile_name
                            echo '<tr>
                                    <td>', $friend[1], '</td>';
                            
                            $query = "SELECT * FROM myfriends WHERE friend_id1 = $friend[0] OR friend_id2 = $friend[0]";
                            $result = mysqli_query($db_conn, $query);
                            $friends_of_other = [];
                            while ($row = mysqli_fetch_row($result)) {                            
                                if ($row[0] == $friend[0]) {
                                    $friends_of_other[] = $row[1];
                                } else {
                                    $friends_of_other[] = $row[0];
                                }
                            }
                            //find similar elements between the 2 arrays, which results in mutual friends
                            $mutual_count = count(array_intersect($friends_of_user, $friends_of_other));
                            echo "<td>$mutual_count mutual friends</td>";
                            //Using hidden input to store friend_id 
                            echo '<td>
                                    <form method="post" action="', $_SERVER['PHP_SELF'], '">
                                        <input type="hidden" name ="friend_id" value="'.$friend[0].'">
                                        <input type="submit" value="Add friend">
                                    </form>
                                </td>
                                </tr>'; //Clicking 'add frend' button will set $_POST["friend_id"]
                        }
                        echo "</table>";

                        //Style page transferring feature
                        echo '<div id="page">';
                        //If page offset is not 0, it is not the first page and display the left arrow
                        if ($page_offset != 0) {
                            echo '<a href="friendadd.php?page_offset=',$page_offset - $friends_per_page,'"><img src="images/arrow_left.jpg"></a>';
                        }  
                        //Count total number of page 
                        $page = $page_offset / $friends_per_page + 1;
                        if ($friend_count % $friends_per_page == 0) { //if the division has no remainder, display the result
                            $total_page =   $friend_count / $friends_per_page;
                        }                        
                        else { //if the division has remainder, retrieve the integer part and add 1
                            $total_page = (int)($friend_count / $friends_per_page) + 1; 
                        }                    
                        echo "<span>Page $page of $total_page</span>"; //print total page
                        //If page offset needs 4 or more step to the last result, it is not the last page and display the right arrow
                        if ($page_offset + $friends_per_page < $friend_count) { 
                            echo '<a href="friendadd.php?page_offset=',$page_offset + $friends_per_page,'"><img src="images/arrow_right.jpg"></a>';
                        }
                        echo '</div>';
                    } else {
                        echo "<p><strong>Congratulation! You are friend of everyone.</strong></p>";
                    }                                
                    mysqli_free_result($result);               
                    mysqli_close(($db_conn));
                } catch (Exception $e) { //print error if db connection is failed
                    echo "<h3 style=\"margin-left: 135px\">Error:</h3>
                          <p>Couldn't connect to database. Please try again later.</p>";
                }
            ?>
        </div>    
    </main>
    
    <?php include_once "include/footer.php" ?>
</body>
</html>