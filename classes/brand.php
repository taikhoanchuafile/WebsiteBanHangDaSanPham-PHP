<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/database.php');
	include_once ($filepath.'/../helpers/format.php');
 ?>
<?php 
	/**
	 * 
	 */
	class Brand
	{
		
		private $db;
		private $fm;

		public function __construct()
		{
			$this->db = new Database();
			$this->fm = new Format();
		}

		public function insertBrand($brandName){

			$brandName = $this->fm->validation($brandName);
			$brandName = mysqli_real_escape_string($this->db->link, $brandName);

			if(empty($brandName)) {
				$alert = "<span class='error'>Brand must be not empty</span>";
				return $alert;
			} else {
				$query = "INSERT INTO tbl_brand(brandName) VALUES('$brandName')";
				$result = $this->db->insert($query);
				
				if ($result) {
					$alert = "<span class='success'>Inserted Brand Successfully</span>";
					return $alert;
				} else {
					$alert = "<span class='error'>Inserted Brand Not Successfully</span>";
					return $alert;
				}
				
			}

		}

		public function updateBrand($brandName,$id){

			$brandName = $this->fm->validation($brandName);

			$brandName = mysqli_real_escape_string($this->db->link,$brandName);
			$id = mysqli_real_escape_string($this->db->link,$id);

			if (empty($brandName)) {
				$alert = "<span class='error'>Category must be not empty</span>";
				return $alert;
			} else {
				$query = "UPDATE tbl_brand SET brandName = '$brandName' WHERE brandId = '$id' ";
				$result = $this->db->update($query);
				if ($result) {
					$alert = "<span class='success'>Updated Brand Successfully</span>";
					return $alert;
				} else {
					$alert = "<span class='error'>Updated Brand Not Successfully</span>";
					return $alert;
				}
			}
		}
		
		public function delBrand($id){
			$qs= "SELECT * FROM tbl_product WHERE brandId = '$id'";
			$rs= $this->db->select($qs);
			if ($rs) {
				$alert = "<span class='error'>Brand must be delete after deleted product</span>";
				return $alert;
			} else {
				$query = "DELETE FROM tbl_brand WHERE brandId = '$id' ";
				$result = $this->db->delete($query);
				if ($result) {
					$alert = "<span class='success'>Deleted Brand Successfully</span>";
					return $alert;
				} else {
					$alert = "<span class='error'>Deleted Brand Not Successfully</span>";
					return $alert;
				}
			}


			
		}

		public function showBrand(){
			$query = "SELECT * FROM tbl_brand";
			$result = $this->db->select($query);
			return $result;
		}

		public function getBrandById($id){
			$query = "SELECT * FROM tbl_brand WHERE brandId = '$id'";
			$result = $this->db->select($query);
			return $result;
		}

		public function showBrandFour()
		{
			$query = "SELECT * FROM tbl_brand ORDER BY brandName DESC LIMIT 4";
			$result = $this->db->select($query);
			return $result;
		}


	}
 ?>