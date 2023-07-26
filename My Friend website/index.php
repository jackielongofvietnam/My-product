<?php session_start(); //start session for header?>
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
    <?php include_once ("include/header.php"); ?> 

    <main id="index">
        <div class="section" id="welcome">
            <h1>Welcome to My Friends System.</h1>
        </div>
        <div class="section" id="info">
            <h2>Creator of this website</h2>
            <p>Nguyen Ngo Thanh Long</p>
            <p><strong>ID:</strong> 103803053</p>
            <p><strong>Email:</strong> 103803053@student.swin.edu.au</p>
            <p>I declare that this assignment is my individual work. I have not worked
                collaboratively nor have I copied from any other student’s work or from any other source.
            </p>
        </div>
        <div class="section" id="noti">
            <h3>Attention!</h3>
            <?php 
                require_once ("include/db_connection.php"); //include db connection info
                try { //try-catch db connection error 
                    $db_conn = @mysqli_connect($host, $user, $pswd, $dbnm);
                    echo "<p style=\"color: green;\">Database connection is successful!</p>";
                    try { //try-catch table creation and records inserting errors
                        //create friends table
                        $query = "CREATE TABLE IF NOT EXISTS friends ( 
                                                            friend_id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
                                                            friend_email VARCHAR(50) NOT NULL,
                                                            password VARCHAR(20) NOT NULL,
                                                            profile_name VARCHAR(30) NOT NULL,
                                                            date_started DATE NOT NULL,
                                                            num_of_friends INT UNSIGNED)";
                        mysqli_query($db_conn, $query);
                        //create myfriends table
                        $query = "CREATE TABLE IF NOT EXISTS myfriends (
                                                    friend_id1 INT NOT NULL,
                                                    friend_id2 INT NOT NULL)";
                        mysqli_query($db_conn, $query);
                        
                        //populate records
                        include ("include/records.php"); //include INSERT INTO queries
                        $query = "SELECT * FROM friends"; //check friends table
                        $result = mysqli_query($db_conn, $query);
                        $row = mysqli_fetch_row($result);
                        if ($row == null) { //only populate records if there is no record in the table                         
                            mysqli_query($db_conn, $friends_query);                                                                                                        
                        } 
                        
                        //NOTE: myfriends records are bi-diretional, meaning if user 1 and user 2 are friend of each other, the row is either 1-2 or 2-1
                        $query = "SELECT * FROM myfriends"; //check myfriends table
                        $result = mysqli_query($db_conn, $query);
                        mysqli_use_result($db_conn);
                        $row = mysqli_fetch_row($result); 
                        if ($row == null) {//only populate records if there is no record in the table                          
                            mysqli_query($db_conn, $myfriends_query);                          
                        }
                        mysqli_free_result($result);
                        echo "<p style=\"color: green;\">Successfully create table and populate records.</p>"; 
                    }
                    catch (Exception $e) { //print error message if table aren't created or records aren't inserted
                        echo "<p style=\"color: red;\">Couldn't create table and populate records.</p>"; 
                    }                  
                    mysqli_close($db_conn);
                }
                catch (Exception $e) { //print error message if db can't be connected
                    echo("<p style=\"color: red;\">Database connection failed! Please try again later.</p>");                 
                }     
            ?>
        </div>               
    </main>  
    
    <?php include_once ("include/footer.php"); ?>  
</body>
</html>