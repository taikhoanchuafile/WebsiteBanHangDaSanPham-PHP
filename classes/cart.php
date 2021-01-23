<?php  
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/database.php');
	include_once ($filepath.'/../helpers/format.php');
?>
<?php  
	class Cart
	{
	    private $db;
	    private $fm;

	    public function __construct()
	    {
	        $this->db = new Database();
	        $this->fm = new Format();
	    }

	    public function addToCart($quantity,$id)
	    {
	    	$quantity = $this->fm->validation($quantity);
	    	$quantity = mysqli_real_escape_string($this->db->link,$quantity);
	    	$id = mysqli_real_escape_string($this->db->link,$id);
	    	$sessionId = session_id();

	    	$query="SELECT * FROM `tbl_product` WHERE `productId` = '$id'";
	    	$result = $this->db->select($query)->fetch_assoc();
	    	//echo print_r($result);
	    	
	    	$productName = $result['productName'];
	    	$productPrice = $result['productPrice'];
	    	$productImage = $result['productImage'];

	    	//Kiểm tra xem hàng đã thêm vào chưa thông qua SessionId
	    	$checkCart = "SELECT * FROM `tbl_cart` WHERE `productId` = '$id' AND  `sessionId` ='$sessionId'" ;
	    	$resultCheck = $this->db->select($checkCart);
	    	if ($resultCheck) {
	    		$alert = "Product Already Added";
	    		return $alert;
	    	} else {
	    		//chưa có thì thêm
	    		$query="INSERT INTO `tbl_cart`(`productId`, `sessionId`, `productName`, `productPrice`, `quantity`, `productImage`) VALUES ('$id','$sessionId','$productName','$productPrice','$quantity','$productImage')";
	    		$insertCart = $this->db->insert($query);

	    		if ($result) {
	    			header("Location:cart.php");
	    		} else {
	    			header("Location:404.php");
	    		}

	    	}
	    }

	    public function getProductCart()
	    {
	    	$sessionId = session_id();
	    	$query= "SELECT * FROM `tbl_cart` WHERE  `sessionId` = '$sessionId' ";
	    	$result = $this->db->select($query);
	    	return $result;
	    }

	    public function updateQuantityCart($quantity,$cartId)
	    {
	    	$quantity = mysqli_real_escape_string($this->db->link,$quantity);
	    	$cartId = mysqli_real_escape_string($this->db->link,$cartId);

	    	$query="UPDATE `tbl_cart` SET `quantity`='$quantity' WHERE `cartId`='$cartId'";
	    	$result = $this->db->update($query);
	    	if ($result) {
	    		header("Location:cart.php");
	    		$alert = "<span class='text-success'>Update quantity product successfully</span>";
	    		return $alert;
	    	} else {
	    		$alert = "<span class='text-warning'>Update quantity product not successfully</span>";
	    		return $alert;
	    	}
	    }

	    public function delProductInCart($id)
	    {
	    	$query = "DELETE FROM tbl_cart WHERE cartId = '$id' ";
	    	$result = $this->db->delete($query);

	    	if ($result) {
	    		header("Location:cart.php");
	    	} else {
	    		$alert = "<span class='error'>Deleted Product Not Successfully</span>";
	    		return $alert;
	    	}
	    }

	    public function delProductInWishlist($idcustomer,$productId)
	    {
	    	$query = "DELETE FROM tbl_wishlist WHERE customerId = '$idcustomer' AND productId = '$productId'  ";
	    	$result = $this->db->delete($query);
	    	return $result;
	    }

	    public function checkCart()
	    {
	    	$sessionId = session_id();
	    	$query= "SELECT * FROM `tbl_cart` WHERE  `sessionId` = '$sessionId' ";
	    	$result = $this->db->select($query);
	    	return $result;
	    }

	    public function checkOrder($idCustomer)
	    {
	    	$query="SELECT * FROM `tbl_order` WHERE `customerId` ='$idCustomer'";
	    	$result = $this->db->select($query);
	    	return $result;
	    }
	    public function delDataCardBySessionId()
	    {
	    	$sessionId = session_id();
	    	$query="DELETE FROM `tbl_cart` WHERE sessionId = '$sessionId' ";
	    	$result = $this->db->delete($query);
	    	return $result;
	    }

	    public function delDataCompareByCustomerId($idCustomer)
	    {
	    	$query="DELETE FROM `tbl_compare` WHERE customerId = '$idCustomer' ";
	    	$result = $this->db->delete($query);
	    	return $result;
	    }

	    public function delDataWishlistByCustomerId($idCustomer)
	    {
	    	$query="DELETE FROM `tbl_wishlist` WHERE customerId = '$idCustomer' ";
	    	$result = $this->db->delete($query);
	    	return $result;
	    }

	    public function insertOrder($idCustomer)
	    {
	    	$sessionId = session_id();
	     	$query="SELECT * FROM `tbl_cart` WHERE `sessionId`='$sessionId' ";
	     	$getProduct=$this->db->select($query);
	     	if ($getProduct) {
	     		while ($result = $getProduct->fetch_assoc()) {
	     		    $productId = $result['productId'];
	     		    $productName = $result['productName'];
	     		    $quantity = $result['quantity'];
	     		    $productPrice = $result['productPrice'] *$quantity;
	     		    $productImage = $result['productImage'];
	     		    $customerId = $idCustomer;

	     		    $queryOrder = "INSERT INTO `tbl_order`(`productId`, `productName`, `customerId`, `quantity`, `productPrice`, `productImage`) VALUES ('$productId','$productName','$customerId','$quantity','$productPrice','$productImage')";
	     		    $insertQueryOrder = $this->db->insert($queryOrder);
	     		}
	     	}
	    }

	    public function getAmuontPrice($idCustomer)
	    {
	    	$query="SELECT * FROM `tbl_order` WHERE `customerId` ='$idCustomer'";
	    	$result = $this->db->select($query);
	    	return $result;
	    }

	    public function getCartOrdered($idCustomer)
	    {
	    	$query="SELECT * FROM `tbl_order` WHERE `customerId` ='$idCustomer'";
	    	$result = $this->db->select($query);
	    	return $result;
	    }

	    public function getInboxCart()
	    {
	    	$query="SELECT * FROM `tbl_order` ORDER BY oderDate";
	    	$result = $this->db->select($query);
	    	return $result;
	    }

	    public function shifted($id,$time,$price)
	    {
	    	$id = mysqli_real_escape_string($this->db->link,$id);
	    	$time = mysqli_real_escape_string($this->db->link,$time);
	    	$price = mysqli_real_escape_string($this->db->link,$price);

	    	$query="UPDATE `tbl_order` SET `status`='1' WHERE `orderId`='$id' AND `productPrice`='$price'  AND `oderDate`='$time' ";
	    	$result = $this->db->update($query);
	    	if ($result) {
	    		$alert = "<span class='text-success'>Update Order successfully</span>";
	    		return $alert;
	    	} else {
	    		$alert = "<span class='text-warning'>Update Order not successfully</span>";
	    		return $alert;
	    	}
	    }

	    public function delShifted($id,$time,$price)
	    {
	    	$id = mysqli_real_escape_string($this->db->link,$id);
	    	$time = mysqli_real_escape_string($this->db->link,$time);
	    	$price = mysqli_real_escape_string($this->db->link,$price);

	    	$query = "DELETE FROM `tbl_order` WHERE `orderId`='$id' AND `productPrice`='$price'  AND `oderDate`='$time' ";
	    	$result = $this->db->delete($query);

	    	if ($result) {
	    		$alert = "<span class='text-success'>Deleted Order Successfully</span>";
	    		return $alert;
	    	} else {
	    		$alert = "<span class='text-warning'>Deleted Order Not Successfully</span>";
	    		return $alert;
	    	}
	    }

	    public function comfirmShifted($id,$time,$price)
	    {
	    	$id = mysqli_real_escape_string($this->db->link,$id);
	    	$time = mysqli_real_escape_string($this->db->link,$time);
	    	$price = mysqli_real_escape_string($this->db->link,$price);

	    	$query="UPDATE `tbl_order` SET `status`='2' WHERE `customerId`='$id' AND `productPrice`='$price'  AND `oderDate`='$time' ";
	    	$result = $this->db->update($query);
	    	return $result;
	    }
	}
?>