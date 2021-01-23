<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>

<?php include '../classes/brand.php' ?>
<?php  
    $bra = new Brand();
    if (isset($_GET['delId'])) {
         $id = $_GET['delId'];
         $delBrand = $bra->delBrand($id);
    }
?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Brand List</h2>
                <div class="block">        
                    <?php 
                        if(isset($delBrand)) {
                             echo $delBrand;
                        }
                    ?>
                    <table class="data display datatable" id="example">
                    <thead>
                        <tr>
                            <th>Serial No.</th>
                            <th>Brand Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php  
                            $show_bra = $bra->showBrand();
                            if($show_bra){
                                $i=0;
                                while ($result=$show_bra->fetch_assoc()) {
                                    $i++;
                            

                        ?>
                        <tr class="odd gradeX">
                            <td><?php echo $i; ?></td>
                            <td><?php echo $result['brandName']; ?></td>
                            <td><a href="brandedit.php?brandId=<?php echo $result['brandId'] ?>">Edit</a> || <a onclick = "return confirm('Are you want to delete!')" href="?delId=<?php echo $result['brandId'] ?>" >Delete</a></td>
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

