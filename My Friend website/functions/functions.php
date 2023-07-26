<?php 
    function sanitise_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    
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
?>