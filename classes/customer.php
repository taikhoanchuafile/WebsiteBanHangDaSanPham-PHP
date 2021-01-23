<?php  
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/database.php');
	include_once ($filepath.'/../helpers/format.php');
?>
<?php  
	/**
	 * summary
	 */
	class Customer
	{
	    private $db;
	    private $fm;

	    public function __construct()
	    {
	        $this->db = new Database();
	        $this->fm = new Format();
	    }

	    public function insertCustomer($data)
	    {
	    	$name = $this->fm->validation($data['name']);
	    	$city = $this->fm->validation($data['city']);
	    	$zipcode = $this->fm->validation($data['zipcode']);
	    	$email = $this->fm->validation($data['email']);
	    	$address = $this->fm->validation($data['address']);
	    	$country = $this->fm->validation($data['country']);
	    	$phone = $this->fm->validation($data['phone']);
	    	$password = $this->fm->validation($data['password']);

	    	$name = mysqli_real_escape_string($this->db->link, $data['name']);
			$city = mysqli_real_escape_string($this->db->link, $data['city']);
			$zipcode = mysqli_real_escape_string($this->db->link, $data['zipcode']);
			$email = mysqli_real_escape_string($this->db->link, $data['email']);
	    	$address = mysqli_real_escape_string($this->db->link, $data['address']);
			$country = mysqli_real_escape_string($this->db->link, $data['country']);
			$phone = mysqli_real_escape_string($this->db->link, $data['phone']);
			$password = mysqli_real_escape_string($this->db->link, md5($data['password']));

			if($name == "" || $city == "" || $zipcode == "" || $email == "" || $address == "" || $country == "" || $phone =="" || $password =="") {
				$alert = "<span class='text-danger'>Fields must be not empty</span>";
				return $alert;
			}else {
				$checkEmail = "SELECT * FROM `tbl_customer` WHERE `email`='$email' LIMIT 1";
				$resultCheck= $this->db->select($checkEmail);
				if ($resultCheck) {
					$alert = "<span class='text-danger'>Email Already Existed. Please Enter Another Email!</span>";
					return $alert;
				} else {
					$query = "INSERT INTO `tbl_customer`(`name`, `address`, `city`, `country`, `zipcode`, `phone`, `email`, `password`) VALUES ('$name','$address','$city','$country','$zipcode','$phone','$email','$password')";
					$result= $this->db->insert($query);
					if ($result) {
						$alert = "<span class='text-success'>Customer Created Successfully</span>";
						return $alert;
					} else {
						$alert = "<span class='text-danger'>Customer Created Successfully</span>";
						return $alert;
					}
				}
			}
		
	    }

	    public function loginCustomer($data)
	    {
	    	$email = $this->fm->validation($data['email']);
	    	$password = $this->fm->validation($data['password']);

	    	$email = mysqli_real_escape_string($this->db->link, $data['email']);
	    	$password = mysqli_real_escape_string($this->db->link, md5($data['password']));
	    	
	    	if($email == "" || $password =="") {
	    		$alert = "<span class='text-danger'>Email and Password must be not empty</span>";
	    		return $alert;
	    	}else {
	    		$query = "SELECT * FROM `tbl_customer` WHERE `email`='$email' AND `password`='$password' ";
	    		$result= $this->db->select($query);
	    		if ($result) {
	    			$value = $result->fetch_assoc();
	    			Session :: set('customerLogin',true);
	    			Session :: set('customerId',$value['id']);
	    			Session :: set('customerName',$value['name']);
	    			header("Location:order.php");
	    		} else {
	    			$alert = "<span class='text-danger'>Email Or Password Not Exactly</span>";
	    			return $alert;
	    		}
	    	}
	    }
	    
	    public function showInformationCustomer($idCustomer)
	    {
	    	$query="SELECT * FROM `tbl_customer` WHERE `id` = '$idCustomer' LIMIT 1 ";
	    	$result=$this->db->select($query);
	    	return $result;
	    }

	    public function updateCustomer($data,$idCustomer)
	    {
	    	$name = mysqli_real_escape_string($this->db->link, $data['name']);
			//$city = mysqli_real_escape_string($this->db->link, $data['city']);
			$zipcode = mysqli_real_escape_string($this->db->link, $data['zipcode']);
			$email = mysqli_real_escape_string($this->db->link, $data['email']);
	    	$address = mysqli_real_escape_string($this->db->link, $data['address']);
			//$country = mysqli_real_escape_string($this->db->link, $data['country']);
			$phone = mysqli_real_escape_string($this->db->link, $data['phone']);
			//$password = mysqli_real_escape_string($this->db->link, md5($data['password']));
			

			if($name == "" || $zipcode == "" || $email == "" || $address == "" || $phone =="") {
				$alert = "<span class='text-danger'>Fields must be not empty</span>";
				return $alert;
			}else {
				$query = "UPDATE `tbl_customer` SET `name`='$name',`address`='$address',`zipcode`='$zipcode',`phone`='$phone',`email`='$email' WHERE `id`='$idCustomer' ";
				$result= $this->db->update($query);
				if ($result) {
					$alert = "<span class='text-success'>Updated Customer Successfully</span>";
					return $alert;
				} else {
					$alert = "<span class='text-danger'>Updated Customer Successfully</span>";
					return $alert;
				}
			}
	    }
	}
?>