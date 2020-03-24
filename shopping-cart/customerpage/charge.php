<?php
  session_start();
if (isset($_SESSION['cust_id'])){
       // $product_id=$_GET['product_id'];
        //$rest_id=$_GET['rest_id'];
        $cust_id=$_SESSION['cust_id'];
}else{
	print "no username found";
}

  include('header.php');
  require_once('./checkout/config.php');
  include('connect.php');
//Changing shipping address

$whatAddress = $_POST['address'];
$name2 = $_POST['fullname'];
$address2 = $_POST['changeAddress'];
$phone2 = $_POST['changephone'];
if($whatAddress == "changeAddress"){
	unset($_SESSION['name']);
	unset($_SESSION['address']);
	$_SESSION['name'] = $name2;
        $_SESSION['address'] = $address2;
        $_SESSION['phone'] = $phone2;
}

  $token  = $_POST['stripeToken'];
  $email  = $_POST['stripeEmail'];
  $totalamt = $_POST['totalamt'];
  
// modify the data from order info to 01
  $query1 = "UPDATE ORDERINFO SET order_status = '01', payment_date = NOW() WHERE order_status = '05' AND cust_id = '$cust_id';";
  $result1 = mysqli_query($connectData, $query1);

  if($result1){
	$customer = \Stripe\Customer::create(array(
      	'email' => $email,
      	'source'  => $token
  	));
	if(!$customer){
		print "Error";
	}

  	$charge = \Stripe\Charge::create(array(
      	'customer' => $customer->id,
      	'amount'   => $totalamt,
      	'currency' => 'cad'
  	));
	if(!$charge){
		echo "Error: There is something wrong with the transaction. Please try again or contact your bank!";	
	}

  }else{
	print "Error: There is something wrong with the transaction. Please contact the administrator";
  }
$amount = number_format(($totalamt / 100), 2);
//payment date
$query3 = "SELECT DATE_FORMAT(NOW(), '%d-%M-%Y %h:%i:%s %p');";
$result3 = mysqli_query($connectData, $query3);
$row2 = mysqli_fetch_array($result3);
$dateNow = $row2["DATE_FORMAT(NOW(), '%d-%M-%Y %h:%i:%s %p')"];
//create a unique file to 
$query2 = "SELECT p.product_price, s.order_id, p.product_name, s.quantity, o.payment_date, o.rest_id, c.first_name, c.last_name, c.address, c.phone
	FROM ORDERINFO o, SOLD_PRODUCT s, PRODUCT p, CUSTOMER c
	WHERE o.ORDER_ID = s.ORDER_ID
	AND s.PRODUCT_ID = p.PRODUCT_ID
	AND o.CUST_ID = c.CUST_ID
	AND o.cust_id = '$cust_id'
	AND o.ORDER_STATUS = '01';";
// Order status need to be deliver by the end so we can change it to 03 to avoid duplication
$result2 = mysqli_query($connectData, $query2);
$result5 = mysqli_query($connectData, $query2);
//getting order id atleast one for receipt
$recept_id = mysqli_fetch_row($result5);
//insert the receipt into the data
$receipt_id_for_real = $cust_id . $recept_id[1];
$query4 = "UPDATE ORDERINFO SET receipt = '$receipt_id_for_real' WHERE order_status = '01' AND cust_id = $cust_id;";
$result4 = mysqli_query($connectData, $query4);
$orderSummary = "Date: " .$dateNow .  "\nReceipt number: " .$receipt_id_for_real."\nCustomer name: " . $_SESSION['name'] . "\n" . "Address: " . $_SESSION['address']
		. "\n" . "Phone number: " . $_SESSION['phone'] . "\n" . "Total before tax: CDN $" . $_SESSION['total']
		. "\n" . "GST: CDN $" . $_SESSION['tax1'] . "\n" . "PST: CDN $" . $_SESSION['tax2'] . "\n" .
		"Grand total of: CDN $" . $_SESSION['grandTotal'] . "\n\n";
$filename = fopen("reciept/".$receipt_id_for_real.".txt", "w");
fwrite($filename, $orderSummary);

while($row = mysqli_fetch_array($result2, MYSQL_ASSOC)){
                $text = "Order ID: ".$row['order_id']."   Item: ". $row['product_name']."    Quantity: ".$row['quantity']."    Price: " . $row['product_price']."\n";
		fwrite($filename, $text);
}
fclose($filename);

$showOrderSummary = "Date: " .$dateNow ."<br>Receipt number: " .$receipt_id_for_real. "<br>Customer name: " . $_SESSION['name'] . "<br>" . "Address: " . $_SESSION['address']
                . "<br>" . "Phone number: " . $_SESSION['phone'] . "<br>" . "Total before tax: CDN $" . $_SESSION['total']
                . "<br>" . "GST: CDN $" . $_SESSION['tax1'] . "<br>" . "PST: CDN $" . $_SESSION['tax2'] . "<br>" .
                "Grand total of: CDN $" . $_SESSION['grandTotal'] . "<br><br>";
?>
<head>
<link rel="stylesheet" href="includes/css/newStyle.css" type="text/css">
</head>
<div class="orderPlace">
	<h3> Thank you, your order has been placed. </h3>
	<hr>
	<h4 class="shipping">Order receipt</h4>
	<p class="changeFont"><?php echo $showOrderSummary; ?></p>
</div>


<?php
// After paid change the status to inprogress
$query3 = "UPDATE ORDERINFO SET order_status = '02' WHERE order_status = '01' AND cust_id = '$cust_id';";
$result3 = mysqli_query($connectData, $query3);
mysqli_close($connectData);
  // Clear the cart:
  include ('includes/footer.html');
?>
