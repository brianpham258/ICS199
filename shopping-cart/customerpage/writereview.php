

<?php							
    include('header.html');

?>

<?php
include("connect.php");

$customer_id = 8;

$query = "SELECT * FROM ORDERINFO O, SOLD_PRODUCT S, CUSTOMER C, PRODUCT P
WHERE P.PRODUCT_ID = S.PRODUCT_ID
  AND O.ORDER_ID = S.ORDER_ID
  AND O.ORDER_STATUS = '03'
  AND O.CUST_ID = C.CUST_ID
  AND C.CUST_ID ='$customer_id';";
  

// RUN 
$result = mysqli_query($connectData, $query);
		echo "<table id='display' class='table'>";
				echo "<tr>";
				echo    "<th>Order id</th>";
				echo    "<th>Product Picture</th>";
				echo    "<th>Product Name</th>";
				echo    "<th>Review</th>";
				echo    "<th>Click to submit</th>";
			echo "</tr>";
while($row=mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            // display each row 
            echo "<tr>";
			echo "<td>".$row['order_id']."</td>"; 
            echo "<td>"."<img src='../adminpage/".$row['PRODUCT_PIC_PATH']."'  style='width:100px;height:100px;'></td>"; 
			echo "<td>".$row['product_name']."</td>";
			echo "<form action='writereview.php' method='POST'>";
			echo "<td>"."<textarea rows='4' cols='50' name='newReview'>".$row['review']."</textarea>
						<input type='hidden' name='getid2' value='".$row['order_id']."'>"."</td>";
			echo	"<td>"."<input type='submit' value='Add review' />"."</td>";
			echo "</form>";
			
            echo "</tr>";
}



if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	$newreview = $_POST['newReview'];
	$order_id = $_POST['getid2'];
	$query2 = "UPDATE SOLD_PRODUCT SET review = '$newreview' WHERE order_id ='$order_id';";
	$result2 = mysqli_query($connectData, $query2);

}

	mysqli_close($dbc);
?>
    </body>
    <footer></footer>
</html>
					