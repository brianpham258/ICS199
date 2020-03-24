

<?php							
    include('header.php');

?>

<?php
include("connect.php");

$customer_id = $_SESSION['cust_id'];

//query 1
$query = "SELECT DISTINCT(receipt) FROM ORDERINFO WHERE cust_id = '$customer_id' AND receipt IS NOT NULL ORDER BY receipt desc;";
$result = mysqli_query($connectData, $query);
?>


<h3><center>Order History</center></h3>


<?php
while($row=mysqli_fetch_array($result)){
	echo "<div class='row boxCheckout'>";
	echo "<div class='col'>";
	$receipt = $row['receipt'];
	$query4 = "SELECT DATE_FORMAT(payment_date, '%d-%M-%Y %h:%i:%s %p') AS date FROM ORDERINFO WHERE receipt = $receipt";
	$result4 = mysqli_query($connectData, $query4);
	//if($result4){
	//	echo "suscees";
	//}
	$row4 = mysqli_fetch_array($result4);
	$query2 = "SELECT o.receipt, p.product_name, s.quantity, p.product_price from ORDERINFO o, SOLD_PRODUCT s, PRODUCT p WHERE o.order_id = s.order_id AND s.product_id = p.product_id AND cust_id = $customer_id AND receipt = $receipt;";
	$result2 = mysqli_query($connectData, $query2);
	$query3 = "SELECT SUM(p.product_price*s.quantity) as total FROM ORDERINFO o, SOLD_PRODUCT s, PRODUCT p WHERE o.order_id = s.order_id AND s.product_id = p.product_id AND o.receipt = $receipt;";
	$result3 = mysqli_query($connectData, $query3);
	$row3 = mysqli_fetch_array($result3);
	echo "<b>Date: <span></b>".$row4['date']."</span><br>";
	//print_r($row4);
	echo "<b>Reciept number: <span></b>".$row['receipt']."</span><br>";
	echo "<b>Total:</b> <span>CDN $".number_format($row3['total'],2)."</span><br>";
	echo "<b>GST:</b> <span>CDN $". number_format($row3['total'] * 0.05,2) ."</span><br>";
	echo "<b>PST:</b> <span>CDN $". number_format($row3['total'] * 0.07,2) ."</span><br>";
	echo "<b>Grand Total:</b> <span>CDN $" . number_format($row3['total'] + ($row3['total'] * 0.05) + ($row3['total'] * 0.07),2) . "</span><br>";
	echo "</div>";
	echo "<div class='col-6'>";
	while($row2=mysqli_fetch_array($result2)){
		//order summary
		echo "<b class='shipping'>Item name:	</b>".$row2['product_name'].	"    <b class='shipping'>Quantity:    </b>" . $row2['quantity']."   <b class='shipping'>Price: 	</b>CDN $" . number_format($row2['product_price'],2) . "<br>";
	}
	echo "</div>";
	echo "<div class='col center'>";
	echo "<form action='user.php' method='GET'><input type='hidden' name='receipt_num' value='$receipt'><button type='submit' class='btn btn-dark'>Add review</button></form>";
	echo "</div>";
	echo "</div>";
}
echo "</ul>";
//DATE_FORMAT(payment_date, '%d-%M-%Y %h:%i:%s %p') AS date

mysqli_close($connectData);
?>
    </body>
    <footer></footer>
</html>
					

