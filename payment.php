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

 <div class="main">
    <div class="content">
    	<div class="section group">
    		<div class="content_top">
                <div class="heading">
                    <h3>Payment Method</h3>
                </div>
                <div class="clear"></div>
            </div>
            <div class="col-sm-12 mt-2 table-bordered badge bg-dark" style="padding:2%">
                <div>
                    <h2 class="font-weight-bold font-itali text-white">Choose your method payment</h2>
                </div>
                <div class="row mt-3">
                    <div class="col-sm-6 badge bg-warning text-wrap p-3  ">
                        <h2><a href="offlinepayment.php">Offline Payment</a></h2>
                    </div>
                    <div class="col-sm-6 badge bg-light text-wrap p-3">
                        <h2><a href="onlinepayment.php">Online Payment</a></h2>
                    </div>
                </div>
                <div class="text p-2 mt-4">
                    <h2><a href="cart.php"> << Privous</a></h2>
                </div>
            </div>
 		</div>
 	</div>
</div>

<?php 
	include 'inc/footer.php';
?>