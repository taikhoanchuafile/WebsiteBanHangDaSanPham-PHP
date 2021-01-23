<?php 
    include 'lib/session.php'; 
    Session::init();
?>
<?php  
	include_once 'helpers/format.php';
	include_once 'lib/database.php';

	//Do làm biếng nên khởi tạo tự động phần đường dẫn include file.php trong classes.
	spl_autoload_register(
		function($className)
		{
			include_once "classes/".$className.".php";
		}
	);

	$db = new Database();
	$fm = new Format();
	$cart = new Cart();
	$user = new User();
	$cat = new Category();
	$pro = new Product();
	$bra = new Brand();
	$cus = new Customer();
?>
<?php
  header("Cache-Control: no-cache, must-revalidate");
  header("Pragma: no-cache"); 
  header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
  header("Cache-Control: max-age=2592000");
?>

<!DOCTYPE HTML>
<head>
<!-- Bootstrap 4 CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
<!-- Bootstrap 3 icon -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">


<title>Store Website</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
<link href="css/menu.css" rel="stylesheet" type="text/css" media="all"/>
<script src="js/jquerymain.js"></script>
<script src="js/script.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script> 
<script type="text/javascript" src="js/nav.js"></script>
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easing.js"></script> 
<script type="text/javascript" src="js/nav-hover.js"></script>
<link href='http://fonts.googleapis.com/css?family=Monda' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Doppio+One' rel='stylesheet' type='text/css'>
<script type="text/javascript">
  $(document).ready(function($){
    $('#dc_mega-menu-orange').dcMegaMenu({rowItems:'4',speed:'fast',effect:'fade'});
  });
</script>
</head>
<body>
  <div class="wrap">
		<div class="header_top">
			<div class="logo">
				<a href="index.php"><img src="images/logo.png" alt="image" /></a>
			</div>
			  <div class="header_top_right">
			    <div class="search_box">
				    <form action="search.php" method="post">
				    	<input type="text" placeholder="Search for Products...." name="tukhoa" >
				    	<input type="submit" name="searchProduct" value="Search">
				    </form>
			    </div>
			    <div class="shopping_cart">
					<div class="cart">
						<a href="#" title="View my shopping cart" rel="nofollow">
								<span class="cart_title">Cart:</span>
								<span class="no_product">
									
									<?php  
										$checkCart = $cart->checkCart();
										if ($checkCart) {
											$sum = Session::get("sum");
											$qty= Session::get("qty");
											echo $sum.'đ'.' / '.$qty;
										} else {
											echo 'Empty';
										}
									?>

								</span>
							</a>
						</div>
			      </div>
			<?php  
				if (isset($_GET['customerId'])) {
					$idCustomer = Session::get('customerId');
					$delDataWishlistByCustomerId = $cart->delDataWishlistByCustomerId($idCustomer);
					$delDataCompareByCustomerId = $cart->delDataCompareByCustomerId($idCustomer);
					$delDataCardBySessionId = $cart->delDataCardBySessionId();
					Session::destroy();
				}
			?>
		   <div class="login">
		   	<?php  
		   		$checkLogin = Session::get('customerLogin');
		   		if ($checkLogin) {
		   			echo "<a href='?customerId=".Session::get('customerId')."'>Logout</a>";

		   		}else {
		   			echo "<a href='login.php'>Login</a>";
		   		}
		   	?>
		   	
		   </div>
		 <div class="clear"></div>
	 </div>
	 <div class="clear"></div>
 </div>
<div class="menu">
	<ul id="dc_mega-menu-orange" class="dc_mm-orange">

		<li><a href="index.php">Home</a></li>
		<li><a href="topcategorys.php">Top Category</a> </li>
		<li><a href="topbrands.php">Top Brands</a></li>

	   <?php  
		  	$checkCart = $cart->checkCart();
		  	if ($checkCart) {
		  		echo " <li><a href='cart.php'>Cart</a></li>";
		  	}else {
		  		echo " ";
		  	}
	  	?>

	  	<?php  
	  		$idCustomer = Session::get('customerId');
		  	$checkOrder = $cart->checkOrder($idCustomer);
		  	if ($checkOrder) {
		  		echo " <li><a href='orderdetails.php'>Ordered</a></li>";
		  	}else {
		  		echo " ";
		  	}
	  	?>

		 <?php  
		  	$checkLogin = Session::get('customerLogin');
		  	if ($checkLogin) {
		  		echo "<li><a href='profile.php'>Profile</a> </li>";
		  	}else {
		  		
		  	}
		?>

		<?php  
			$checkLogin = Session::get('customerLogin');
			if ($checkLogin) {
				echo "<li><a href='compare.php'>Compare</a> </li>";
			} else {
				echo " ";;
			}
		?>

		<?php  
			$checkLogin = Session::get('customerLogin');
			if ($checkLogin) {
				echo "<li><a href='wishlist.php'>Wishlist</a> </li>";
			} else {
				echo " ";;
			}
		?>

	   	<li><a href="contact.php">Contact</a> </li>
	   
	   	<?php 

	   		$checkLogin = Session::get('customerLogin');
	   		if ($checkLogin) {
	   			
	   		
	   	?>
	   	<li><a href=""><?php echo "Hello : ".Session::get('customerName');?></a> </li>
	   	<?php  
	   		} 
	   	?>
	   
	  <div class="clear"></div>
	</ul>
</div>
