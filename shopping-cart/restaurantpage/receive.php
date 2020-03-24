<?php
	include('connect.php');
?>
	<?php
	$query = "UPDATE ORDERINFO SET order_status = '02' WHERE order_status = 01 AND rest_id = 01;";
	
	$result = mysqli_query($connectData, $query);
	if($result)
	{
		header("Location: restaurant.php");
	}
	//end of the while loop
	mysqli_close($connectData);	
	?>
