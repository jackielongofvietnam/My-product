<?php 
    //prevent re-access to sign-up page after successful login
    session_start();
    if (isset($_SESSION["email"])) { //if $_SESSION["email"] is set, redirect to index and die() all below code
        header("Location: index.php");
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

    <main id="signup_login">
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <?php 
                require_once ("include/db_connection.php"); //include db info
                try { //try-catch db connection error
                    $db_conn = @mysqli_connect($host, $user, $pswd, $dbnm);
                    //start input validation
                    if (isset($_POST["email"])) { //only execute input validation code block after submit button is clicked for the first time
                        require_once ("functions/functions.php"); //include sanitise_input and input_validation functions
                        //assign form input into variables
                        $email = mysqli_escape_string($db_conn, sanitise_input($_POST["email"]));
                        $name = mysqli_escape_string($db_conn, sanitise_input($_POST["name"]));
                        $pwd = mysqli_escape_string($db_conn, sanitise_input($_POST["pwd"]));
                        $confirm_pwd = sanitise_input($_POST["confirm_pwd"]);  
                        
                        //input validation
                        $empty_err = "must not be empty."; //partially set up a common empty-input error message
                        $error = []; //associative array to store error messages
                        $error["email_err"] = input_validation($email, "/^(?=.{1,50}$)[a-zA-Z0-9_.-]+@[a-zA-Z0-9]+\.[a-zA-Z0-9]+$/", "Email $empty_err", "Wrong email format or exceed 50 characters");
                        //if no empty-input error, check for email existence
                        if (empty($error["email_err"])) { 
                            $query = "SELECT friend_email FROM friends WHERE friend_email = '$email'";
                            $result = mysqli_query($db_conn, $query);
                            $rows = mysqli_fetch_row($result); //return null if email is not found
                            if ($rows != null) { //if $rows is not null, email is not unique
                                $error["email_err"] = "Email has already existed.";
                            }
                            mysqli_free_result($result);
                        }
                        
                        $error["name_err"] = input_validation($name, "/^[A-Za-z]{1,30}$/", "Profile name $empty_err", "Profile name can only contain letters (max 30 characters).");
                        
                        $error["pwd_err"] = input_validation($pwd, "/^[A-Za-z0-9]{1,20}$/", "Password $empty_err", "Password can only contain letters and numbers (max 20 characters).");
                        $error["confirm_pwd_err"] = empty($confirm_pwd) ? "Confirm password $empty_err" : "";
                        //if no empty-input errors, compare 2 passwords
                        if (empty($error["pwd_err"]) && empty($error["confirm_pwd_err"])) { 
                            if ($pwd != $confirm_pwd) {
                                $error["confirm_pwd_err"] = "Password mismatches.";
                            }
                        }

                        $error = array_filter($error); //remove every empty elements in $error (valid inputs give empty $error element)
                        if(empty($error)) { //if $error is empty, there are no more errors
                            $query = "INSERT INTO friends(friend_email, password, profile_name, date_started, num_of_friends) VALUE ('$email', '$pwd','$name', NOW(), 0)";
                            mysqli_query($db_conn, $query);
                            session_start();
                            $_SESSION["email"] = $email; //set session var to email, indicating a successful log-in
                            $query = "SELECT friend_id FROM friends WHERE friend_email ='". $_SESSION["email"]. "'";
                            $result = mysqli_query($db_conn, $query);
                            $row = mysqli_fetch_row($result);
                            $_SESSION["user_id"] = $row[0]; //set another session var to current user id
                            mysqli_free_result($result);
                            header("Location: friendadd.php");
                        }                       
                    }
                    mysqli_close($db_conn);
            ?> 
            <!--The try-catch block is split to simplify the code. 
                The below html marks-up and php, which is a part of the 'try' block, 
                won't be produced if db connection is failed-->   
            <h2>Be one of our friends!</h2>
            <div class="input">
                <label for="email">Email</label>
                <input type="text" placeholder="name@domain.com (max 50 characters)" id="email" name="email" value="<?php if (isset($_POST["email"])) echo $_POST["email"] //maintain input value after every submit action?>">                
                <?php if (!empty($error["email_err"])) echo "<p class=\"error\">", $error['email_err'], "</p>" //print out input error if there is a corresponding error?>
            </div>
            <div class="input">
                <label for="name">Profile name</label>
                <input type="text" placeholder="only letters (max 30 characters)" id="name" name="name" value="<?php if (isset($_POST["name"])) echo $_POST["name"] ?>">      
                <?php if (!empty($error["name_err"])) echo "<p class=\"error\">", $error['name_err'], "</p>" ?>         
            </div> 
            <div class="input">
                <label for="pwd">Password</label>
                <input type="password" placeholder="only letters and numbers (max 20 characters)" id="pwd" name="pwd">
                <?php if (!empty($error["pwd_err"])) echo "<p class=\"error\">", $error['pwd_err'], "</p>" ?>
            </div>
            <div class="input">
                <label for="confirm_pwd">Confirm password</label>
                <input type="password" id="confirm_pwd" name="confirm_pwd">
                <?php if (!empty($error["confirm_pwd_err"])) echo "<p class=\"error\">", $error['confirm_pwd_err'], "</p>" ?>
            </div> 
            <div class="button">
                <input type="submit" value="Confirm">
                <input type="reset">
            </div>     
            <?php
                //continue try-catch block    
                } catch (Exception $e) { //print error if db connection is failed 
                    echo "<h3>Error:</h3>
                          <p>Couldn't connect to database. Please try again later.</p>";
                }
            ?>    
        </form>      
    </main>
    
    <?php include_once "include/footer.php" ?>
</body>
</html>