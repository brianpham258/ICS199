<?php							
    include('header.php');

?>
<head>
<link rel="stylesheet" href="includes/css/newStyle.css" type="text/css">
</head>
<?php
    session_start(); 
			if (isset($_SESSION['username'])){
				$product_id=$_GET['product_id']; 
				$rest_id=$_GET['rest_id']; 
				$cust_id=$_SESSION['cust_id'];  // it shuoud be changed later to real data on webpage!!!
				$message = "Food added in the cart successuflly.";
				$message2 = "Food added in the cart FAILED!!!.";
				// echo "alert($product_id.'^'.$rest_id.'^'$cust_id);";
				include("connect.php"); 
				// 03: same CUST add same product at same restaurant
				// 02: same CUST add diff product at same restaurant
				// 01: same CUST add diff product at diff restaruant OR first add in to cart
				// print "product_id->".$product_id."rest_id->".$rest_id."USERNAME->".$_GET['username']."cust_id->".$_GET['cust_id'];
				
				if(!empty($product_id) && !empty($rest_id) && $_SERVER['REQUEST_METHOD'] == 'GET'){    
					 $query = "SELECT MAX(KIND) kind FROM (
								SELECT '03' KIND FROM ORDERINFO O, SOLD_PRODUCT S 
								WHERE O.ORDER_ID = S.ORDER_ID
								  AND O.REST_ID = $rest_id  
								  AND O.CUST_ID = $cust_id
								  AND O.ORDER_STATUS = '05'
								  AND S.PRODUCT_ID = $product_id
								UNION ALL 
								SELECT '02' KIND FROM ORDERINFO O, SOLD_PRODUCT S 
								WHERE O.ORDER_ID = S.ORDER_ID
								  AND O.REST_ID = $rest_id 
								  AND O.CUST_ID = $cust_id
								  AND O.ORDER_STATUS = '05'  
								UNION ALL
								SELECT '01' FROM  dual
								) K;";
					 $result = mysqli_query($connectData, $query);
					 $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
					 //print "kind->".$row['kind']."^^";
					 if ($row['kind'] == '03') {
							$query_03_01 = "UPDATE SOLD_PRODUCT SET QUANTITY = QUANTITY + 1  
											WHERE PRODUCT_ID = $product_id
											AND ORDER_ID = (SELECT ORDER_ID 
															FROM ORDERINFO 
															WHERE  ORDER_STATUS='05' AND CUST_ID = $cust_id AND REST_ID = $rest_id);";
							$result_03_01 = mysqli_query($connectData, $query_03_01);
							if (result_03_01) {
								echo "<script type='text/javascript'>alert('$message');</script>";
							}
							else {
								echo "<script type='text/javascript'>alert('$message2');</script>";
							}
					 }
					 else if ($row['kind'] == '02') {
							$query_02_02 = "INSERT INTO SOLD_PRODUCT (PRODUCT_ID, ORDER_ID, QUANTITY) VALUES ($product_id, (SELECT ORDER_ID FROM ORDERINFO where  ORDER_STATUS='05' and cust_id = $cust_id AND REST_ID = $rest_id), 1);";
							$result_02_02 = mysqli_query($connectData, $query_02_02);
							if (result_02_02) {
								echo "<script type='text/javascript'>alert('$message');</script>";
							}
							else {
								echo "<script type='text/javascript'>alert('$message2');</script>";
							}
					 }
					 else {
							$query_01_01 = "INSERT INTO ORDERINFO (ORDER_STATUS, CUST_ID, REST_ID) VALUES ('05', $cust_id, $rest_id);";
							$result_01_01 = mysqli_query($connectData, $query_01_01);
							$query_01_02 = "INSERT INTO SOLD_PRODUCT (PRODUCT_ID, ORDER_ID, QUANTITY) VALUES ($product_id, (SELECT ORDER_ID ORDER_ID FROM ORDERINFO where  ORDER_STATUS='05' and cust_id = $cust_id AND REST_ID = $rest_id), 1);";
							$result_01_02 = mysqli_query($connectData, $query_01_02);
							//print "parm01>>".$product_id."parm02>>".$cust_id;
							if (result_01_01 && result_01_02) {
								echo "<script type='text/javascript'>alert('$message');</script>";
							}
							else {
								echo "<script type='text/javascript'>alert('$message2');</script>";
							}
					 }
				}
			}	




include("connect.php");
$product_id = $_GET["getid"];
$query = "SELECT p.product_pic_path, p.product_name, r.rest_name, p.product_category, r.rest_id, p.product_price
			FROM PRODUCT p, RESTAURANT r
			WHERE r.rest_id = p.rest_id
			AND p.product_id = '$product_id';";

			
$query2 = "SELECT sp.review
			FROM PRODUCT p, SOLD_PRODUCT sp
			WHERE p.product_id = sp.product_id
			AND sp.review IS NOT NULL
			AND p.product_id = '$product_id';";	
			
$good = "SELECT count(*) 'GOOD' 
FROM SOLD_PRODUCT sp, PRODUCT p
WHERE sp.product_id = p.product_id
AND sp.rate_point = 2
AND p.product_id = '$product_id';";

