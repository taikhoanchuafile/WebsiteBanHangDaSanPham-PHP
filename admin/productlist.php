<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>

<?php include '../classes/brand.php';?>
<?php include '../classes/category.php';?>
<?php include '../classes/product.php';?>


<?php  
	$pro = new Product();
	if (isset($_GET['delProductId'])) {
		$id = $_GET['delProductId'];
		$deleteProduct = $pro->deleteProduct($id);
	}
	$fm = new Format();
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Product List</h2>
        <div class="block"> 
        	<?php  
        		if (isset($deleteProduct)) {
        			echo $deleteProduct;
        		}
        	?>
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>ID</th>
					<th>Product Name</th>
					<th>product Price</th>
					<th>Product Image</th>
					<th>Category</th>
					<th>Brand</th>
					<th>Description</th>
					<th>Product Type</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody >
				<?php  
					
					$productList = $pro->showProduct();
					if ($productList) {
						$i=0;
						while ($result = $productList->fetch_assoc()) {
						    $i++;
						
				?>
				<tr class="odd gradeX">
					<td><?php echo $result['productId']; ?></td>
					<td><?php echo $result['productName']; ?></td>
					<td><?php echo $fm->formatCurrency($result['productPrice']); ?></td>

					<td>
						
						<?php echo "<img width='80' src='uploads/".$result['productImage']."' alt='placeholder+image'>" ;?>
					</td>

					<td>
						<?php echo $result['catName']; ?>
					</td>

					<td>
						<?php echo $result['brandName']; ?>
					</td>

					<td>
						<?php 
						   	echo $fm->textShorten($result['productDesc'],20);
						?>
					</td>

					<td>
						<?php 
							if ($result['productType'] == 0) {
								echo 'Non-Feathered';
							} else {
								echo 'Feathered';
							}
						?>	
					</td>

					<td><a href="productedit.php?productId=<?php echo $result['productId']; ?>">Edit</a> || <a onclick="return confirm('Are you want to delete!')" href="?delProductId=<?php echo $result['productId']; ?>">Delete</a></td>
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
