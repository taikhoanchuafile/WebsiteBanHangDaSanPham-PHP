<?php 
	include 'inc/header.php';
	//include 'inc/slider.php';
?>

<?php  
	$checkLogin = Session :: get('customerLogin');
	if ($checkLogin) {
		header("Location:order.php");
	}
?>

<?php  
	if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register'])) {
	    $insertCustomer = $cus->insertCustomer($_POST);
	}
?>
<?php  
	if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
	    $loginCustomer = $cus->loginCustomer($_POST);
	}
?>
 <div class="main">
    <div class="container row mt-2 mb-2">
    	 <div class="login_panel col-sm-3">
        	<h3>Existing Customers</h3>
        	<?php  
        		if (isset($loginCustomer)) {
        			echo $loginCustomer;
        		}

        	?>
        	<form action="" method="post" >
                	<input type="text" name="email" class="field" placeholder="Enter Username...">
                    <input type="password" name="password" class="field" placeholder="Enter Name...">
               
                 <p class="note">If you forgot your passoword just enter your email and click <a href="#">here</a></p>
                    <div class="buttons">
                    	<div>
                    		<input class="btn btn-dark" type="submit" name="login" value="Sign In">
                    	</div>
                    </div>
                     </form>

                    </div>
         
    	<div class="register_account col-sm-8">
    		<h3>Register New Account</h3>
    		<?php  
    			if (isset($insertCustomer)) {
    				echo $insertCustomer;
    			}
    		?>
    		<form action="" method="post">
		   			 <table>
		   				<tbody>
						<tr>
						<td class="text-dark">
							<div>
							<input type="text" name="name" placeholder="Enter Name..."  >
							</div>
							
							<div>
							   <input type="text" name="city" placeholder="Enter city...">
							</div>
							
							<div>
								<input type="text" name="zipcode" placeholder="Enter zip-code...">
							</div>
							<div>
								<input type="text" name="email" placeholder="Enter email...">
							</div>
		    			 </td>
		    			<td>
						<div>
							<input type="text" name="address" placeholder="Enter address...">
						</div>
		    		<div>
						<select id="country" name="country" onchange="change_country(this.value)" class="frm-field required">
							<option value="null">Select a Country</option>         
							<option value="Hà Nội">Hà Nội</option>
							<option value="TP.HCM">Thành phố Hồ Chí Minh</option>
							<option value="Nghệ An">Nghệ An</option>
							<option value="Hà Tỉnh">Hà Tỉnh</option>
							<option value="Bình Dương">Bình Dương</option>
							<option value="Long An">Long An</option>
							

		         </select>
				 </div>		        
	
		           <div>
		          <input type="text" name="phone" placeholder="Enter phone...">
		          </div>
				  
				  <div>
					<input type="text" name="password" placeholder="Enter password...">
				</div>
		    	</td>
		    </tr> 
		    </tbody></table> 
		   <div class="search">
		   		<div>
		   			<input type="submit" name="register" class="btn btn-dark" value="Create Account"></input>
		   		</div>
		   </div>
		    <p class="text text-dark">By clicking 'Create Account' you agree to the <a href="#">Terms &amp; Conditions</a>.</p>
		    <div class="clear"></div>
		    </form>
    	</div>  	
       <div class="clear"></div>
    </div>
 </div>

<?php 
	include 'inc/footer.php';
?>