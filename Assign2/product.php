<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Glory Furniture</title>
        <meta charset="UTF-8">
        <meta name="description" content="Creating Web Applications">
        <meta name="keywords" content="HTML, CSS, JavaScript">
        <meta name="author" content="Quoc Anh Vu">
        <link rel="stylesheet" href="style/style.css">
    </head>
    <body>
		<?php include_once 'includes/header.inc'; ?>   
		<main id="product">
			<!-- aside internal links to product categories -->
			<aside>
				<ul>
					<li><a href="#sofa">Sofa</a></li>	
					<li><a href="#wardrobe">Wardrobe</a></li>
					<li><a href="#table">Coffee Table</a></li>
					<li><a href="#details_table">Details of products</a></li>
					<li><a href="#products_text_list">Sponsors</a></li>
				</ul>
			</aside>
			
			<div id="container">
				<h2>Product Gallery</h2>
				
				<!-- sofa list -->
				<article class="product_genre">
					<h3 id="sofa">Sofa</h3>
					
					<div class="grid_container">
						<section class="product">
							<img src="./images/sofa1.jpg" alt="Leatherette Sofa"> 
							<!--Source: https://www.ulcdn.net/images/products/710957/original/FNSF53MOBR3_-_main_1.jpg?1670836387 -->
							<h6 class="product_name">Leatherette Sofa</h6>
							<p class="product_price">Price: $80.09</p>
							<a href="payment.php?pro_name=Leatherette%20Sofa&pro_price=80.09">Buy</a>
						</section>
						
						<section class="product">
							<img src="./images/sofa2.jpg" alt="Apollo Compact Sofa"> 
							<!--Source: https://www.ulcdn.net/images/products/93420/original/Apollo_Infinite_FNSF51ACDU30000SAAAA_slide_02.jpg?1467963300 -->
							<h6 class="product_name">Apollo Compact Sofa</h6>
							<p class="product_price">Price: $85.99</p>
							<a href="payment.php?pro_name=Apollo%20Compact%20Sofa&pro_price=85.99">Buy</a>
						</section>
						
						<section class="product">
							<img src="./images/sofa3.jpg" alt="Adelaide Sofa"> 
							<!--Source: https://www.ulcdn.net/images/products/220740/original/FNSF51ABTT3_-_main_6.jpg?1542199045 -->
							<h6 class="product_name">Adelaide Sofa</h6>
							<p class="product_price">Price: $75.09</p>
							<a href="payment.php?pro_name=Adelaide%20Sofa&pro_price=75.09">Buy</a>
						</section>
						
						<section class="product">
							<img src="./images/sofa4.jpg" alt="Verona Sofa"> 
							<!--Source: https://www.ulcdn.net/images/products/202359/original/FNSF51VRSM3_-_main_7.jpg?1533881505 -->
							<h6 class="product_name">Verona Sofa</h6>
							<p class="product_price">Price: $55.29</p>
							<a href="payment.php?pro_name=Verona%20Sofa&pro_price=55.29">Buy</a>
						</section>
						
						<section class="product">
							<img src="./images/sofa5.jpg" alt="Farina Sofa"> 
							<!--Source: https://www.ulcdn.net/images/products/292886/original/FNSF51FASV3_-_main_4.jpg?1581588863 -->
							<h6 class="product_name">Farina Sofa</h6>
							<p class="product_price">Price: $65.99</p>
							<a href="payment.php?pro_name=Farina%20Sofa&pro_price=65.99">Buy</a>
						</section>
						
						<section class="product">
							<img src="./images/sofa6.jpg" alt="Abbey Sofa"> 
							<!--Source: https://www.ulcdn.net/images/products/267534/original/Abbey_Sofa_FNSF51BXDE30R00SAAAA_slide_04.jpg?1553098339 -->
							<h6 class="product_name">Abbey Sofa</h6>
							<p class="product_price">Price: $66.99</p>
							<a href="payment.php?pro_name=Abbey%20Sofa&pro_price=66.99">Buy</a>
						</section>					
					</div>
				</article>
				
				<!-- wardrobe list -->
				<article class="product_genre">
					<h3 id="wardrobe">Wardrobe</h3>
					
					<div class="grid_container">
						<section class="product">
							<img src="./images/wardrobe1.jpg" alt="Wood 3-door Wardrobe"> 
							<!--Source: https://www.ulcdn.net/images/products/481100/slide/666x363/Zoey_3_Door_Wardrobe_00.jpg?1647680772 -->
							<h6 class="product_name">Wood 3-door Wardrobe</h6>
							<p class="product_price">Price: $45.09</p>
							<a href="payment.php?pro_name=Wood%203-door%20Wardrobe&pro_price=45.09">Buy</a>
						</section>
						
						<section class="product">
							<img src="./images/wardrobe2.jpg" alt="Columbia Wood 3-door Wardrobe"> 
							<!--Source: https://www.ulcdn.net/images/products/290954/slide/666x363/Bocado_Columbian_Walnut_3_Door_1.jpg?1575882265 -->
							<h6 class="product_name">Columbia Wood 3-door Wardrobe</h6>
							<p class="product_price">Price: $55.99</p>
							<a href="payment.php?pro_name=Columbia%20Wood%203-door%20Wardrobe&pro_price=55.99">Buy</a>
						</section>
						
						<section class="product">
							<img src="./images/wardrobe3.jpg" alt="Dark Walnut 2-door Wardrobe"> 
							<!--Source: https://www.ulcdn.net/images/products/703047/slide/666x363/a.jpg?1669222660 -->
							<h6 class="product_name">Dark Walnut 2-door Wardrobe</h6>
							<p class="product_price">Price: $40.09</p>
							<a href="payment.php?pro_name=Dark%20Walnut%203-door%20Wardrobe&pro_price=40.09">Buy</a>
						</section>
						
						<section class="product">
							<img src="./images/wardrobe4.jpg" alt="Avalon Wood 2-door Wardrobe"> 
							<!--Source: https://www.ulcdn.net/images/products/625699/slide/666x363/Avalon_Sliding_Door_Wardrobe_Choc_Oak_Sil_Gy_1.jpg?1658148748 -->
							<h6 class="product_name">Avalon Wood 2-door Wardrobe</h6>
							<p class="product_price">Price: $40.29</p>
							<a href="payment.php?pro_name=Avalon%20Wood%202-door%20Wardrobe&pro_price=40.29">Buy</a>
						</section>
						
						<section class="product">
							<img src="./images/wardrobe5.jpg" alt="Baltoro Wood 2-door Wardrobe"> 
							<!--Source: https://www.ulcdn.net/images/products/314046/slide/666x363/Baltoro_Wardrobe_White_1.jpg?1612598408 -->
							<h6 class="product_name">Baltoro Wood 2-door Wardrobe</h6>
							<p class="product_price">Price: $51.99</p>
							<a href="payment.php?pro_name=Baltoro%20Wood%202-door%20Wardrobe&pro_price=51.99">Buy</a>
						</section>
						
						<section class="product">
							<img src="./images/wardrobe6.jpg" alt="Miller Wood 3-door Wardrobe"> 
							<!--Source: https://www.ulcdn.net/images/products/384207/slide/666x363/Miller_3_Door_Wardrobe_2_Drawer_Finish_Two_tone_merc-1.jpg?1630046270 -->
							<h6 class="product_name">Miller Wood 3-door Wardrobe</h6>
							<p class="product_price">Price: $70.99</p>
							<a href="payment.php?pro_name=Miller%20Wood%203-door%20Wardrobe&pro_price=70.99">Buy</a>
						</section>					
					</div>
				</article>

				<!-- coffee table list -->
				<article class="product_genre">
					<h3 id="table">Coffee Table</h3>
					
					<div class="grid_container">
						<section class="product">
							<img src="./images/table1.jpg" alt="Epsilon Solid Wood Table"> 
							<!--Source: https://www.ulcdn.net/images/products/218167/slide/666x363/Epsilon_Coffe_Table_MH_03.jpg?1540530698 -->
							<h6 class="product_name">Epsilon Solid Wood Table</h6>
							<p class="product_price">Price: $40.09</p>
							<a href="payment.php?pro_name=Epsilon%20Solid%20Wood%20Table&pro_price=40.09">Buy</a>
						</section>
						
						<section class="product">
							<img src="./images/table2.jpg" alt="Botwin Rectangular Solid Wood Table"> 
							<!--Source: https://www.ulcdn.net/images/products/331416/slide/666x363/b.jpg?1615523772 -->
							<h6 class="product_name">Botwin Rectangular Solid Wood Table</h6>
							<p class="product_price">Price: $45.29</p>
							<a href="payment.php?pro_name=Botwin%20Rectangular%20Solid%20Wood%20Table&pro_price=45.29">Buy</a>
						</section>
						
						<section class="product">
							<img src="./images/table3.jpg" alt="Claire Rectangular Solid Wood Table"> 
							<!--Source: https://www.ulcdn.net/images/products/116126/slide/666x363/Claire_Coffee_Table_Teak_02_IMG_0113.jpg?1476986168 -->
							<h6 class="product_name">Claire Rectangular Solid Wood Table</h6>
							<p class="product_price">Price: $60.09</p>
							<a href="payment.php?pro_name=Claire%20Rectangular%20Solid%20Wood%20Table&pro_price=60.09">Buy</a>
						</section>
						
						<section class="product">
							<img src="./images/table4.jpg" alt="Striado Rectangular Solid Wood Table"> 
							<!--Source: https://www.ulcdn.net/images/products/149549/slide/666x363/Striado_Storage_Coffee_Table_TK_01.jpg?1498029106 -->
							<h6 class="product_name">Striado Rectangular Solid Wood Table</h6>
							<p class="product_price">Price: $49.69</p>
							<a href="payment.php?pro_name=Striado%20Rectangular%20Solid%20Wood%20Table&pro_price=49.69">Buy</a>
						</section>
						
						<section class="product">
							<img src="./images/table5.jpg" alt="Meridian Round Solid Table"> 
							<!--Source: https://www.ulcdn.net/images/products/293849/slide/666x363/Meridian_Coffee_Table_Teak_Finish_3.jpg?1587565599 -->
							<h6 class="product_name">Meridian Round Solid Table</h6>
							<p class="product_price">Price: $32.99</p>
							<a href="payment.php?pro_name=Meridian%20Round%20Solid%20Table&pro_price=32.99">Buy</a>
						</section>
						
						<section class="product">
							<img src="./images/table6.jpg" alt="Kiviha Solid Wood Table"> 
							<!--Source: https://www.ulcdn.net/images/products/161603/product/Kivaha_4_Seater_Table_Coffee_Set_Beige_64.jpg?1513936652 -->
							<h6 class="product_name">Kiviha Solid Wood Table</h6>
							<p class="product_price">Price: $52.99</p>
							<a href="payment.php?pro_name=Kiviha%20Solid%20Wood%20Table&pro_price=52.99">Buy</a>
						</section>					
					</div>
				</article>
				
				<!-- product details table -->
				<h2 id="details_table">Details of products</h2>
				<table>
					<tr>
						<th>No</th>
						<th>Product Type</th>
						<th>Number of types</th>
						<th>Country of origin</th>
					</tr>
					<tr>
						<td>1</td>
						<td>Sofa</td>
						<td>6</td>
						<td>France</td>
					</tr>
					<tr>
						<td>2</td>
						<td>Wardrobe</td>
						<td>6</td>
						<td>Columbia</td>
					</tr>
					<tr>
						<td>3</td>
						<td>Coffee Table</td>
						<td>6</td>
						<td>Japan</td>
					</tr>
				</table>
				
				<!-- text list of products -->
				<h2 id="products_text_list">Sponsors</h2>
				<ol>
					<li>IKEA</li>
					<li>Wayfair</li>
					<li>Ashley Furniture</li>
					<li>Steelcase</li>
					<li>Herman Miller</li>
					<li>Okamura</li>	
				</ol>	
			</div>
		</main>
		<?php include_once 'includes/footer.inc'; ?>		
    </body>
</html>