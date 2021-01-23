<?php 
	include 'inc/header.php';
	//include 'inc/slider.php';
?>
<!-- 
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
?> -->
<?php  
	$idcustomer = Session::get('customerId');
	if (isset($_GET['productId'])) {
		$productId = $_GET['productId'];
		$delProductInWishlist = $cart->delProductInWishlist($idcustomer,$productId);
	} 
?>
 <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
			    	<h3 style="font-size: 50px" class=" text-primary font-weight-bold mb-2">Compare Product</h3>
			    	<table class="table table-striped table-inverse table-hover table-active">
			    		<thead class="thead-dark">
			    			<tr>
			    				<th>Số thứ tự</th>
			    				<th>Product Name</th>
			    				<th>Product Image</th>
			    				<th>Product Price</th>
			    				<th>Action</th>
			    			</tr>
			    		</thead>
			    		<tbody>
			    			<?php  
			    				$idcustomer = Session::get('customerId');
			    				$getProductWishlistByCustomerId= $pro->getProductWishlistByCustomerId($idcustomer);
			    				if ($getProductWishlistByCustomerId) {
			    					$i=0;
			    					while ($result = $getProductWishlistByCustomerId->fetch_assoc()) {
			    					    	$i++;
			    					
			    			?>
			    			<tr>
			    				<td><?php echo $i; ?></td>
			    				<td><?php echo $result['productName']; ?></td>
			    				<td><img src="admin/uploads/<?php echo $result['productImage']; ?>" alt="placeholder+image"></td>
			    				<td><?php echo $fm->formatCurrency($result['productPrice'])  ; ?> VNĐ</td>
			    				<td>
			    					<a onclick="return confirm('Are you want to delete?')" class="btn btn-primary" href="?productId=<?php echo $result['productId']; ?> ">Remove</a>
			    					<a class="btn btn-primary" href="details.php?productId=<?php echo $result['productId']; ?> ">Buy Now</a>
			    				</td>
			    			</tr>
			    			<?php  
			    					}
			    				}	
			    			?>
			    		</tbody>
			    	</table>
						
					<div class="shopping">
						<div class="text-center"> 
							<a  href="index.php"> <img src="images/shop.png" alt="" /></a>
						</div>
					</div>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>

<?php
	include 'inc/footer.php';
?>
