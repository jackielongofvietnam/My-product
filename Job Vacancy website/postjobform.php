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
    
    <main id="pjf">
        <form method="post" action="postjobprocess.php"> 
            <div class="input">
                <label for="pos_id">Position ID:</label>
                <input type="text" name="pos_id" id="pos_id">
                <span class="pattern">(start with 'P' and 4 digits)</span>
            </div>
            <div class="input">
                <label for="title">Title:</label>
                <input type="text" name="title" id="title">
                <span class="pattern">(20 characters at maximum)</span>
            </div>
            <div class="input">
                <label for="desc">Description:</label>
                <textarea name="desc" id="desc" rows="10"></textarea>
                <span class="pattern">(260 characters at maximum)</span>
            </div>
            <div class="input">
                <label for="close_date">Closing Date:</label>
                <input type="text" name="close_date" id="close_date" value="<?php echo date("d/m/y"); ?>">
                <span class="pattern">(format: dd/mm/yy)</span>
            </div>
            <div class="input">
                <label>Position:</label>
                <input type="radio" name="position" id="full" value="full">
                <label for="full">Full Time</label>
                <input type="radio" name="position" id="part" value="part">
                <label for="full">Part Time</label>
            </div>
            <div class="input">
                <label>Contract:</label>
                <input type="radio" name="contract" id="on" value="on">
                <label for="on">On-going</label>
                <input type="radio" name="contract" id="fixed" value="fixed">
                <label for="fixed">Fixed term</label>
            </div>
            <div class="input">
                <label>Accept Application by:</label>
                <input type="checkbox" name="post" id="post" value="post">
                <label for="post">Post</label>
                <input type="checkbox" name="email" id="email" value="email">
                <label for="email">Email</label>
            </div>
            <div class="input">
                <label for="location">Location:</label>
                <select id="location" name="location">
                    <option value="">---</option>
                    <option value="ACT">ACT</option>
                    <option value="NSW">NSW</option>
                    <option value="NT">NT</option>
                    <option value="QLD">QLD</option>
                    <option value="SA">SA</option>
                    <option value="TAS">TAS</option>
                    <option value="VIC">VIC</option>
                    <option value="WA">WA</option>                   
                </select>
            </div>
            <div id="submit_reset">
                <input type="submit" value="Post">
                <input type="reset">
            </div>
            
        </form>  
    </main>
    
    <footer><p>&copy; 2023 Job Vacancy Posting System. This website belong to Thanh Long.</p></footer>
</body>
</html>