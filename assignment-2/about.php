<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Glory Furniture</title>
        <meta charset="utf-8">
        <meta name="description" content="Creating Web Applications">
        <meta name="keywords" content="HTML, CSS, JavaScript">
        <meta name="author" content="Nguyen Ngo Thanh Long">
        <link rel="stylesheet" href="style/style.css">
    </head>
    <body>
        <?php include_once 'includes/header.inc'; ?>     
       <main id="about">
            <!--Insert code here-->
            <section id="about_section">
                <figure class="about_person">
                    <figcaption class="description">  
                        <h4><a href="">Team leader</a></h4>
                        <h2><a href="">Ngo Nguyen Thanh Long</a></h2>
                        <br>
                        <table>
                            <tr>
                                <td>Student ID:</td>
                                <td>103803053</td>
                            </tr>
                            <tr>
                                <td>Course:</td>
                                <td>Bachelor of Information Technology</td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>103803053@student.swin.edu.au</td>
                            </tr>
                        </table>
                        <div class="social_link">
                            <a href="" class="fa fa-linkedin"></a>
                            <a href="" class="fa fa-twitter"></a>
                            <a href="" class="fa fa-facebook"></a>
                        </div>
                    </figcaption>
                    <div class="image">
                        <a href="#">
                            <img src="images/long.jpg" alt="Ngo Nguyen Thanh Long">
                        </a>
                    </div>
                </figure>
                <figure class="about_person">
                    <figcaption class="description">  
                        <h4><a href="">Member</a></h4>
                        <h2><a href="">Vu Quoc Anh</a></h2>
                        <br>
                        <table>
                            <tr>
                                <td>Student ID:</td>
                                <td>103792795</td>
                            </tr>
                            <tr>
                                <td>Course:</td>
                                <td>Bachelor of Information Technology</td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>103792795@student.swin.edu.au</td>
                            </tr>
                        </table>
                        <div class="social_link">
                            <a href="" class="fa fa-linkedin"></a>
                            <a href="" class="fa fa-twitter"></a>
                            <a href="" class="fa fa-facebook"></a>
                        </div>
                    </figcaption>
                    <div class="image">
                        <a href="#">
                            <img src="images/quoc_anh.jpg" alt="Nguyen Quoc Anh">
                        </a>
                    </div>
                </figure>
                <figure class="about_person">
                    <figcaption class="description">  
                        <h4><a href="">Member</a></h4>
                        <h2><a href="">Nguyen Tien Hung</a></h2>
                        <br>
                        <table>
                            <tr>
                                <td>Student ID:</td>
                                <td>103792795</td>
                            </tr>
                            <tr>
                                <td>Course:</td>
                                <td>Bachelor of Information Technology</td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>103792795@student.swin.edu.au</td>
                            </tr>
                        </table>
                        <div class="social_link">
                            <a href="" class="fa fa-linkedin"></a>
                            <a href="" class="fa fa-twitter"></a>
                            <a href="" class="fa fa-facebook"></a>
                        </div>
                    </figcaption>
                    <div class="image">
                        <a href="#">
                            <img src="images/hung.jpg" alt="Nguyen Tien Hung">
                        </a>
                    </div>
                </figure>
                <figure class="about_person">
                    <figcaption class="description">  
                        <h4><a href="">Member</a></h4>
                        <h2><a href="">Vo Thanh Tam</a></h2>
                        <br>
                        <table>
                            <tr>
                                <td>Student ID:</td>
                                <td>103487596</td>
                            </tr>
                            <tr>
                                <td>Course:</td>
                                <td>Bachelor of Information Technology</td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>103487596@student.swin.edu.au</td>
                            </tr>
                        </table>
                        <div class="social_link">
                            <a href="" class="fa fa-linkedin"></a>
                            <a href="" class="fa fa-twitter"></a>
                            <a href="" class="fa fa-facebook"></a>
                        </div>
                    </figcaption>
                    <div class="image">
                        <a href="#">
                            <img src="images/tam.jpg" alt="Vo Thanh Tam">
                        </a>
                    </div>
                </figure>
                <div id='timetable'>
                    <h1>University timetable</h1>
                    <table class="timetable" cellpadding='0' cellspacing='0'>
                        <tr class='days'>
                            <th></th>
                            <th>Monday</th>
                            <th>Tuesday</th>
                            <th>Wednesday</th>
                            <th>Thursday</th>
                            <th>Friday</th>
                            <th>Saturday</th>
                        </tr>
                        <tr>
                            <th class='time'>Morning</th>
                            <td class='tne10006'>TNE10006</td>
                            <td class='cos20007'>COS20007</td>
                            <td></td>
                            <td class="tne10006">TNE10006</td>
                            <td class="cos10026">COS10026</td>
                            <td class="cos20019">COS20019</td>
                        </tr>
                        <tr>
                            <th class='time'>Lunch</th>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <th class='time'>Afternoon</th>
                            <td class='tne10006'>TNE10006</td>
                            <td class='cos20007'>COS20007</td>
                            <td class="cos10026">COS10026</td>
                            <td class='tne10006'>TNE10006</td>
                            <td></td>
                            <td></td>
                        </tr>
                    </table>
                </div>
            </section>
       </main>     
       <?php include_once 'includes/footer.inc'; ?>
    </body>
</html>