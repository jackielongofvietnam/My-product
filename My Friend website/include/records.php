<?php 
    $friends_query = "INSERT INTO friends(friend_email, password, profile_name, date_started, num_of_friends)
                      VALUES 
                            ('john@gmail.com', '1234', 'john', NOW(), 8),
                            ('tim@gmail.com', '5678', 'tim', NOW(), 6),
                            ('carl@gmail.com', '1234', 'carl', NOW(), 8),
                            ('mike@gmail.com', '5678', 'mike', NOW(), 6),
                            ('marry@gmail.com', '1234', 'marry', NOW(), 7),
                            ('sally@gmail.com', '5678', 'sally', NOW(), 5),
                            ('roger@gmail.com', '1234', 'roger', NOW(), 4),
                            ('leo@gmail.com', '5678', 'leo', NOW(), 4),
                            ('christ@gmail.com', '1234', 'christ', NOW(), 4),
                            ('tina@gmail.com', '5678', 'tina', NOW(), 2);";
            
    $myfriends_query = "INSERT INTO myfriends VALUES 
                                                (1, 2),
                                                (1, 3),
                                                (1, 4),
                                                (1, 5),
                                                (1, 6),
                                                (1, 7),
                                                (3, 6),
                                                (3, 7),
                                                (3, 8),
                                                (3, 9),
                                                (5, 6),
                                                (5, 3),
                                                (5, 10),
                                                (2, 4),
                                                (2, 6),
                                                (2, 9),
                                                (2, 5),
                                                (8, 5),
                                                (8, 1),
                                                (8, 7),
                                                (4, 6),
                                                (4, 3),
                                                (4, 5),
                                                (9, 1),
                                                (9, 4),
                                                (10, 3),
                                                (7, 2);";
?>