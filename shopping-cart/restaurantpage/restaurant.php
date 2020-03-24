<?php
	include('header.html');
	include('connect.php');
?>
<div class="col-10">
<div class="orderTable">
	<table id="table">
		<tr>
			<th>Order number</th>
			<th>Order</th>
			<th>Quantity</th>
			<th>Time recieve</th>
			<th>Customer name</th>
			<th>Address</th>
			<th>Phone number</th>
			<th>Order status</th>
		</tr>
	<?php
	$query = "SELECT o.order_status, o.order_id, p.product_name, s.quantity, o.payment_date, o.rest_id, c.first_name, c.last_name, c.address, c.phone
FROM ORDERINFO o, SOLD_PRODUCT s, PRODUCT p, CUSTOMER c
WHERE o.ORDER_ID = s.ORDER_ID
AND s.PRODUCT_ID = p.PRODUCT_ID
AND o.CUST_ID = c.CUST_ID
AND o.ORDER_STATUS = '02';";

	$result = mysqli_query($connectData, $query);
	while($row=mysqli_fetch_array($result)){
	//print $ro['first_name'];
	
	// DISPlay the order
		echo "<tr>";
		echo "<td>".$row['order_id']."</td>";
		echo "<td>".$row['product_name']."</td>";
		echo "<td>".$row['quantity']."</td>";
                echo "<td>".$row['payment_date']."</td>";
                echo "<td>".$row['first_name']." ".$row['last_name']."</td>";
		echo "<td>".$row['address']."</td>";
                echo "<td>".$row['phone']."</td>";
		if($row['order_status'] == '01'){
			echo "<td>Waiting to receive</td>";
		}else if ($row['order_status'] == '02'){
			echo "<td>In progress</td>";
		}else{
			echo "<td>Delivered</td>";
		}
		echo "</tr>";
}
	//end of the while loop
	mysqli_close($connectData);	
	echo "</table>";
	include('footer.html');
	?>
</div>
</div>
</div>
