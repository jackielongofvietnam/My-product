<?php 
    //prevent re-access to log-in page after successful login
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
                        $pwd = mysqli_escape_string($db_conn, sanitise_input($_POST["pwd"]));
                        
                        //input validation
                        $empty_err = "must not be empty."; //partially set up a common empty-input error message
                        $error = []; //associative array to store error messages
                        //Firstly, check for empty-input errors
                        $error["email_err"] = empty($email) ? "Email $empty_err" : "";
                        $error["pwd_err"] = empty($pwd) ? "Password $empty_err" : "";
                        
                        $first_check = array_filter($error); //remove empty $error elements (return empty array if there are no empty-input errors)
                        //if there are no more empty-input errors, continue with checking email and password existence 
                        if(empty($first_check)) {                          
                            //Firstly, check for email existence
                            $query = "SELECT friend_email FROM friends WHERE friend_email = '$email'";
                            $result = mysqli_query($db_conn, $query);
                            $rows = mysqli_fetch_row($result); //return null if email doesn't exist
                            if ($rows == null) {
                                $error["email_err"] = "Email does not exist.";
                            }
                            
                            //Only when email is valid, password is checked respectively
                            if (empty($error["email_err"])) {
                                $query = "SELECT friend_email FROM friends WHERE friend_email = '$email' AND password = '$pwd'";
                                $result = mysqli_query($db_conn, $query);
                                $rows = mysqli_fetch_row($result); //return null if password mismatches
                                if ($rows == null) {
                                    $error["pwd_err"] = "Wrong password.";
                                }
                            }
                            mysqli_free_result($result);
                        }

                        $error = array_filter($error); //remove every empty elements in $error (valid inputs give empty $error element)
                        if(empty($error)) { //if $error is empty, there are no more errors
                            session_start();
                            $_SESSION["email"] = $email; //set session var to email, indicating a successful log-in
                            $query = "SELECT friend_id FROM friends WHERE friend_email ='". $_SESSION["email"]. "'";
                            $result = mysqli_query($db_conn, $query);
                            $row = mysqli_fetch_row($result);
                            $_SESSION["user_id"] = $row[0]; //set another session var to current user id
                            mysqli_free_result($result);
                            header("Location: friendlist.php");
                        }                       
                    }
                    mysqli_close($db_conn);
            ?>
            <!--The try-catch block is split to simplify the code. 
                The below html marks-up and php, which is a part of the 'try' block, 
                won't be produced if db connection is failed-->
            <h2>Log in</h2>
            <div class="input">
                <label for="email">Email</label>
                <input type="text" id="email" name="email" value="<?php if (isset($_POST["email"])) echo $_POST["email"] //maintain input value after every submit action?>">                
                <?php if (!empty($error["email_err"])) echo "<p class=\"error\">", $error['email_err'], "</p>" //print out input error if there is a corresponding error?>
            </div>
            <div class="input">
                <label for="pwd">Password</label>
                <input type="password" id="pwd" name="pwd">
                <?php if (!empty($error["pwd_err"])) echo "<p class=\"error\">", $error['pwd_err'], "</p>" ?>
            </div>
            <div class="button">
                <input type="submit" value="Log in">
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