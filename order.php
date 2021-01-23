<?php 
	include 'inc/header.php';
	//include 'inc/slider.php';
?>

<?php  
	$checkLogin = Session :: get('customerLogin');
	if (!$checkLogin) {
		header("Location:login.php");
	}
?>

<h2 class="text-center p-4 text-primary  " style="font-size: 170px">Order Now</h2>

<?php 
	include 'inc/footer.php';
?>