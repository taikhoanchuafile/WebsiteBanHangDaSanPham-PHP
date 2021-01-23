<?php 
	include 'inc/header.php';
	include 'inc/slider.php';
?>
 <div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    		<h3>Feature Products</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
	      <div class="section group">
	      	<?php
	      		$getFeatheredProduct = $pro->getFeatheredProduct();
	      		if ($getFeatheredProduct) {
	      			$i=0;
	      			while ($resultGetFeathered = $getFeatheredProduct->fetch_assoc()) {
	      			    $i++;
	      			
	      	?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="details.php?productId=<?php echo $resultGetFeathered['productId']; ?>">
					 	<img src="admin/uploads/<?php echo $resultGetFeathered['productImage']; ?>" alt="image" />
					 </a>
					 <h2><?php echo $resultGetFeathered['productName']; ?></h2>
					 <p>

					 	<?php 
					 	echo $fm->textShorten($resultGetFeathered['productDesc'],50);
					 	?>	
					 </p>
					 <p><span class="price"><?php echo $fm->formatCurrency($resultGetFeathered['productPrice'])." "."VNĐ"; ?></span></p>
				     <div class="button"><span><a href="details.php?productId=<?php echo $resultGetFeathered['productId']; ?>" class="details">Details</a></span></div>
				</div>
			<?php  
					}
				}
			?>	
			</div>
			<div class="content_bottom">
    		<div class="heading">
    		<h3>New Products</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
			<div class="section group">
				<?php  
					$getNewProduct = $pro->getNewProduct();
					if ($getNewProduct) {
						$i=0;
						while ($resultGetNew = $getNewProduct->fetch_assoc()) {
						    $i++;
						
				?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="details.php?productId=<?php echo $resultGetNew['productId']; ?>">
					 	<img src="admin/uploads/<?php echo $resultGetNew['productImage']; ?>" alt="" />
					 </a>
					 <h2><?php echo $resultGetNew['productName']; ?></h2>
					 <p><span class="price"><?php echo $fm->formatCurrency($resultGetNew['productPrice'])." "."VNĐ"; ?></span></p>
				     <div class="button"><span><a href="details.php?productId=<?php echo $resultGetNew['productId']; ?>" class="details">Details</a></span></div>
				</div>
			<?php  
					}
				}
			?>
			</div>
		<div>
			<?php  
				$getAllProduct = $pro->getAllProduct();
				$productCount = mysqli_num_rows($getAllProduct);
				$productButton = $productCount/4;
				echo "Trang: ";
				for ( $i=1; $i <=$productButton ; $i++) {
					echo "<a class='btn btn-warning ml-2' href='index.php?trang=$i'>$i</a>";

				}

				
			?>
		</div>
    </div>
 </div>
<?php 
	include 'inc/footer.php';
?>
