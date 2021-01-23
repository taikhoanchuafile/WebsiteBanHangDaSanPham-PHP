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
	if (isset($_GET['confirmId'])) {
		$id=$_GET['confirmId'];
		$time=$_GET['time'];
		$price=$_GET['price'];
		$comfirmShifted = $cart->comfirmShifted($id,$time,$price);
	}
?>
 <div class="main">
    <div class="content">
    	<div class="cartoption">		
			<div class="cartpage">
			    	<h3 class="text-primary pb-3" style="font-size: 30px">Your Details Ordered</h3>
			    	
			    	<table class="table table-hover table-inverse table-active">
			    		<thead class="thead-dark">
			    			<tr>
			    				<th>ID</th>
								<th>Product Name</th>
								<th>Image</th>
								<th>Price</th>
								<th>Quantity</th>
								<th>Date</th>
								<th>Status</th>
								<th>Action</th>
			    			</tr>
			    		</thead>
			    		<tbody>
			    			<?php  
			    				$idCustomer = Session::get('customerId');
			    				$getCartOrdered = $cart->getCartOrdered($idCustomer);
			    				if ($getCartOrdered) {
			    					$i = 0;
			    					while ($result = $getCartOrdered->fetch_assoc()) {
			    					    $i++;
			    						
			    			?>
			    			<tr>
			    				<td><?php echo $i; ?></td>
			    				<td><?php echo $result['productName']; ?></td>
			    				<td><img src="admin/uploads/<?php echo $result['productImage']; ?>" alt=""/></td>
			    				<td><?php echo $fm->formatCurrency($result['productPrice'])." "."VNĐ"; ?></td>
			    				<td>
			    					<?php echo $result['quantity']; ?>
			    				</td>
			    				<td>
			    					<?php echo $fm->formatDate($result['oderDate']); ?>
			    				</td>
			    				<td>
			    					<?php  
			    						if ($result['status'] == 0) {
			    							echo "Pending";
			    						}elseif ($result['status'] == 1) {
			    							echo "<span class='font-weight-bold'>Shifted</span>";
			    					?>
			    					
			    					<?php  
			    						}else {
			    							echo "Received";
			    						}
			    					?>
			    				</td>

			    				<td>
			    					<?php  
			    						if ($result['status'] == 0) {
			    							echo "N/A";
			    						}elseif ($result['status'] == 1) {
			    							
			    						
			    					?>
			    					<a href="?confirmId=<?php echo $idCustomer; ?>&price=<?php echo $result['productPrice']; ?>&time=<?php echo $result['oderDate']; ?> ">Confirmed</a>
			    					<?php  
			    						} else {
			    							echo "Received";
			    						}
			    					?>
			    				</td>
			    			</tr>
			    			 <?php
			    					}
			    				}
			    			?>	
			    		</tbody>
			    	</table>
			    	<div class="shopping">
			    		<div class="shopleft">
			    			<a href="index.php"> <img src="images/shop.png" alt="" /></a>
			    		</div
			    	</div>
			</div>
       <div class="clear"></div>
    </div>
 </div>

<?php
	include 'inc/footer.php';
?>
