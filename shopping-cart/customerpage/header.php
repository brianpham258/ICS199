<?php
session_start();

if(isset($_SESSION['username'])){
        //user is login
        $user = $_SESSION['cust_id'];
	$userAutho = $_SESSION['user_authority'];
        // user $user
}else{
        //user is not login
}
?>
<!DOCTYPE html>
<html>
    <head lang="en">
        <!--Required meta tags-->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Welcome to ThinkFood</title>
       
        <!--Bootstrap CSS-->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="includes/css/newStyle.css" type="text/css">
        
    </head>
    <body>
        <!--NAVBAR-->
        <nav id="navbar" class="navbar sticky-top navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="thinkfood.php">ThinkFood</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="thinkfood.php">HOME</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="food.php">PRODUCT</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="cart.php">CART</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about.php">ABOUT US</a>                       
                    </li>
			<?php
			if($userAutho == 01){
				print '<li class="nav-item">';
                                print '<a class="nav-link" href="/~ics19906/shopping-cart/adminpage/adminpage.php">Admin Panel</a>';
                                print '</li>';
			}
			if($userAutho == 02){
				print '<li class="nav-item">';
                                print '<a class="nav-link" href="/~ics19906/shopping-cart/restaurantpage/restaurant.php">Restaurant Panel</a>';
                                print '</li>';
			}
			
			if(empty($user)){
                    		print '<li class="nav-item">';
                        	print '<a class="nav-link" href="login.php">LOGIN</a>';
                    		print '</li>';
							print '<li class="nav-item">';
                        	print '<a class="nav-link" href="privacy_term.php">REGISTER</a>';
                    		print '</li>';
							
			}else{
				print '<li class="nav-item">';
                                print '<a class="nav-link" href="customer.php">' .$_SESSION['first_name']. '</a>';
                                print '</li>';
				print '<li class="nav-item">';
                                print '<a class="nav-link" href="logout.php">LOGOUT</a>';
                                print '</li>';
				print '<li class="nav-item">';
								print '<a class="nav-link" href="privacy_term.php">Privacy of Term</a>';
								print '</li>';

			}
			?>
                </ul>
            </div>
        </nav>

    
