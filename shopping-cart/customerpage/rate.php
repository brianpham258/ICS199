<?php

include('connect.php');



if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	$_SESSION['receipt'] = $_POST['receipt_num'];
	$receipt = $_SESSION['receipt'];
        $newreview = $_POST['newReview'];
        $order_id = $_POST['getid2'];
        $query2 = "UPDATE SOLD_PRODUCT SET review = '$newreview' WHERE order_id ='$order_id';";
        $result2 = mysqli_query($connectData, $query2);



	$rate_category = $_POST["rate"]; 

	$order_id = $_POST['getid'];
//print $order_id;

	$query1 = "UPDATE SOLD_PRODUCT SET rate_point = '$rate_category'
	WHERE order_id = '$order_id';";


	$result1 = mysqli_query($connectData, $query1);
	if($result1){
		header("Location: user.php?receipt_num=$receipt");	
	}
}

mysqli_close($connectData);

?>



