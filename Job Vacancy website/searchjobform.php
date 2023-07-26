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
    
    <main id="sjf">
        <form method="get" action="searchjobprocess.php">
            <h1>Search for a job</h1>
            <div id="searchbox">
                <img src="style/search-icon-png-21.png" alt="search_icon">
                <input type="text" id="title" name="title" placeholder="Job title">
                <select class="filter" id="pos" name="pos">                  
                    <option value="all">All position</option>
                    <option value="full">Full time</option>
                    <option value="part">Part time</option>
                </select>
                <select class="filter" id="contract" name="contract">                  
                    <option value="all">All contract</option>
                    <option value="on">On-going</option>
                    <option value="fixed">Fixed-term</option>
                </select>
                <select class="filter" id="app_type" name="app_type">                  
                    <option value="all">Accept application by all</option>
                    <option value="post">Post</option>
                    <option value="email">Email</option>
                    <option value="postemail">Post and email</option>
                </select>
                <select class="filter" id="location" name="location">
                    <option value="all">All location</option>
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
            <input type="submit" id="search_btn" value="Search">
            
        </form>        
    
    </main>
    
    <footer><p>&copy; 2023 Job Vacancy Posting System. This website belong to Thanh Long.</p></footer>
</body>
</html>