<?php
	include('header.php');
   $total = $_GET['amount'];
//echo "<pre>";
//var_dump($_POST);
//exit();

session_start();
if (isset($_SESSION['username'])){
	$product_id=$_GET['product_id'];
	$rest_id=$_GET['rest_id'];
	$cust_id=$_SESSION['cust_id'];
	$_SESSION['total'] = $total;
}
   ?>
<head>
<link rel="stylesheet" href="includes/css/newStyle.css" type="text/css">
</head>

<form action="charge.php" method="post">
	<?php
	include('connect.php');
	//Find the customer
	$query = "SELECT * FROM CUSTOMER WHERE cust_id = '$cust_id';";
	$result = mysqli_query($connectData, $query);
	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
	$firstName = $row['first_name'];
	$lastName = $row['last_name'];
	$address = $row['address'];
	$phone = $row['phone'];
	$tax1 = number_format($total*0.05,2);
	$tax2 = number_format($total*0.07,2);
	$orderTotal = number_format($total+$tax1+$tax2,2);
	$orderTotal2 = $total+$tax1+$tax2;
	//Session pass to the next
	$_SESSION['name'] = $firstName . " " . $lastName;
	$_SESSION['address'] = $address;
	$_SESSION['phone'] = $phone;
	$_SESSION['tax1'] = $tax1;
	$_SESSION['tax2'] = $tax2;
	$_SESSION['grandTotal'] = $orderTotal;
	?>
	<div class="boxCheckout">
	<h3>Shipping address</h3>
	<div class="row">
		<div class="col">
			<p class="shipping"><input type="radio" name="address" value="originalAddress" checked> Saved address</p><br>
			<?php 
				echo "<b>Customer name:</b> $firstName" . " $lastName" . "<br>";
				echo "<b>Address: </b>"."$address"  . "<br>";
				echo "<b>Phone: </b>" . "$phone" . "<br>"; 
			?>
		</div>
		
		<div class="col">
			<p class="shipping"><input type="radio" name="address" value="changeAddress"> Change shipping address</p>
			Full name: <br><input type="text" name="fullname" size="25"><br>
			Address: <br><input type="text" name="changeAddress" size="25"><br>
			Phone: <br><input type="text" name="changephone" size="25"><br>
		</div>
	</div>	
	<script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
        data-key=pk_test_Pu0AbnZsEpYtDhj1uhRY36QE00KnUTSHPR
        data-description="<?php echo 'Credit Card Payment'; ?>"
        data-amount="<?php echo $orderTotal2*100; ?>"
        data-locale="auto">
	$(document).ready(function(){
        $(".stripe-button-el span").remove();
            $("button.stripe-button-el").removeAttr('style').css({
                "display":"inline-block",
                "width":"100%",
                "padding":"15px",
                "background":"#3fb0ac",
                "color":"white",
                "font-size":"1.3em" }).html("Sign Me Up!");
        });
	</script>
	<input type="hidden" name="totalamt" value="<?php echo $orderTotal*100; ?>" />
	</div>
	<div class="boxCheckout">
		<div class="row">
			<div class="col">
			<h3>Order summary</h3>
			<p>Total: <span><?php echo "CDN$ ".number_format($total,2); ?><span></p>
			<p>Estimated GST/HST: <span><?php echo "CDN$ "."$tax1"; ?><span></p>
			<p>Estimated PST/RST/QST: <span><?php echo "CDN$ "."$tax2"; ?></span></p>
			<h5>Order Total: <span><?php echo "CDN$ $orderTotal"; ?> </span></h5>
			<button type="submit" class="checkoutButton btn btn-dark">Place your order</button>
			</div>
		</div>
	</div>
</form>
