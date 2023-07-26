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
    <?php include_once "include/header.php" ?>
    
    <main id="about">
        <div id="main_content">
            <h2>About</h2>
            <ul>
                <li>I managed to complete all the tasks.</li>
                <li> Special features:
                    <ul>
                        <li>You can return to homepage by clicking to logo in the header section.</li>
                        <li>When you try to access friend list and friend add page while not logging in, it will redirect you to log in page.</li>
                        <li>If you try to access log-in page after a successful log-in, it will redirect you to index page.</li>
                    </ul>
                </li>
                <li>I had trouble with error handling task since I couldn't use @ or if-else to catch some database errors. 
                    For example, everytime mysqli_connect fails, it always print out fatal error which can't be suppressed.
                    Therefore, I had to use try-catch block to catch that error.
                </li>
                <li>I'd like to enhance UI with Javascript next time.</li>
                <li>There is no additional feature.</li>
                <li>Week 10 discussion response
                    <img src="./images/discussion.jpg">
                </li>

            </ul>
        </div>
    
    </main>
    
    <?php include_once "include/footer.php" ?>
</body>
</html>