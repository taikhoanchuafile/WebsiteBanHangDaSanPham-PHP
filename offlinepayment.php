<?php 
	include 'inc/header.php';
	//include 'inc/slider.php';
?>
<?php  
	$checkLogin = Session::get('customerLogin');
	if ($checkLogin) {
		$idCustomer = Session::get('customerId');
	} else {
		header("Location:login.php");
	}
?>
   <?php  
	  	$checkCart = $cart->checkCart();
	  	if ($checkCart) {
	  		if (isset($_GET['orderId']) && $_GET['orderId']=='order') {
	  			$insertOrder = $cart->insertOrder($idCustomer);
	  			$delDataCardBySessionId = $cart->delDataCardBySessionId();
	  			header("Location:success.php");
	  		}
	  	}else {
	  		header("Location:404.php");
	  	}
  	?>
<?php  
	
?>
<!-- <?php  
	if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
		$quantity = $_POST['quantity'];
		$addToCart = $cart->addToCart($quantity,$id);
	}
	
?> -->
<form action="" method="post">
 <div class="main">
    <div class="content">
    	<div class="section group">
    		<div class="content_top">
    		    <div class="heading">
    		        <h3>Offline Payment</h3>
    		    </div>
    		    <div class="clear"></div>
    		</div>
    		<div>
   
    				<div class="heading mt-4">
    					<h3>Your Profile</h3>
    				</div>
    				<div class="clear"></div>
    	
    			    			<?php
    			    				$showInformationCustomer = $cus->showInformationCustomer($idCustomer);
    			    				if ($showInformationCustomer) {
    			    					while ($resultShowInformationCustomer = $showInformationCustomer->fetch_assoc()) {
    			    					    
    			    					
    							?>
	    			    			<table class="table table-inverse table-active table-hover">
	    			    				<thead class="thead-dark">
	    			    					<th>Name</th>
	    			    					<th>City</th>
	    			    					<th>Phone</th>
	    			    					<th>Country</th>
	    			    					<th>Zipcode</th>
	    			    					<th>Email</th>
	    			    					<th>Address</th>
	    			    					<th></th>
	    			    				</thead>
	    			    				<tbody>
	    			    					<tr>
	    			    						<td><?php echo $resultShowInformationCustomer['name']; ?></td>
	    			    						<td><?php echo $resultShowInformationCustomer['city']; ?></td>
	    			    						<td><?php echo $resultShowInformationCustomer['phone']; ?></td>
	    			    						<td><?php echo $resultShowInformationCustomer['country']; ?></td>
	    			    						<td><?php echo $resultShowInformationCustomer['zipcode']; ?></td>
	    			    						<td><?php echo $resultShowInformationCustomer['email']; ?></td>
	    			    						<td><?php echo $resultShowInformationCustomer['address']; ?></td>
	    			    						<td>
	    			    							<a href="editprofile.php">
	    			    							    <span class="glyphicon glyphicon-edit"></span>
	    			    							</a>
	    			    						</td>
	    			    					</tr>
	    			    				</tbody>
	    			    			</table>
    			    			<?php  
    			    					}
    			    				}
    			    			?>

    		</div>	

    		<div>
    				<div class="heading mt-4">
    					<h3>Your Cart</h3>
    				</div>
    				
    				<table class="table table-inverse table-active table-hover">
    			    				<thead class="thead-dark">
    			    					<th>Số thứ tự</th>
    			    					<th>Product Name</th>
    			    					<th>Price</th>
    			    					<th>Quantity</th>
    			    					<th>Total Price</th>
    			    				</thead>

    			    				<tbody>
    			    					<?php  
    			    						$getProductCart = $cart->getProductCart();
    			    						
    			    						if ($getProductCart) {
    			    							$i=0;
    			    							$subToTal = 0;
    			    							$qty = 0;
    			    							while ($result = $getProductCart->fetch_assoc()) {
    			    							$i++;   	
    			    								
    			    					?>
    			    					<tr>
    			    						<td><?php echo $i ?></td>
    			    						<td><?php echo $result['productName']; ?></td>
    			    						<td><?php echo $fm->formatCurrency($result['productPrice'])." "."VNĐ"; ?></td>
    			    						<td><?php echo $result['quantity']; ?></td>
    			    						<td>
    			    							<?php 
    			    								$total = $result['productPrice'] * $result['quantity'] ;
    			    								echo $fm->formatCurrency($total)." "."VNĐ";
    			    							?>
    			    						</td>
    			    					</tr>
    			    					<?php  
    			    					  	$subToTal += $total;
    			    					   	$qty += $result['quantity'];
    			    							}
    			    						}
    			    					?>	
    			    	</tbody>

    			    <?php  
    			    	$checkCart = $cart->checkCart();
    			    	if ($checkCart) {
    			    		
    			    	
    			    ?>
    			   	</table>

						<table style="float:right;text-align:left;" width="40%">
							<tr>
								<th>Sub Total : </th>
								<td>
									<?php  
										echo $fm->formatCurrency($subToTal)." "."VNĐ";
										Session :: set('sum',$subToTal);
										Session :: set('qty',$qty);
									?>
								</td>
							</tr>
							<tr>
								<th>VAT : </th>
								<td>
									<?php  
										$percent = 10;
										$vat = $subToTal * ($percent / 100);   
										echo $percent."%"."(".$fm->formatCurrency($vat).")";
									?>
								</td>
							</tr>
							<tr>
								<th>Grand Total :</th>
								<td>
									<?php  
										$gToTal = $subToTal + $vat;
										echo $fm->formatCurrency($gToTal)." "."VNĐ";	
									?>
								</td>
							</tr>
					   </table>
					   <?php  
					   	} else {
					   		echo 'Your cart is Empty. Please shopping now!';
					   	}
					   ?>
			<div class="clear"></div>
	</div>
				<div class="text-center">
					<a class=" badge p-4 bg-warning" href="?orderId=order">Oder Now</a>
					<!-- <input class="btn btn-warning p-3" type="submit" name="" value="Oder Now"> -->
				</div>
			
    	</div>
    </div>
</div>
</div>
</form>
<?php 
	include 'inc/footer.php';
?>