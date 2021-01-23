<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/brand.php' ?>

<?php  
    $bra = new Brand();
    if (!isset($_GET['brandId']) || $_GET['brandId']==null) {
        echo "<script>window.location = 'brandlist.php';</script>";
    } else {
        $id = $_GET['brandId'];
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $brandName = $_POST['brandName'];
        $updateBra = $bra->updateBrand($brandName,$id);
    }
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Update brand</h2>
               <div class="block copyblock"> 
                <?php 
                    if(isset($updateBra)) {
                        echo $updateBra;
                    }
                ?>
                <?php  
                    $get_bra_name = $bra->getBrandById($id);
                    if ($get_bra_name) {
                        while ($result = $get_bra_name->fetch_assoc()) {


                ?>
                 <form action="" method="post">
                    <table class="form">
                        <tr>
                            <td>
                                <input type="text" value="<?php echo $result['brandName'] ?>" name="brandName"  placeholder="Enter brand name..." class="medium" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Update" />
                            </td>
                        </tr>
                    </table>
                </form>
                <?php
                        }
                    } 
                ?>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>