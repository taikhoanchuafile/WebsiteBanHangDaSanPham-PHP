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
?> -->
<?php  
	if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['save'])) {
		$updateCustomer = $cus->updateCustomer($_POST,$idCustomer);
	}
	
?>

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
                            <form action="" method="post">
                                <table class="table table-inverse table-active table-responsive">
                                    <h2>
                                        <?php 
                                            if (isset($updateCustomer)) {
                                                echo $updateCustomer;
                                            }
                                        ?>
                                    </h2>
                                    <thead class="thead-dark">
                                        <th>Name</th>
                                        <!-- <th>City</th> -->
                                        <th>Phone</th>
                                        <!-- <th>Country</th> -->
                                        <th>Zipcode</th>
                                        <th>Email</th>
                                        <th>Address</th>
                                        <th></th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><input type="text" name="name" value="<?php echo $resultShowInformationCustomer['name']; ?>"></td>
                                           <!--  <td><input type="" name="city" value="<?php echo $resultShowInformationCustomer['city']; ?>"></td> -->
                                            <td><input type="" name="phone" value="<?php echo $resultShowInformationCustomer['phone']; ?>"></td>
                                           <!--  <td><input type="" name="country" value="<?php echo $resultShowInformationCustomer['country']; ?>"></td> -->
                                            <td><input type="" name="zipcode" value="<?php echo $resultShowInformationCustomer['zipcode']; ?>"></td>
                                            <td><input type="" name="email" value="<?php echo $resultShowInformationCustomer['email']; ?>"></td>
                                            <td><input type="" name="address" value="<?php echo $resultShowInformationCustomer['address']; ?>"></td>
                                            <td>
                                                <input class="btn btn-light btn-outline-success font-weight-bold" type="submit" name="save" value="Save">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>         
                            </form>
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