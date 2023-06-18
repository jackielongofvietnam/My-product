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
       <main id="enhancement">           
            <div id="enhancement_list">
                <p>The following enhancement has been implemented in the website.</p>
                <ul>
                    <li>
                        Time for a :hover transition to occur is reduced to smooth the effect by using 'transition' properties in :hover-contained selectors. (Try hovering any button on the website to see the effect)
                    </li>
                    <li>
                        In the homepage, the background image of the intro part moves up and down and scale up slowly. This animation is achieved by using 'animation' properties along with several complex CSS properties.
                    </li>
                    <li>
                        In the enquire form, input label transits smoothly to the top of the input area as users click the field or enter a valid input value. This is achieved by using :focus and :hover pseudo class for the input selector.
                    </li>                   
                </ul>    
            </div>                               
      </main>
       <?php include_once 'includes/footer.inc'; ?>
    </body>
</html>