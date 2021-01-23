<?php 
	include 'inc/header.php';
	include 'inc/slider.php';
?>

 <div class="main">
    <div class="content">

    	<?php  
    		$showBrand = $bra->showBrand();
    		if ($showBrand) {
    			$i=0;
    			while ($resultShowBrand = $showBrand->fetch_assoc()) {
    			    $i++;
    			
    	?>

    	<div class="content_top">
    		<div class="heading">
    			<h3>Brand: <?php echo $resultShowBrand['brandName']; ?></h3>
    		</div>
    		<div class="clear"></div>
    	</div>
	      <div class="section group">
				
				<?php 
					$id = $resultShowBrand['brandId'];
					$showProductByBrandId = $pro->showProductByBrandId($id);
					if ($showProductByBrandId) {
						$i=0;
						while ($resultShowProductByBrandId = $showProductByBrandId->fetch_assoc()) {
						    $i++;
						
				?>

				<div class="grid_1_of_4 images_1_of_4">
					<img src="admin/uploads/<?php echo $resultShowProductByBrandId['productImage']; ?>" alt="" />
					 <h2><?php echo $resultShowProductByBrandId['productName']; ?></h2>
					 <p><?php echo $fm->textShorten($resultShowProductByBrandId['productDesc'], 50); ?></p>
					 <p><span class="price"><?php echo $fm->formatCurrency($resultShowProductByBrandId['productPrice']); ?></span></p> 
				     <div class="button"><span><a href="details.php?productId=<?php echo $resultShowProductByBrandId['productId']; ?>" class="details">Details</a></span></div>
				</div>
				<?php  
						}
					}
				?>

			</div>
			<?php  
					}
				}
			?>
    </div>
 </div>

<?php 
	include 'inc/footer.php';
?>