<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php  
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../classes/customer.php');
    include_once ($filepath.'/../helpers/format.php');
?>

<?php  
    $cus = new Customer();
    if (!isset($_GET['customerId']) || $_GET['customerId']==null) {
        echo "<script>window.location = 'inbox.php';</script>";
    } else {
        $idCustomer = $_GET['customerId'];
    }

    // if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //     $catName = $_POST['catName'];
    //     $updateCat = $cat->updateCategory($catName,$id);
    // }
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Customer Information</h2>
               <div class="block copyblock"> 
                <?php 
                    if(isset($updateCat)) {
                        echo $updateCat;
                    }
                ?>
                <?php  
                    $getInformationCustomer = $cus->showInformationCustomer($idCustomer);
                    if ($getInformationCustomer) {
                        while ($result = $getInformationCustomer->fetch_assoc()) {


                ?>
                 <form action="" method="post">
                    <table class="form">
                        <tr>
                            <td>Name</td>
                            <td>
                                <input readonly="readonly" type="text" value="<?php echo $result['name'] ?>" name="name"class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>Phone</td>
                            <td>
                                <input readonly="readonly" type="text" value="<?php echo $result['phone'] ?>" name="name"class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>City</td>
                            <td>
                                <input readonly="readonly" type="text" value="<?php echo $result['city'] ?>" name="name"class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>Country</td>
                            <td>
                                <input readonly="readonly" type="text" value="<?php echo $result['country'] ?>" name="name"class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>Address</td>
                            <td>
                                <input readonly="readonly" type="text" value="<?php echo $result['address'] ?>" name="name"class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>Zipcode</td>
                            <td>
                                <input readonly="readonly" type="text" value="<?php echo $result['zipcode'] ?>" name="name"class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>
                                <input readonly="readonly" type="text" value="<?php echo $result['email'] ?>" name="name"class="medium" />
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