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
    
    <main id="sjp">
        <h1>Search Result:</h1>
        <?php 
            //prevent injection
            function sanitise_input($data) {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }
            
            $file = "./data/jobposts/jobs.txt";
            if (!file_exists($file)) { //check file and directory existence
                echo "<div id=\"no_result\">
                        <p>An error has occur. Please try again later</p>
                    </div>";
            } elseif (empty($_GET["title"])) { //check empty title
                echo "<div id=\"no_result\">
                        <p>Please enter job title.</p>
                    </div>";                
            } else { //execute   
                //assign search criteria to variables 
                $title = str_replace(" ", "", strtolower(sanitise_input($_GET["title"]))); //convert title to lowercase and remove all space
                $pos = sanitise_input($_GET["pos"]);
                $contract = sanitise_input($_GET["contract"]);
                $app_type = sanitise_input($_GET["app_type"]);
                $location = sanitise_input($_GET["location"]);
                
                $file_handle = fopen($file, "r"); //open file
                $search_result = []; //initialize an array to store search results
                while (!feof($file_handle)) {                           
                    $record = explode("\t", fgets($file_handle)); //seperate record fields into array.                
                    if (count($record) < 2){ //In the file, there is always a empty line at the end due to \n of the last record which results  
                        continue;            //in a single-element array and need to be casted aside to prevent undefined index array error.
                    } else {
                        $record_title = str_replace(" ", "", strtolower($record[1])); //convert search job title to lowercase and remove all space                            
                        if (is_numeric(strpos($record_title, $title))) { //check position of search job title in record title field. If it return a number, the search result is matched                         
                            $today = date('Y-m-d');
                            $date = DateTime::createFromFormat('d/m/y', $record[3])->format('Y-m-d'); //convert date field into comparable format
                            if ($date < $today) { //ignore record if it is out of date
                                continue;
                            }
                            //ignore record if a criteria is not 'all' and doesn't match the correspoding record field
                            if ($pos != "all" && $pos != $record[4]) { 
                                continue; //  
                            }
                            if ($contract != "all" && $contract != $record[5]) { 
                                continue;
                            }
                            //'Accept application by' criteria is either 'post' or 'email' or 'postemail'(both). In a record, empty post and email are presented by '-'.
                            //Before comparison, we need to combine the 2 record fields and remove '-' into $record_app_type, whose value can only be 'post' or 'email' or 'postemail'(both)
                            $record_app_type = str_replace('-','',$record[6].$record[7]); //combine post and email field                      
                            if ($app_type != "all" && $app_type != $record_app_type) {
                                continue;     
                            }
                            if ($location != "all" && $location != str_replace("\n", "", $record[8])) { //since location is the last field, there is a '\n' at the end that need to be remove
                                continue;    
                            }
                            $search_result[] = $record; //if the record passes all the criteria checks, add it to $search result 
                        }
                    } 
                    //sort result by the most future date using bubble sort
                    $n = count($search_result);
                    for($i = 0; $i < $n; $i++)
                    {
                        $sort_done = True; //variable to check sort completion                                   
                        for ($j = 0; $j < $n - $i - 1; $j++)
                        {                                                 
                            $date1 = DateTime::createFromFormat('d/m/y', $search_result[$j][3])->format('Y-m-d'); //convert date field into comparable format
                            $date2 = DateTime::createFromFormat('d/m/y', $search_result[$j+1][3])->format('Y-m-d');
                            if ($date1 < $date2) { //in this case, most future date will come first
                                $t = $search_result[$j]; //swap result using an intermidiate variable
                                $search_result[$j] = $search_result[$j+1];
                                $search_result[$j+1] = $t;
                                $sort_done = False; //change to false after each swap, indicate that sort is not completed
                            }
                        }                                   
                        if ($sort_done == True) //if there is no more value to swap, exit the loop
                            break;
                    }
                }
                fclose($file_handle);
                
                if (empty($search_result)) { //if no result is found
                    echo "<div id=\"no_result\">
                            <p>No result matches your search.</p>
                        </div>";
                } else {
                    foreach ($search_result as $result) {                  
                        
                        //convert record field into readable text
                        $result_contract = ($result[5] == "on") ? "On-going" : "Fixed-term"; 
                        $result_pos = ucfirst($result[4]) . " time";
                        $result_app_by = ucfirst(str_replace('-','',$result[6])) . //remove if post is '-' (empty)
                                        (($result[6] == "post" && $result[7] == "email") ? ", " : "") . //concatenate 'and' in the middle if post and email both exist
                                        ucfirst(str_replace('-','',$result[7]));    //remove if email is '-' (empty)
                        echo "<div class=\"job_result\">
                                <h2>$result[1]</h2>
                                <p><strong>Description</strong>: $result[2]
                                </p>
                                <p><strong>Closing Date:</strong> $result[3]</p>
                                <p><strong>Position:</strong> $result_contract - $result_pos</p>
                                <p><strong>Application by:</strong> $result_app_by</p>
                                <p><strong>Location:</strong> $result[8]</p>
                            </div>";
                    }
                }
            }         
        ?>
        <div id="button">
            <a href="index.php">Back to homepage</a>
            <a href="searchjobform.php">Search for another job</a>
        </div>
    </main>
    
    <footer><p>&copy; 2023 Job Vacancy Posting System. This website belong to Thanh Long.</p></footer>
</body>
</html>