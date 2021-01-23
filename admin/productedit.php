<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>

<?php include '../classes/brand.php';?>
<?php include '../classes/category.php';?>
<?php include '../classes/product.php';?>

<?php  
    $pro = new Product();
    if (!isset($_GET['productId']) || $_GET['productId'] == null) {
        echo "<script>window.location = 'productlist.php'</script>";
    } else {
        $id = $_GET['productId'];
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
        $updateProduct = $pro->updateProduct($_POST,$_FILES,$id);
    }
?>



<div class="grid_10">
    <div class="box round first grid">
        <h2>Update product</h2>
        <div class="block">        
        <?php  
            if (isset($updateProduct)) {
                echo $updateProduct;
            }
        ?> 
        <?php  
            $getProductById = $pro->getProductById($id); 
            if ($getProductById) {
                while ($resultGetId = $getProductById->fetch_assoc()) {
                    
                
        ?>      
         <form action="" method="post" enctype="multipart/form-data">
            <table class="form">
                <tr>
                    <td>
                        <label>Name</label>
                    </td>
                    <td>
                        <input type="text" name="productName" value="<?php echo $resultGetId['productName'];?>" placeholder="Enter Product Name..." class="medium" />
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Category</label>
                    </td>
                    <td>
                        <select id="select" name="category">
                            <option>--------Select Category--------</option>
                            <?php  
                                $cat = new Category();
                                $catList = $cat->showCategory();
                                if ($catList) {
                                    while ($result = $catList->fetch_assoc()) {
                                        
                                 
                            ?>
                            <option 
                                <?php  
                                    if ($result['catId'] == $resultGetId['catId']){
                                        echo "selected";
                                    }
                                ?>
                                value="<?php echo $result['catId'] ?>">
                                <?php echo $result['catName'] ?>
                            </option>
                            <?php  
                                    }
                                }
                            ?>
                        </select>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Brand</label>
                    </td>
                    <td>
                        <select id="select" name="brand">
                            <option>--------Select Brand--------</option>
                            <?php  
                                $brand = new Brand();
                                $brandList = $brand->showBrand();
                                if ($brandList) {
                                    while ($result = $brandList->fetch_assoc()) {
                                        
                                  
                            ?>
                            <option 
                                <?php  
                                    if ($result['brandId'] == $resultGetId['brandId']){
                                        echo "selected";
                                    }
                                ?>
                                value="<?php echo $result['brandId'] ?>">
                                <?php echo $result['brandName'] ?>
                            </option>
                            <?php  
                                    }
                                }
                            ?>
                        </select>
                    </td>
                </tr>
				
				 <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Description</label>
                    </td>
                    <td>
                        <textarea name="productDesc" class="tinymce"><?php echo $resultGetId['productDesc'];?></textarea>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Price</label>
                    </td>
                    <td>
                        <input value="<?php echo $resultGetId['productPrice'];?>" type="text" name="productPrice" placeholder="Enter Price..." class="medium" />
                    </td>
                </tr>
            
                <tr>
                    <td>
                        <label>Upload Image</label>
                    </td>
                    <td>
                        <img width="80" src="uploads/<?php echo $resultGetId['productImage'];?>" alt="placeholder+image">
                        <input type="file" name="productImage" />
                    </td>
                </tr>
				
				<tr>
                    <td>
                        <label>Product Type</label>
                    </td>
                    <td>
                        <select id="select" name="productType">
                            <option>--------Select Type--------</option>
                            <?php  
                                if ($resultGetId['productType'] == 0 ) {
                                    
                                
                            ?>
                            <option value="1">Featured</option>
                            <option selected="" value="0">Non-Featured</option>
                            <?php  
                                } else {
                                    
                                
                            ?>
                            <option selected="" value="1">Featured</option>
                            <option value="0">Non-Featured</option>
                            <?php  
                                }
                            ?>
                        </select>
                    </td>
                </tr>

				<tr>
                    <td></td>
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
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<!-- Load TinyMCE -->
<?php include 'inc/footer.php';?>


