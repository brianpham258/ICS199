<?php
	include('connect.php');
?>
	<?php
	$order_id = $_GET['getOrderId'];

	$query = "UPDATE ORDERINFO SET order_status = '03' WHERE order_id = '$order_id';";
	
	$result = mysqli_query($connectData, $query);
	if($result)
	{
		header("Location: restaurant.php");
	}
	//end of the while loop
	mysqli_close($connectData);	
	?>