$bad = "SELECT count(*) 'BAD'
FROM SOLD_PRODUCT sp, PRODUCT p
WHERE sp.product_id = p.product_id
AND sp.rate_point = 1
AND  p.product_id = '$product_id';";

//first rec
$rec1 = "SELECT product_pic_path, product_name, product_id, product_category FROM PRODUCT 
		WHERE RECOMMEND_YN = 'Y'
		AND product_category = (
								SELECT product_category 
								FROM PRODUCT 
								WHERE product_id = $product_id)
		AND product_id <> $product_id
		  GROUP BY product_id
          ASC LIMIT 1;";

//second rec
$rec2 = "SELECT product_pic_path, product_name, product_id FROM PRODUCT 
		WHERE RECOMMEND_YN = 'Y'
		AND product_category = (
								SELECT product_category 
								FROM PRODUCT 
								WHERE product_id = $product_id)
		AND product_id <> $product_id
		  GROUP BY product_id
          ASC LIMIT 1,1;";

$result = mysqli_query($connectData, $query);
$result2 = mysqli_query($connectData, $query2);	
$result3 = mysqli_query($connectData, $good);
$result4 = mysqli_query($connectData, $bad);

//run rec
$result6 = mysqli_query($connectData, $rec1);
$result7 = mysqli_query($connectData, $rec2);



//get product category		  
$result9 = mysqli_query($connectData, $query);		  
$row=mysqli_fetch_array($result9, MYSQLI_ASSOC);
$food_category = $row["product_category"];  

$magic = "SELECT r.rest_name, r.rest_pic_file, p.product_name,p.product_category, p.product_price, p.product_pic_path, p.product_id, r.rest_id
						FROM PRODUCT p, RESTAURANT r
						WHERE r.rest_id = p.rest_id
						  AND p.product_category = '$food_category'
                          AND p.product_id = '$product_id';";


						  
$showMagic = mysqli_query($connectData, $magic);


////////////////////////////////////////

    echo '<div class="container" style="margin:30px 0 70px 50px; width:90%;display:block">';
			while($row=mysqli_fetch_array($result, MYSQLI_ASSOC)) {
					echo '<div class="col-md-3" style="float:left">';
							echo ""."<img src='../adminpage/".$row['product_pic_path']."'  style='width:200px;height:200px;'>";
					echo '</div>';
					
							echo '<div class="row">';
								echo '<div class="col-md-4">'.$row['rest_name'].'</div>';
								echo '<div class="col-md-12" style="font-weight:bold">'.$row['product_name'].'</div>';
								echo '<div class="col-md-12" style="font-weight:bold">CAD$ '.$row['product_price'].'</div>';
							echo '</div>';
			}
				while($row=mysqli_fetch_array($result3, MYSQLI_ASSOC)) {
							echo '<br/>';
							echo '<div class="row">';
								echo '<p class="btn btn-success">Good '.$row['GOOD'].'</p>';
							echo '</div>';
				}
				while($row=mysqli_fetch_array($result4, MYSQLI_ASSOC)) {
							
							echo '<div class="row">';
								echo '<p class="btn btn-danger">Bad '.$row['BAD'].'</p>';
							echo '</div>';
							echo '<div class="row">';
				}

				if($row=mysqli_fetch_array($showMagic, MYSQLI_ASSOC)) {		
					echo '<form action="display_product.php" method="GET">';						
							echo '<input type="hidden" name="product_id" value="'.$row['product_id'].'" />';
							echo '<input type="hidden" name="rest_id" value="'.$row['rest_id'].'" />';  
							echo '<input type="hidden" name="category" value="'.$row['product_category'].'" />';
							echo '<input type="submit" class="button btn" value="Add Cart" style="margin:0 0 30px 80px"></form>';
				}

				while($row=mysqli_fetch_array($result6, MYSQLI_ASSOC)) {
						echo ' <div class="containers" style="width:100%">';
							echo '<center>';
								echo '<div class="row">';
										echo '<div class="col-md-6">';
												echo "<div>".$row['product_name']."</div>"; 
												echo "<div>"."<form id='form1' action='review.php' method='GET'>
													<input type='image' name='submit' src='../adminpage/".$row['product_pic_path']."''>
													<input type='hidden' name='getid' value='".$row['product_id']."'>
													</form>";
												echo '</div>';
										echo '</div>';

				}
				while($row=mysqli_fetch_array($result7, MYSQLI_ASSOC)) {
										echo '<div class="col-md-6">';
												echo "<div>".$row['product_name']."</div>"; 
												echo "<div>"."<form id='form1' action='review.php' method='GET'>
													<input type='image' name='submit' src='../adminpage/".$row['product_pic_path']."''>
													<input type='hidden' name='getid' value='".$row['product_id']."'>
													</form>";
												echo '</div>';
										echo '</div>';
										echo '</div>';
										echo '</center>';
									echo '</div>';
				}

				echo '<div class="row" style="width:100%">';
				while($row=mysqli_fetch_array($result2, MYSQLI_ASSOC)) {
							// echo '<div class="row">';
								echo '<div class="col-md-12" id="review1">'.$row['review'].'</div>';
							// echo '</div>';
				}
				echo '</div>';
				
		echo '</div>';
	echo '</div>';
	
	mysqli_close($dbc);
?>
    </body>
    <footer></footer>
</html>
<?php
include('footer.html');

?>					

