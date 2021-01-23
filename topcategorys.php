<?php 
	include 'inc/header.php';
	include 'inc/slider.php';
?>

 <div class="main">
    <div class="content">

    	<?php  
    		$showCategory = $cat->showCategory();
    		if ($showCategory) {
    			$i=0;
    			while ($resultShowCategory = $showCategory->fetch_assoc()) {
    			    $i++;
    			
    	?>

    	<div class="content_top">
    		<div class="heading">
    			<h3>Category: <?php echo $resultShowCategory['catName']; ?></h3>
    		</div>
    		<div class="clear"></div>
    	</div>
	      <div class="section group">
				
				<?php 
					$id = $resultShowCategory['catId'];
					$showProductByCategory = $pro->showProductByCategory($id);
					if ($showProductByCategory) {
						$i=0;
						while ($resultShowProductByCategory = $showProductByCategory->fetch_assoc()) {
						    $i++;
						
				?>

				<div class="grid_1_of_4 images_1_of_4">
					<img src="admin/uploads/<?php echo $resultShowProductByCategory['productImage']; ?>" alt="" />
					 <h2><?php echo $resultShowProductByCategory['productName']; ?></h2>
					 <p><?php echo $fm->textShorten($resultShowProductByCategory['productDesc'], 50); ?></p>
					 <p><span class="price"><?php echo $fm->formatCurrency($resultShowProductByCategory['productPrice']); ?></span></p> 
				     <div class="button"><span><a href="details.php?productId=<?php echo $resultShowProductByCategory['productId']; ?>" class="details">Details</a></span></div>
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