<?php 
	include 'inc/header.php';
	include 'inc/slider.php';
?>
<?php  
	if (!isset($_GET['CatId']) || $_GET['CatId']==null) {
		echo "<script>window.location = '404.php'</script>";
	} else {
		$id = $_GET['CatId'];
	}
?>
 <div class="main">
    <div class="content">
    	<?php  
    		$getCategoryName = $cat->getCategoryById($id);
    		if ($getCategoryName) {
    			while ($resultCatName = $getCategoryName->fetch_assoc()) {
    			    
    			
    	?>
    	<div class="content_top">
    		<div class="heading">
    			<h3>Categoty: <?php echo $resultCatName['catName']; ?></h3>
    		</div>
    		<div class="clear"></div>
    	</div>
    	<?php  
    			}
    		}
    	?>
	    <div class="section group">

	    		<?php  
	    			$showProductByCat = $pro->showProductByCat($id);
	    			if ($showProductByCat) {
	    				$i=0;
	    				while ($resultShow = $showProductByCat->fetch_assoc()) {
	    				    $i++;
	    				
	    		?>

				<div class="grid_1_of_4 images_1_of_4">
					 <a href="preview-3.php"><img src="admin/uploads/<?php echo $resultShow['productImage']; ?>" alt="" /></a>
					 <h2><?php echo $resultShow['productName']; ?></h2>
					 <p><?php echo $fm->textShorten($resultShow['productDesc'], 50); ?></p>
					 <p><span class="price"><?php echo $fm->formatCurrency($resultShow['productPrice'])." "."VNĐ"; ?></span></p>
				     <div class="button"><span><a href="details.php?productId=<?php echo $resultShow['productId']; ?>" class="details">Details</a></span></div>
				</div>
				<?php  
						}
					}else {
    					echo "<span class='text-danger font-weight-bold'>Category not avaiable</span>";
    				}
				?>
			</div>
		</div>
	</div>
	
<?php 
	include 'inc/footer.php';
?>