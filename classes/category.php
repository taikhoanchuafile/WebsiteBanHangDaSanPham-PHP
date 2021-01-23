<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/database.php');
	include_once ($filepath.'/../helpers/format.php');
 ?>
<?php 
	/**
	 * 
	 */
	class Category
	{
		
		private $db;
		private $fm;

		public function __construct()
		{
			$this->db = new Database();
			$this->fm = new Format();
		}

		public function insertCategory($catName){

			$catName = $this->fm->validation($catName);
			$catName = mysqli_real_escape_string($this->db->link, $catName);

			if(empty($catName)) {
				$alert = "<span class='error'>Category must be not empty</span>";
				return $alert;
			} else {
				$query = "INSERT INTO tbl_category(catName) VALUES('$catName')";
				$result = $this->db->insert($query);
				
				if ($result) {
					$alert = "<span class='success'>Inserted Category Successfully</span>";
					return $alert;
				} else {
					$alert = "<span class='error'>Inserted Category Not Successfully</span>";
					return $alert;
				}
				
			}

		}

		public function updateCategory($catName,$id){

			$catName = $this->fm->validation($catName);

			$catName = mysqli_real_escape_string($this->db->link,$catName);
			$id = mysqli_real_escape_string($this->db->link,$id);

			if (empty($catName)) {
				$alert = "<span class='error'>Category must be not empty</span>";
				return $alert;
			} else {
				$query = "UPDATE tbl_category SET catName = '$catName' WHERE catId = '$id' ";
				$result = $this->db->update($query);
				if ($result) {
					$alert = "<span class='success'>Updated Category Successfully</span>";
					return $alert;
				} else {
					$alert = "<span class='error'>Updated Category Not Successfully</span>";
					return $alert;
				}
			}
		}
		
		public function delCategory($id){
			$qs= "SELECT * FROM tbl_product WHERE catId = '$id'";
			$rs= $this->db->select($qs);
			if ($rs) {
				$alert = "<span class='error'>Category must be delete after deleted product</span>";
				return $alert;
			} else {
				$query = "DELETE FROM tbl_category WHERE catId = '$id' ";
				$result = $this->db->delete($query);
				if ($result) {
					$alert = "<span class='success'>Deleted Category Successfully</span>";
					return $alert;
				} else {
					$alert = "<span class='error'>Deleted Category Not Successfully</span>";
					return $alert;
				}
			}
		}

		public function showCategory(){
			$query = "SELECT * FROM tbl_category";
			$result = $this->db->select($query);
			return $result;
		}

		public function showCategoryFrontend(){
			$query = "SELECT * FROM tbl_category";
			$result = $this->db->select($query);
			return $result;
		}
		
		public function getCategoryById($id){
			$query = "SELECT * FROM tbl_category WHERE catId = '$id'";
			$result = $this->db->select($query);
			return $result;
		}




	}
 ?>