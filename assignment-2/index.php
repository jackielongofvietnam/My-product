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
       <main id="index">           
            <section class="intro">
                <div class="info">                   
                    <h1>WELCOME TO GLORY FURNITURE</h1>
                    <h2>LET YOUR HOUSE DECORATED BY US</h2>
                </div>
            </section>
    
            <!-- Promotion -->
            <div class="content" id="promotion">
                <img src="images/banner_1.jpg" alt="Banner">
            </div>
        
            <section class="content" id="feature_products">   
                <h1>Feature products</h1>         
                <div class="gallery">          
                  <div class="gallery-item">
                    <img class="gallery-image" src="images/product_1.jpg" alt="">
                    <!--Source: https://images.demandware.net/dw/image/v2/BBBV_PRD/on/demandware.static/-/Sites-master-catalog/default/dw04b3c19c/images/600000/606028.jpg?sw=2000 -->
                  </div>         
                  <div class="gallery-item">
                    <img class="gallery-image" src="images/product_2.jpg" alt="">
                    <!--Source: https://assets.pbimgs.com/pbimgs/rk/images/dp/wcm/202251/0075/banks-extending-dining-table-z.jpg -->
                  </div>         
                  <div class="gallery-item">
                    <img class="gallery-image" src="images/product_3.jpg" alt="">
                    <!--Source: https://www.lumberfurniture.com.au/wp-content/uploads/2021/03/King-dining-table-5-scaled.jpg -->
                  </div>         
                  <div class="gallery-item">
                    <img class="gallery-image" src="images/product_4.jpg" alt="">
                    <!--Source: https://upload.wikimedia.org/wikipedia/commons/7/7f/4Coffee_Table.jpg -->
                  </div>       
                  <div class="gallery-item">
                    <img class="gallery-image" src="images/product_5.jpg" alt="">
                    <!--Source: https://www.cellini.com.my/image/cache/catalog/furniture/DS/Kay/henry%202%20m-832x641.jpg -->
                  </div>
                </div>         
            </section>
       </main>
       <?php include_once 'includes/footer.inc'; ?>      
    </body>
</html>