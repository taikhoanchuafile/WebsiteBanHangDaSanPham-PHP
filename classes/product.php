<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/database.php');
	include_once ($filepath.'/../helpers/format.php');
 ?>
<?php 
	/**
	 * 
	 */
	class Product
	{
		
		private $db;
		private $fm;

		public function __construct()
		{
			$this->db = new Database();
			$this->fm = new Format();
		}
		public function searchProduct($tukhoa)
		{
			$tukhoa = $this->fm->validation($tukhoa);
			$tukhoa = mysqli_real_escape_string($this->db->link,$tukhoa);

			$query = "SELECT * FROM tbl_product WHERE productName LIKE '%$tukhoa%' ";
			$result = $this->db->select($query);
			return $result;


		}
		public function insertProduct($data,$files){
			$productName = mysqli_real_escape_string($this->db->link, $data['productName']);
			$category = mysqli_real_escape_string($this->db->link, $data['category']);
			$brand = mysqli_real_escape_string($this->db->link, $data['brand']);
			$productDesc = mysqli_real_escape_string($this->db->link, $data['productDesc']);
			$productPrice = mysqli_real_escape_string($this->db->link, $data['productPrice']);
			$productType = mysqli_real_escape_string($this->db->link, $data['productType']);

			//Kiểm tra hình ảnh và lấy hình ảnh cho vào file "uploads"
			$permited = array('jpg', 'jpeg', 'png','gif');
			$file_name = $_FILES['productImage']['name'];
			$file_size = $_FILES['productImage']['size'];
			$file_temp = $_FILES['productImage']['tmp_name'];

			$div = explode('.',$file_name); // tách file [tên,đuôi hình]
			$file_ext = strtolower(end($div)); // strtolower() biến chữ hoa thành chữ thường , end() lấy phần cuối(đuôi hình)
			$unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;  //substr() lấy chuỗi => tạo ra 915fb0d30f  .jpg -> tạo tên hình ngẫu nhiên
			$uploaded_imge = "uploads/".$unique_image;

			if($productName == "" || $category == "" || $brand == "" || $productDesc == "" || $productPrice == "" || $productType == "" || $file_name =="") {
				$alert = "<span class='error'>Fields must be not empty</span>";
				return $alert;
			} else {
					//nếu người dùng chọn ảnh : có file_name.
					if ($file_size > 2097152) {
						//echo "<span class='error'>Image Size  should be less then 2MB!</span>";
						$alert = "<span class='error'>Image Size  should be less then 2MB!</span>";
					return $alert;
					} elseif (in_array($file_ext, $permited) === false) {
						//echo "<span class='error'>You can upload only:-".implode(', ', $permited)."</span>";
						$alert = "<span class='error'>You can upload only:-".implode(', ', $permited)."</span>";
						return $alert;
					}
					move_uploaded_file($file_temp, $uploaded_imge);
					$query = "INSERT INTO tbl_product(productName,catId,brandId,productDesc,productType,productPrice,productImage) VALUES('$productName','$category','$brand','$productDesc','$productType','$productPrice','$unique_image')";
					$result = $this->db->insert($query);
					
					if ($result) {
						$alert = "<span class='success'>Inserted Product Successfully</span>";
						return $alert;
					} else {
						$alert = "<span class='error'>Inserted Product Not Successfully</span>";
						return $alert;
					}
				}

		}

		public function insertSlider($data,$file)
		{
			$sliderName = mysqli_real_escape_string($this->db->link, $data['sliderName']);
			$sliderType = mysqli_real_escape_string($this->db->link, $data['sliderType']);
			

			//Kiểm tra hình ảnh và lấy hình ảnh cho vào file "uploads"
			$permited = array('jpg', 'jpeg', 'png','gif');
			$file_name = $_FILES['sliderImage']['name'];
			$file_size = $_FILES['sliderImage']['size'];
			$file_temp = $_FILES['sliderImage']['tmp_name'];

			$div = explode('.',$file_name); // tách file [tên,đuôi hình]
			$file_ext = strtolower(end($div)); // strtolower() biến chữ hoa thành chữ thường , end() lấy phần cuối(đuôi hình)
			$unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;  //substr() lấy chuỗi => tạo ra 915fb0d30f  .jpg -> tạo tên hình ngẫu nhiên
			$uploaded_imge = "uploads/".$unique_image;

			if($sliderName == "" || $sliderType == "" || $file_name =="") {
				$alert = "<span class='error'>Fields must be not empty</span>";
				return $alert;
			} else {
					//nếu người dùng chọn ảnh : có file_name.
					if ($file_size > 2097152) {
						//echo "<span class='error'>Image Size  should be less then 2MB!</span>";
						$alert = "<span class='error'>Image Size  should be less then 2MB!</span>";
					return $alert;
					} elseif (in_array($file_ext, $permited) === false) {
						//echo "<span class='error'>You can upload only:-".implode(', ', $permited)."</span>";
						$alert = "<span class='error'>You can upload only:-".implode(', ', $permited)."</span>";
						return $alert;
					}
					move_uploaded_file($file_temp, $uploaded_imge);
					$query = "INSERT INTO `tbl_slider`(`sliderName`, `sliderImage`, `sliderType`) VALUES ('$sliderName','$unique_image','$sliderType')";
					$result = $this->db->insert($query);
					
					if ($result) {
						$alert = "<span class='success'>Inserted Slider Successfully</span>";
						return $alert;
					} else {
						$alert = "<span class='error'>Inserted Slider Not Successfully</span>";
						return $alert;
					}
				}
		}

		public function updateProduct($data,$files,$id){

			$productName = mysqli_real_escape_string($this->db->link, $data['productName']);
			$category = mysqli_real_escape_string($this->db->link, $data['category']);
			$brand = mysqli_real_escape_string($this->db->link, $data['brand']);
			$productDesc = mysqli_real_escape_string($this->db->link, $data['productDesc']);
			$productPrice = mysqli_real_escape_string($this->db->link, $data['productPrice']);
			$productType = mysqli_real_escape_string($this->db->link, $data['productType']);

			//Kiểm tra hình ảnh và lấy hình ảnh cho vào file "uploads"
			$permited = array('jpg', 'jpeg', 'png','gif');
			$file_name = $_FILES['productImage']['name'];
			$file_size = $_FILES['productImage']['size'];
			$file_temp = $_FILES['productImage']['tmp_name'];

			$div = explode('.',$file_name); // tách file [tên,đuôi hình]
			$file_ext = strtolower(end($div)); // strtolower() biến chữ hoa thành chữ thường , end() lấy phần cuối(đuôi hình)
			$unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;  //substr() lấy chuỗi => tạo ra 915fb0d30f  .jpg -> tạo tên hình ngẫu nhiên
			$uploaded_imge = "uploads/".$unique_image;

			if ($productName == "" || $category == "" || $brand == "" || $productDesc == "" || $productPrice == "" || $productType == "") {
				$alert = "<span class='error'>Fields must be not empty</span>";
				return $alert;
			} else {
				
				if (!empty($file_name)) {
					//nếu người dùng chọn ảnh : có file_name.
					if ($file_size > 2097152) {
						//echo "<span class='error'>Image Size  should be less then 2MB!</span>";
						$alert = "<span class='error'>Image Size  should be less then 2MB!</span>";
					return $alert;
					} elseif (in_array($file_ext, $permited) === false) {
						//echo "<span class='error'>You can upload only:-".implode(', ', $permited)."</span>";
						$alert = "<span class='error'>You can upload only:-".implode(', ', $permited)."</span>";
						return $alert;
					}

					//Xóa hình trong thư mục uploads thông qua productId
					$q = "SELECT `productImage` FROM `tbl_product` WHERE `productId`='$id'";
					$r= $this->db->select($q);
					if ($r) {
						while ($kq = $r->fetch_assoc()) {
							unlink("uploads/".$kq['productImage']."");
						}
					}
					

					move_uploaded_file($file_temp, $uploaded_imge);
					$query = "UPDATE `tbl_product` SET `productName`='$productName',`catId`='$category',`brandId`='$brand',`productDesc`='$productDesc',`productType`='$productType',`productPrice`='$productPrice',`productImage`='$unique_image' WHERE `productId`='$id' ";

					$result = $this->db->update($query);
					if ($result) {
						$alert = "<span class='success'>Updated Product Successfully</span>";
						return $alert;
					} else {
						$alert = "<span class='error'>Updated Product Not Successfully</span>";
						return $alert;
					}
				} else {
					//người dùng không chọn ảnh : không có file_name.
					$query = "UPDATE `tbl_product` SET `productName`='$productName',`catId`='$category',`brandId`='$brand',`productDesc`='$productDesc',`productType`='$productType',`productPrice`='$productPrice'                               WHERE `productId`='$id' ";
					$result = $this->db->update($query);
					if ($result) {
						$alert = "<span class='success'>Updated Product Successfully</span>";
						return $alert;
					} else {
						$alert = "<span class='error'>Updated Product Not Successfully</span>";
						return $alert;
					}
				}
			}	
		}
		
		public function updateTypeSlider($id,$type)
		{
			$sliderType = mysqli_real_escape_string($this->db->link, $type);

			$query = "UPDATE `tbl_slider` SET `sliderType`='$sliderType' WHERE `sliderId`='$id' ";
			$result = $this->db->update($query);
		}

		public function updateSlider($data,$files,$id)
		{
			$sliderName = mysqli_real_escape_string($this->db->link, $data['sliderName']);
			$sliderType = mysqli_real_escape_string($this->db->link, $data['sliderType']);
			

			//Kiểm tra hình ảnh và lấy hình ảnh cho vào file "uploads"
			$permited = array('jpg', 'jpeg', 'png','gif');
			$file_name = $_FILES['sliderImage']['name'];
			$file_size = $_FILES['sliderImage']['size'];
			$file_temp = $_FILES['sliderImage']['tmp_name'];

			$div = explode('.',$file_name); // tách file [tên,đuôi hình]
			$file_ext = strtolower(end($div)); // strtolower() biến chữ hoa thành chữ thường , end() lấy phần cuối(đuôi hình)
			$unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;  //substr() lấy chuỗi => tạo ra 915fb0d30f  .jpg -> tạo tên hình ngẫu nhiên
			$uploaded_imge = "uploads/".$unique_image;

			if ($sliderName == "" || $sliderType == "") {
				$alert = "<span class='error'>Fields must be not empty</span>";
				return $alert;
			} else {
				
				if (!empty($file_name)) {
					//nếu người dùng chọn ảnh : có file_name.
					if ($file_size > 2097152) {
						//echo "<span class='error'>Image Size  should be less then 2MB!</span>";
						$alert = "<span class='error'>Image Size  should be less then 2MB!</span>";
					return $alert;
					} elseif (in_array($file_ext, $permited) === false) {
						//echo "<span class='error'>You can upload only:-".implode(', ', $permited)."</span>";
						$alert = "<span class='error'>You can upload only:-".implode(', ', $permited)."</span>";
						return $alert;
					}

					//Xóa hình trong thư mục uploads thông qua productId
					$q = "SELECT * FROM `tbl_slider` WHERE `sliderId`='$id'";
					$r= $this->db->select($q);
					if ($r) {
						while ($kq = $r->fetch_assoc()) {
							unlink("uploads/".$kq['sliderImage']."");
						}
					}
					

					move_uploaded_file($file_temp, $uploaded_imge);
					$query = "UPDATE `tbl_slider` SET `sliderName`='$sliderName',`sliderImage`='$unique_image',`sliderType`='$sliderType' WHERE `sliderId`='$id' ";
					$result = $this->db->update($query);

					if ($result) {
						$alert = "<span class='success'>Updated Slider Successfully</span>";
						return $alert;
					} else {
						$alert = "<span class='error'>Updated Slider Not Successfully</span>";
						return $alert;
					}
				} else {
					//người dùng không chọn ảnh : không có file_name.
					$query = "UPDATE `tbl_slider` SET `sliderName`='$sliderName',                               `sliderType`='$sliderType' WHERE `sliderId`='$id' ";
					$result = $this->db->update($query);
					if ($result) {
						$alert = "<span class='success'>Updated Slider Successfully</span>";
						return $alert;
					} else {
						$alert = "<span class='error'>Updated Slider Not Successfully</span>";
						return $alert;
					}
				}
			}	
		}

		public function deleteSlider($id)
		{
			//Xóa hình trong thư mục thông qua productId
			$q = "SELECT * FROM `tbl_slider` WHERE `sliderId`='$id'";
			$r= $this->db->select($q);
			if ($r) {
				while ($kq = $r->fetch_assoc()) {
					unlink("uploads/".$kq['sliderImage']."");
				}
			}

			$query = "DELETE FROM `tbl_slider` WHERE `sliderId`='$id' ";
			$result = $this->db->delete($query);
			
			if ($result) {
				$alert = "<span class='success'>Deleted Slider Successfully</span>";
				return $alert;
			} else {
				$alert = "<span class='error'>Deleted Slider Not Successfully</span>";
				return $alert;
			}
		}

		public function deleteProduct($id){

			//Xóa hình trong thư mục thông qua productId
			$q = "SELECT `productImage` FROM `tbl_product` WHERE `productId`='$id'";
			$r= $this->db->select($q);
			if ($r) {
				while ($kq = $r->fetch_assoc()) {
					unlink("uploads/".$kq['productImage']."");
				}
			}

			$query = "DELETE FROM tbl_product WHERE productId = '$id' ";
			$result = $this->db->delete($query);

			
		}

		public function showProduct(){
			$query = "SELECT tbl_product.*,tbl_category.catName,tbl_brand.brandName 
			FROM tbl_product 
				INNER JOIN tbl_category ON tbl_product.catId = tbl_category.catId 
				INNER JOIN tbl_brand ON tbl_product.brandId = tbl_brand.brandId
			ORDER BY tbl_product.productId DESC";
			$result = $this->db->select($query);
			return $result;
		}

		public function showSlider()
		{
			$query = "SELECT * FROM `tbl_slider` ORDER BY `sliderId` DESC";
			$result = $this->db->select($query);
			return $result;
		}

		public function getSlider()
		{
			$query = "SELECT * FROM `tbl_slider`WHERE `sliderType` = '1' ORDER BY `sliderId` DESC";
			$result = $this->db->select($query);
			return $result;
		}

		public function getSliderBySliderId($id)
		{
			$query = "SELECT * FROM `tbl_slider`WHERE `sliderId` = '$id'";
			$result = $this->db->select($query);
			return $result;
		}

		public function getProductById($id){
			$query = "SELECT * FROM tbl_product WHERE productId = '$id' LIMIT 1";
			$result = $this->db->select($query);
			return $result;
		}

		public function getFeatheredProduct()
		{
			$sptungtrang = 4;
			if (!isset($_GET['trang'])) {
				$trang = 1;
			} else {
				$trang = $_GET['trang'];
			}
			$tungtrang = ($trang-1)*$sptungtrang;

			$query = "SELECT * FROM tbl_product WHERE productType = '1' LIMIT $tungtrang,$sptungtrang ";
			$result = $this->db->select($query);
			return $result;
		}

		public function getNewProduct()
		{
			$sptungtrang = 4;
			if (!isset($_GET['trang'])) {
				$trang = 1;
			} else {
				$trang = $_GET['trang'];
			}
			$tungtrang = ($trang-1)*$sptungtrang;

			$query = "SELECT * FROM tbl_product ORDER BY productId DESC LIMIT $tungtrang,$sptungtrang";
			$result = $this->db->select($query);
			return $result;
		}

		public function getAllProduct()
		{
			
			$query = "SELECT * FROM tbl_product ";
			$result = $this->db->select($query);	
			return $result;
		}

		public function showProductById($id)
		{
			$query = "SELECT tbl_product.*,tbl_category.catName,tbl_brand.brandName 
				FROM tbl_product
					INNER JOIN tbl_category ON tbl_product.catId = tbl_category.catID
					INNER JOIN tbl_brand ON tbl_product.brandId = tbl_brand.brandId
				WHERE tbl_product.productId = '$id'";
				$result = $this->db->select($query);
				return $result;
		}

		public function showProductByCat($id)
		{
			$query = "SELECT * FROM tbl_product WHERE catId = '$id' ORDER BY productId DESC";
			$result = $this->db->select($query);
			return $result;
		}

		public function showProductByCategory($id)
		{
			$query = "SELECT * FROM tbl_product WHERE catId = '$id' ORDER BY productId DESC";
			$result = $this->db->select($query);
			return $result;
		}

		public function showProductByBrandId($id)
		{
			$query = "SELECT * FROM tbl_product WHERE brandId = '$id' ORDER BY productId DESC";
			$result = $this->db->select($query);
			return $result;
		}

		public function showProductHeaderByBrandId($idOfBrandName)
			{
				$query = "SELECT * FROM tbl_product WHERE brandId = '$idOfBrandName' ORDER BY productId DESC LIMIT 1";
				$result = $this->db->select($query);
				return $result;
			}	

		public function getProductCompareByCustomerId($idcustomer)
			{
				$query= "SELECT * FROM `tbl_compare` WHERE `customerId` ='$idcustomer' ORDER BY compareId DESC " ;
				$result = $this->db->select($query);
				return $result;
			}	

		public function getProductWishlistByCustomerId($idcustomer)
		{
			$query= "SELECT * FROM `tbl_wishlist` WHERE `customerId` ='$idcustomer' ORDER BY wishlistId DESC " ;
			$result = $this->db->select($query);
			return $result;
		}

		public function insertCompare($productId,$idcustomer)
		{
			$productId = mysqli_real_escape_string($this->db->link,$productId);
			$idcustomer = mysqli_real_escape_string($this->db->link,$idcustomer);

			$queryS = "SELECT * FROM tbl_product WHERE productId ='$productId' ";
			$resultSelect = $this->db->select($queryS)->fetch_assoc();

			$productName = $resultSelect['productName'];
			$productPrice = $resultSelect['productPrice'];
			$productImage = $resultSelect['productImage'];

			$checkCompare = "SELECT * FROM `tbl_compare` WHERE `productId` ='$productId' AND `customerId` ='$idcustomer' " ;
	    	$resultCheck = $this->db->select($checkCompare);
	    	if ($resultCheck) {
	    		$alert = "<span class = 'text-danger'>Product Already Added to Compare</span>";
	    		return $alert;
	    	} else {
	    		//chưa có thì thêm
	    		$queryI = "INSERT INTO `tbl_compare`(`customerId`, `productId`, `productName`, `productPrice`, `productImage`) VALUES ('$idcustomer','$productId','$productName','$productPrice','$productImage')";
	    		$resultInsert = $this->db->insert($queryI);

	    		if ($resultInsert) {
	    			$alert = "<span class='text-success'>Added Compare Successfully</span>";
	    			return $alert;
	    		} else {
	    			$alert = "<span class='text-danger'>Added Compare Not Successfully</span>";
	    			return $alert;
	    		}

	    	}
		}

		public function insertWishlist($productId,$idcustomer)
		{
			$productId = mysqli_real_escape_string($this->db->link,$productId);
			$idcustomer = mysqli_real_escape_string($this->db->link,$idcustomer);

			$queryS = "SELECT * FROM tbl_product WHERE productId ='$productId' ";
			$resultSelect = $this->db->select($queryS)->fetch_assoc();

			$productName = $resultSelect['productName'];
			$productPrice = $resultSelect['productPrice'];
			$productImage = $resultSelect['productImage'];

			$checkCompare = "SELECT * FROM `tbl_wishlist` WHERE `productId` ='$productId' AND `customerId` ='$idcustomer' " ;
		    $resultCheck = $this->db->select($checkCompare);

		    if ($resultCheck) {
		    	$alert = "<span class = 'text-danger'>Product Already Added to Wishlist</span>";
		    	return $alert;
		    } else {
		    	//chưa có thì thêm
		    	$queryI = "INSERT INTO `tbl_wishlist`(`customerId`, `productId`, `productName`, `productPrice`, `productImage`) VALUES ('$idcustomer','$productId','$productName','$productPrice','$productImage')";
		    	$resultInsert = $this->db->insert($queryI);

		    	if ($resultInsert) {
		    		$alert = "<span class='text-success'>Added To Wishlist Successfully</span>";
		    		return $alert;
		    	} else {
		    		$alert = "<span class='text-danger'>Added To Wishlist Not Successfully</span>";
		    		return $alert;
		    	}

		    }
		}

	}
 ?>