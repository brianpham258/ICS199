<?php
	include('connect.php');
?>
	<?php
	$order_id = $_GET['getOrderId'];

	$query2 = "SELECT cust_id FROM ORDERINFO WHERE order_id = '$order_id';";

	$result = mysqli_query($connectData, $query2);
	$row = mysqli_fetch_array($result);
	$customer_id = $row['cust_id'];

	$query = "UPDATE ORDERINFO SET order_status = '03' WHERE cust_id = '$customer_id';";
	
	$result = mysqli_query($connectData, $query);
	if($result)
	{
		header("Location: restaurant.php");
	}
	//end of the while loop
	mysqli_close($connectData);	
	?>
