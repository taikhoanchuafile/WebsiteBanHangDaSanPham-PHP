<?php 
	include 'inc/header.php';
	include 'inc/slider.php';
?>

 <div class="main">
    <div class="content">
    	<?php  
    		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    			$tukhoa = $_POST['tukhoa'];
    		    $searchProduct = $pro->searchProduct($tukhoa);
    		}
    	?>
    	<div class="content_top">
    		<div class="heading">
    			<h3>Từ khóa tìm kiếm: <?php echo $tukhoa; ?></h3>
    		</div>
    		<div class="clear"></div>
    	</div>
	    <div class="section group text-center">

	    		<?php  
	    			if ($searchProduct) {
	    				$i=0;
	    				while ($resultSearch = $searchProduct->fetch_assoc()) {
	    				    $i++;
	    				
	    		?>

				<div class="grid_1_of_4 images_1_of_4">
					 <a href="preview-3.php"><img src="admin/uploads/<?php echo $resultSearch['productImage']; ?>" alt="" /></a>
					 <h2><?php echo $resultSearch['productName']; ?></h2>
					 <p><?php echo $fm->textShorten($resultSearch['productDesc'], 50); ?></p>
					 <p><span class="price"><?php echo $fm->formatCurrency($resultSearch['productPrice'])." "."VNĐ"; ?></span></p>
				     <div class="button"><span><a href="details.php?productId=<?php echo $resultSearch['productId']; ?>" class="details">Details</a></span></div>
				</div>
				<?php  
						}
					}else {
    					echo "<span style='font-size:100px' class='text-danger font-weight-bold'>Not Found</span>";
    				}
				?>
			</div>
		</div>
	</div>
	
<?php 
	include 'inc/footer.php';
?>