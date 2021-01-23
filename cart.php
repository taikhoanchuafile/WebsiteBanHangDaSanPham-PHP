<?php 
	include 'inc/header.php';
	//include 'inc/slider.php';
?>

<?php  
	if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['submit']) {
		$quantity=$_POST['quantity'];
		$cartId=$_POST['cartId'];
		$updateQuantityCart = $cart->updateQuantityCart($quantity,$cartId);
		if ($quantity <=0) {
			$delProductInCart = $cart->delProductInCart($cartId);
		}
	}
?>

<?php  
	if (isset($_GET['delCart'])) {
		$id = $_GET['delCart'];
		$delProductInCart = $cart->delProductInCart($id);
	} 
?>


<?php  
	//Refesh lại trang 
	if (!isset($_GET['id'])) {
		//header("Refresh:0; url=?id=live");
		echo "<meta http-equiv='refresh' content='0;URL=?id=live'>";
	}
?>

 <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
			    	<h2>Your Cart</h2>
			    	<?php  
			    		if (isset($updateQuantityCart)) {
			    			echo $updateQuantityCart;
			    		}
			    	?>
			    	<?php  
			    		if (isset($delProductInCart)) {
			    			echo $delProductInCart;
			    		}
			    	?>
						<table class="tblone">
							<tr>
								<th width="20%">Product Name</th>
								<th width="10%">Image</th>
								<th width="15%">Price</th>
								<th width="25%">Quantity</th>
								<th width="20%">Total Price</th>
								<th width="10%">Action</th>
							</tr>

							<?php  
								$getProductCart = $cart->getProductCart();
								
								if ($getProductCart) {
									$subToTal = 0;
									$qty = 0;
									while ($result = $getProductCart->fetch_assoc()) {
									    	
										
							?>

							<tr>
								<td><?php echo $result['productName']; ?></td>
								<td><img src="admin/uploads/<?php echo $result['productImage']; ?>" alt=""/></td>
								<td><?php echo $fm->formatCurrency($result['productPrice'])." "."VNĐ"; ?></td>
								<td>
									<form action="" method="post">
										<input type="hidden" name="cartId" value="<?php echo $result['cartId']; ?>"/>
										<input type="number" name="quantity" min="0" value="<?php echo $result['quantity']; ?>"/>
										<input type="submit" name="submit" value="Update"/>
									</form>
								</td>
								<td>
									<?php 
										$total = $result['productPrice'] * $result['quantity'] ;
										
										echo $fm->formatCurrency($total)." "."VNĐ";

									?>
								</td>
								<td><a onclick="return confirm('Are you want to delete!')" href="?delCart=<?php echo $result['cartId']; ?>">Xóa</a></td>
							</tr>
							
						   <?php  
						   		$subToTal += $total;
						   		$qty += $result['quantity'];
									}
								}
							?>	
							
							
						</table>
						<?php  
							$checkCart = $cart->checkCart();
							if ($checkCart) {
								
							
						?>
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
					</div>
					<div class="shopping">
						<div class="shopleft">
							<a href="index.php"> <img src="images/shop.png" alt="" /></a>
						</div>
						<div class="shopright">
							<a href="payment.php"> <img src="images/check.png" alt="" /></a>
						</div>
					</div>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>

<?php
	include 'inc/footer.php';
?>
