<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/category.php' ?>

<?php  
    $cat = new Category();
    if (!isset($_GET['catId']) || $_GET['catId']==null) {
        echo "<script>window.location = 'catlist.php';</script>";
    } else {
        $id = $_GET['catId'];
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $catName = $_POST['catName'];
        $updateCat = $cat->updateCategory($catName,$id);
    }
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Update category</h2>
               <div class="block copyblock"> 
                <?php 
                    if(isset($updateCat)) {
                        echo $updateCat;
                    }
                ?>
                <?php  
                    $get_cat_name = $cat->getCategoryById($id);
                    if ($get_cat_name) {
                        while ($result = $get_cat_name->fetch_assoc()) {


                ?>
                 <form action="" method="post">
                    <table class="form">
                        <tr>
                            <td>
                                <input type="text" value="<?php echo $result['catName'] ?>" name="catName"  placeholder="Enter category name..." class="medium" />
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