<header>         
    <div id="header_content">
        <h1 id="logo"><a href="index.php">My Friends System</a></h1> 
        <div id="menu_option">
            <div class="option_group" id="main_option">
                <a href="friendlist.php">Friends</a>    
                <a href="friendadd.php">Add friend</a>
                <a href="about.php">About</a>
            </div>
              
            <div class="option_group" id="signup_login">
                <?php 
                    if (!isset($_SESSION["email"])) {
                        echo " <a href=\"login.php\">Log in</a>
                            <a href=\"signup.php\">Sign up</a>";
                    }
                    else {
                        $display_email = $_SESSION["email"];
                        if (strlen($display_email) > 11) {
                            $display_email = substr($display_email, 0, 8) . "...";                       
                        }
                        echo "<a>$display_email</a>";  
                        echo "<a href=\"logout.php\">Log out</a>";                               
                    }             
                ?>
            </div>
                      
        </div>
    </div>           
</header>