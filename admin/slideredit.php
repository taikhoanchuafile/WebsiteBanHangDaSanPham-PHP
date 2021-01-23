<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php 
    $filepath = realpath(dirname(__FILE__));
    include ($filepath.'/../classes/product.php');
?>  
<?php  
    if (!isset($_GET['sliderId']) || $_GET['sliderId']==null) {
        echo "<script>window.location = '404.php'</script>";
    } else {
        $id = $_GET['sliderId'];
    }
?>
<?php  
    $pro = new Product();
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
        $updateSlider = $pro->updateSlider($_POST,$_FILES,$id);
    }
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Update Slider</h2>
    <div class="block"> 
    <!-- <?php  
        if (isset($insertSlider)) {
            echo $insertSlider;
        }
    ?>  -->             
         <form action="" method="post" enctype="multipart/form-data">
            <?php  
                $getSliderBySliderId = $pro->getSliderBySliderId($id);
                if ($getSliderBySliderId) {
                    while ($resultGetSliderBySliderId = $getSliderBySliderId->fetch_assoc()) {
                        
                    
            ?>
            <table class="form">     
                <tr>
                    <td>
                        <label>Title</label>
                    </td>
                    <td>
                        <input value="<?php echo $resultGetSliderBySliderId['sliderName']; ?>" type="text" name="sliderName" placeholder="Enter Slider Title..." class="medium" />
                    </td>
                </tr>           
    
                <tr>
                    <td>
                        <label>Upload Image</label>
                    </td>
                    <td>
                        <img src="uploads/<?php echo $resultGetSliderBySliderId['sliderImage']; ?>" alt="image">
                        <input type="file" name="sliderImage"/>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Type</label>
                    </td>
                    <td>
                        <select name="sliderType" class="custom-select custom-select-lg|custom-select-sm">
                        <?php  
                            if ($resultGetSliderBySliderId['sliderType'] == 1) {
                                
                            
                        ?>
                          <option selected="" value="1">On</option>
                          <option value="0">Off</option>
                        <?php  
                            } else {
                                
                            
                        ?>
                        <option  value="1">On</option>
                        <option selected="" value="0">Off</option>
                        <?php  
                            }
                        ?>
                        </select>
                    </td>
                </tr>
				<tr>
                    <td></td>
                    <td>
                        <input class="btn btn-primary" type="submit" name="submit" Value="Update" />
                    </td>
                </tr>
            </table>
            <?php 
                    }
                } 
            ?>
            </form>
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