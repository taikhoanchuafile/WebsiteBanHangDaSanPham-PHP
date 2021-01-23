<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>


<?php 
	$filepath = realpath(dirname(__FILE__));
	include ($filepath.'/../classes/product.php');
?>

<?php  
	$pro = new Product();
	if (isset($_GET['sliderId']) && isset($_GET['type'])) {
		$id = $_GET['sliderId'];
		$type = $_GET['type'];
		$updateTypeSlider = $pro->updateTypeSlider($id,$type);
	}
?>
<?php  
	
	if (isset($_GET['delSlider'])) {
		$id = $_GET['delSlider'];
		$deleteSlider = $pro->deleteSlider($id);
	}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Slider List</h2>
        <div class="block">  
        <?php  
        	if (isset($deleteSlider)) {
        		echo $deleteSlider;
        	}
        ?>
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>No.</th>
					<th>Slider Title</th>
					<th>Slider Image</th>
					<th>Slider Type</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php  
				   $showSlider = $pro->showSlider();
				    if ($showSlider) {
				    	$i=0;
				        while ($resultShowSlider=$showSlider->fetch_assoc()) {
				        	 $i++;


				?>
				<tr class="odd gradeX">
					<td><?php echo $i; ?></td>
					<td><?php echo $resultShowSlider['sliderName']; ?></td>
					<td><img src="uploads/<?php echo $resultShowSlider['sliderImage']; ?>" height="200px" width="300px"/></td>
					<td>
						<?php  
							if ($resultShowSlider['sliderType'] == 1) {
							
						?>
						<a href="?sliderId=<?php echo $resultShowSlider['sliderId']; ?>&type=0">On</a>
						<?php  
							} else {
								
							
						?>
						<a href="?sliderId=<?php echo $resultShowSlider['sliderId']; ?>&type=1">Off</a>
						<?php  
							}
						?>
					</td>	
					<td>
						<!-- <a href="slideredit.php?sliderId=<?php echo $resultShowSlider['sliderId']; ?>">Edit</a> || --> 
						<a href="?delSlider=<?php echo $resultShowSlider['sliderId']; ?>" onclick="return confirm('Are you sure to Delete!');" >Delete</a> 
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
