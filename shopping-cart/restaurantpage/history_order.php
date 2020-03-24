<?php
	include('header.html');
	include('connect.php');
?>

<div class="orderTable">
	<table>
		<tr>
			<th>Time recieve</th>
		</tr>
	<?php
	$query = "SELECT payment_date
	FROM ORDERINFO
	WHERE rest_id = 1
	AND payment_date IS NOT NULL
	ORDER BY payment_date";

	$result = mysqli_query($connectData, $query);
	while($row=mysqli_fetch_array($result)){
	//print $ro['first_name'];
	
	// DISPlay the order
		echo "<tr>";
                echo "<td>".$row['payment_date']."</td>";
		echo "</tr>";
}
	//end of the while loop
	mysqli_close($connectData);	
	echo "</table>";
	include('footer.html');
	?>
