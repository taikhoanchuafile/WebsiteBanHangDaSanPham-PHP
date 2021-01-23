<div class="header_bottom">
		<div class="header_bottom_left">
			<div class="section group">
				<?php  
					$showBrandFour= $bra->showBrandFour();
					if ($showBrandFour) {
						$i=0;
						while ($resultShowBrandFour = $showBrandFour->fetch_assoc()) {
							$i++;
						
					?>
				<div class="listview_1_of_2 images_1_of_2">
					<?php  
						$idOfBrandName = $resultShowBrandFour['brandId'];
						$showProductHeaderByBrandId = $pro->showProductHeaderByBrandId($idOfBrandName);
						if ($showProductHeaderByBrandId) {
							while ($resultShowProductByBrandId = $showProductHeaderByBrandId->fetch_assoc()) {
							
					?>
					<div class="listimg listimg_2_of_1">
						 <a href="details.php?productId=<?php echo $resultShowProductByBrandId['productId']; ?>">
						 	<img src="admin/uploads/<?php echo $resultShowProductByBrandId['productImage']; ?>" alt="image" />
						 </a>
					</div>
				    <div class="text list_2_of_1">
				    	
						<h2><?php echo $resultShowBrandFour['brandName']; ?></h2>
				
						<p><?php echo $resultShowProductByBrandId['productName']; ?></p>
						<div class="button"><span><a href="details.php?productId=<?php echo $resultShowProductByBrandId['productId']; ?>">Add to cart</a></span></div>
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
		  <div class="clear"></div>
		</div>
			 <div class="header_bottom_right_images">
		   <!-- FlexSlider -->
             
			<section class="slider">
				  <div class="flexslider">
					<ul class="slides">
					<?php  
					   $getSlider = $pro->getSlider();
					    if ($getSlider) {
					    	$i=0;
					        while ($resultGetSlider=$getSlider->fetch_assoc()) {
					            $i++;
						
					?>

						<li><img src="admin/uploads/<?php echo $resultGetSlider['sliderImage']; ?>" alt="image"/></li>
					<?php  

						    }
						}
					?>

				    </ul>
				  </div>

	      </section>
<!-- FlexSlider -->
	    </div>
	  <div class="clear"></div>
  </div>