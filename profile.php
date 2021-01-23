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
<!-- <?php  
	if (!isset($_GET['productId']) || $_GET['productId']==null) {
		echo "<script>window.location = '404.php'</script>";
	} else {
		$id = $_GET['productId'];
	}
?>
<?php  
	if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
		$quantity = $_POST['quantity'];
		$addToCart = $cart->addToCart($quantity,$id);
	}
	
?> -->

 <div class="main">
    <div class="content">
    	<div class="section group">
    		<div class="content_top">
    			<div class="heading">
    				<h3 >Profile Customer</h3>
    			</div>
    			<div class="clear"></div>
    		</div>
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
 	</div>
</div>

<?php 
	include 'inc/footer.php';
?>