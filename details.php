<?php 
	include 'inc/header.php';
	//include 'inc/slider.php';
?>
<?php  
	if (!isset($_GET['productId']) || $_GET['productId']==null) {
		echo "<script>window.location = '404.php'</script>";
	} else {
		$id = $_GET['productId'];
	}
?>
<?php  
	if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
		$quantity = $_POST['quantity'];
		$addToCart = $cart->addToCart($quantity,$id);
	}
	
?>
<?php  
	$idcustomer = Session::get('customerId');
	if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['compare'])) {
		$productId = $_POST['productId'];
		$insertCompare = $pro->insertCompare($productId,$idcustomer);
	}
	
?>
<?php  
	$idcustomer = Session::get('customerId');
	if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['wishlist'])) {
		$productId = $_POST['productId'];
		$insertWishlist = $pro->insertWishlist($productId,$idcustomer);
	}
	
?>
 <div class="main">
    <div class="content">
    	<div class="section group">
				<div class="cont-desc span_1_of_2">	
				<?php  
					$showProductById = $pro->showProductById($id);
					if ($showProductById) {
						while ($result = $showProductById->fetch_assoc()) {
						    
						
				?>			
					<div class="grid images_3_of_2">
						<img src="admin/uploads/<?php echo $result['productImage']; ?>" alt="" />
					</div>
				<div class="desc span_3_of_2">
					<h2><?php echo $result['productName']; ?></h2>
					<p><?php echo $fm->textShorten($result['productDesc'], 100) ; ?></p>					
					<div class="price">
						<p>Price: <span><?php echo $fm->formatCurrency($result['productPrice'])." "."VNĐ"; ?></span></p>
						<p>Category: <span><?php echo $result['catName']; ?></span></p>
						<p>Brand:<span><?php echo $result['brandName']; ?></span></p>
					</div>
				<div class="add-cart">
					<form action="" method="post">
						<input type="number" class="buyfield" name="quantity" value="1" min="1" />
						<input type="submit" class="btn btn-success" name="submit" value="Buy Now"/>
						
					</form>		
					<?php  
						if (isset($addToCart)) {
							echo "<span style='color:red;'>$addToCart</span>";
						}
					?>			
				</div>
				
				<div class="add-cart row">
				
					<!-- Compare Product -->
					<form action="" method="post">
						<input type="hidden" class="buyfield" name="productId" value="<?php echo $result['productId']; ?> "/>
						
						<?php  

							$checkLogin = Session::get('customerLogin');
							if ($checkLogin) {
							
						?>
						<input type="submit" class="btn btn-success" name="compare" value="Compare Product"/>
						<?php  

							} else {
								echo " ";;
							}
						?>
					</form>

					<!-- Save to Wishlist -->
					<form class="ml-2" action="" method="post">
						<input type="hidden" class="buyfield" name="productId" value="<?php echo $result['productId']; ?> "/>
						
						<?php  

							$checkLogin = Session::get('customerLogin');
							if ($checkLogin) {
							
						?>
						<input type="submit" class="btn btn-success" name="wishlist" value="Save to Wishlist"/>
						<?php  

							} else {
								echo " ";;
							}
						?>
					</form>
				</div>

				<div class="clear"></div>

				<div class="mt-2 font-weight-bold">
					<?php  
						if (isset($insertCompare)) {
							echo $insertCompare;
						}
					?>
					<?php  
						if (isset($insertWishlist)) {
							echo $insertWishlist;
						}
					?>
				</div>
			</div>
			<div class="product-desc">
			<h2>Product Details</h2>
			<?php echo $result['productDesc'] ; ?>
	    </div>
				<?php  
						}
					}
				?>

	</div>
				<div class="rightsidebar span_3_of_1">
					<h2>CATEGORIES</h2>
					<ul>
						<?php  
							$getCategory = $cat->showCategoryFrontend();
							if ($getCategory) {
								$i=0;
								while ($resultGetCategory =$getCategory->fetch_assoc()) {
								    $i++;
								
							
						?>
				      	<li><a href="productbycat.php?CatId=<?php echo $resultGetCategory['catId']; ?>"><?php echo $resultGetCategory['catName']; ?></a></li>
				      	<?php  
				      			}
				      		}
				      	?>
    				</ul>
    	
 				</div>
 		</div>
 	</div>
 	<div class="row">
 		<div class="col-md-8 m-2">
 			<h5 class="font-weight-bold">Ý kiến sản phẩm</h5>
 			<form action="">
 				<p><input class="form-control" placeholder="Enter your name..." type="text" name="tennguoibinhluan"></p>
 				<p><textarea rows="5" style="resize: none;" class="form-control" placeholder="Enter your comment...." name="binhluan"></textarea></p>
 				<p><input class="btn btn-success" type="submit" name="submit" value="Send"></p>
 			</form>
 		</div>
 	</div>
</div>

<?php 
	include 'inc/footer.php';
?>