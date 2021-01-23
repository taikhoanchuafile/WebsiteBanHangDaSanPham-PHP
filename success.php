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
	$getAmuontPrice = $cart->getAmuontPrice($idCustomer);
	if ($getAmuontPrice) {
		$amount=0;
		while ($result = $getAmuontPrice->fetch_assoc()) {
			$price = $result['productPrice'];
			$amount += $price ;
		}
	}
?>
	<div class="text-center p-4" style="font-size: 20px">
		<div class="p-2 text-success text-center font-weight-bold">Order Success</div>
		<p class="p-2">Total Price You Have Bought From My Website: 
		<?php  
			$vat = $amount * 0.1 ;
			$total = $vat + $amount;
			echo $fm->formatCurrency($total)." "."VNĐ";
		?>
			
		</p>
		<p class="p-2">We will contact as soon as possiable.Please see your order details here <a href="orderdetails.php">Click Here</a></p>
	</div>
<?php 
	include 'inc/footer.php';
?>