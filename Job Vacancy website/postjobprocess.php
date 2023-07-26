<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="description" content="Web application development" />
    <meta name="keywords" content="PHP" />
    <meta name="author" content="Nguyen  Ngo Thanh Long" />
    <link rel="stylesheet" href="style.css">
    <title>Job Vacancy Posting System</title>
</head>
<body>
    <?php include_once "include/header.inc" ?>
    
    <main id="pjp">
        
        <?php 
            //prevent injection
            function sanitise_input($data) {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            } 
            //validate text input
            function input_validation($input, $pattern, $empty_mess, $mismatch_mess) { 
                if ($input == "") { //check empty input
                    return $empty_mess; 
                } else { //if input is not empty, check against pattern
                    if (!preg_match($pattern, $input)) { //check input against pattern
                        return $mismatch_mess;
                    } else {
                        return ""; //return empty string if input is valid
                    }
                }
            }
            
            //create directory and set permission if not exists
            umask(0007);
            $dir = "./data/jobposts";
            $file = $dir . "/jobs.txt";
            if (!file_exists($file)) {
                mkdir($dir, 02770);
                $handle = fopen($file, "a");
                fclose($handle);
            }
            
            //assign input into variable
            $pos_id = sanitise_input($_POST["pos_id"]); //text input is either empty or filled, no need to check isset
            $title = sanitise_input($_POST["title"]);
            $desc = sanitise_input($_POST["desc"]);
            $close_date = sanitise_input($_POST["close_date"]);
            if (isset($_POST["position"])) { //checkbox and radio might be null, need to check isset
                $position = $_POST["position"];
            } else { 
                $position = ""; 
            }
            if (isset($_POST["contract"])) {
                $contract = $_POST["contract"];
            } else { 
                $contract = ""; 
            }
            if (isset($_POST["post"])) { 
                $post = $_POST["post"];
            } else { 
                $post = "-"; //if post is not set, it is assign with '-', representing not being chosen
            }
            if (isset($_POST["email"])) {
                $email = $_POST["email"];
            } else { 
                $email = "-"; // same as post
            }
            $location = sanitise_input($_POST["location"]); //select is the same as text
            
            //validate input
            $empty_err = "must not be empty."; //create the latter part of empty error message
            $error = []; //array contains error messages
            $err_element = ""; //variable that store each individual error message. If there is no error, it is empty
            
            $err_element = input_validation($pos_id, '/^P\d{4}$/', "Position ID $empty_err", //combine the distinctive empty error message former part of each input with $empty_err
                                        "Position ID must start with an uppercase letter P followed by 4 digits." ); 
            if (empty($err_element)) { //for position ID, it is also checked for uniqueness
                $file_handle = fopen($file, "r");
                while (!feof($file_handle)) {
                    $data = fgets($file_handle, 6); //only get the first 5 characters of each record, which is the position ID                   
                    if ($pos_id == $data) { 
                        $err_element = "Position ID has already existed."; 
                        break; //break once duplication is found
                    }                 
                }
                fclose($file_handle);
            }
            if (!empty($err_element)) { $error[] = $err_element; } //only add error_element into error array if it is not empty 
            
            $err_element = input_validation($title, '/^[A-Za-z0-9 ,.!]{1,20}$/', "Title $empty_err", 
                                        "Title only contains a maximum of 20 alphanumeric characters including spaces, comma, period, or exclamation point." );
            if (!empty($err_element)) { $error[] = $err_element; }

            $err_element = input_validation($desc, '/^[A-Za-z0-9 ,.!]{1,260}$/', "Description $empty_err", 
                                        "Description can only contain a maximum of 260 characters." );
            if (!empty($err_element)) { $error[] = $err_element; }

            $err_element = input_validation($close_date, '/^\d{2}\/\d{2}\/\d{2}$/', "Close date $empty_err", 
                                        "Close Date's format must be dd/mm/yy." );
            if (!empty($err_element)) { $error[] = $err_element; }
            
            if (empty($position)) { $error[] = "Position " . $empty_err; } //radio and checkbox input only need to check for empty error
            if (empty($contract)) { $error[] = "Contract " . $empty_err; }
            if ($post == "-" && $email == "-") { $error[] = "Accept Application by " . $empty_err; } //if post or email are both not chosen, it is an empty error
            if (empty($location)) { $error[] = "Location " . $empty_err; }
            
            //check for error message presence in error array
            if (!empty($error)) { //if error message presents
                echo "<div id=\"error\"><ul>";
                foreach ($error as $err) { //loop through each error message and print them out
                    echo "<li>$err</li>"; 
                }
                echo "</ul></div>";
            } else { //if no error message
                $file_handle = fopen($file, "a");
                $data = $pos_id ."\t".       //concatenate each input into record, using tab as delimiter
                        $title . "\t" .
                        $desc . "\t" .
                        $close_date . "\t" .
                        $position . "\t" .
                        $contract . "\t" .
                        $post . "\t" .
                        $email . "\t" .
                        $location . "\n";
                fwrite($file_handle, $data);
                echo "<div id=\"confirm\"> 
                        <p>Job has been successfully posted. Everyone can now search for your job on this website.</p>            
                      </div> "; //print out confirmation
                fclose($file_handle);
            }     
        ?>
        <div id="button">
            <a href="index.php">Back to homepage</a>
            <a href="postjobform.php">Return to job posting page</a>
        </div>
    </main>
    
    <footer><p>&copy; 2023 Job Vacancy Posting System. This website belong to Thanh Long.</p></footer>
</body>
</html>