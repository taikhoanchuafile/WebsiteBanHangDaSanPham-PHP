<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>

<?php  
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../classes/cart.php');
?>
<?php  
	$cart = new Cart();
	if (isset($_GET['shiftId'])) {
		$id=$_GET['shiftId'];
		$time=$_GET['time'];
		$price=$_GET['price'];
		$shifted = $cart->shifted($id,$time,$price);
	}
	if (isset($_GET['delId'])) {
		$id=$_GET['delId'];
		$time=$_GET['time'];
		$price=$_GET['price'];
		$delShifted = $cart->delShifted($id,$time,$price);
	}
?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Inbox</h2>
                <div class="block">
                <?php  
                	if (isset($shifted)) {
                		echo $shifted;
                	}
                ?>   
                <?php  
                	if (isset($delShifted)) {
                		echo $delShifted;
                	}	
                ?>
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>No.</th>
							<th>Order Time</th>
							<th>Product</th>
							<th>Quantity</th>
							<th>Price</th>
							<th>Customer ID</th>
							<th>Address</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php  
							$getInboxCart = $cart->getInboxCart();
							if ($getInboxCart) {
								$i=0;
								while ($resultGetInboxCart = $getInboxCart->fetch_assoc()) {
								    $i++;
								
						?>
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $resultGetInboxCart['oderDate']; ?></td>
							<td><?php echo $resultGetInboxCart['productName']; ?></td>
							<td><?php echo $resultGetInboxCart['quantity']; ?></td>
							<td><?php echo Format::formatCurrency($resultGetInboxCart['productPrice'])." VNĐ"; ?></td>
							<td><?php echo $resultGetInboxCart['customerId']; ?></td>
							<td><a href="customer.php?customerId=<?php echo $resultGetInboxCart['customerId']; ?>">View Customer</a></td>
							<td>
								<?php  
									if ($resultGetInboxCart['status'] == 0) {


								?>
								<a href="?shiftId=<?php echo $resultGetInboxCart['orderId']; ?>&price=<?php echo $resultGetInboxCart['productPrice']; ?>&time=<?php echo $resultGetInboxCart['oderDate']; ?> ">Pending</a>
								<?php  
									}elseif ($resultGetInboxCart['status'] == 1) {
										echo "<span class='font-weight-bold'>Shifting...</span>";
									}else {


								?>
								<a href="?delId=<?php echo $resultGetInboxCart['orderId']; ?>&price=<?php echo $resultGetInboxCart['productPrice']; ?>&time=<?php echo $resultGetInboxCart['oderDate']; ?> ">Remove</a>
								<?php  
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
               </div>
            </div>
        </div>
<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();

        $('.datatable').dataTable();
        setSidebarHeight();
    });
</script>

<?php include 'inc/footer.php';?>
