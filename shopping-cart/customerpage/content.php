<div class="foodHeader">
    <div class="foodContent">
        <?php 
			session_start(); 
			if (isset($_SESSION['username'])){
				$product_id=$_GET['product_id']; 
				$rest_id=$_GET['rest_id']; 
				$cust_id=$_SESSION['cust_id'];  // it shuoud be changed later to real data on webpage!!!
				$message = "Food added in the cart successuflly.";
				$message2 = "Food added in the cart FAILED!!!.";
				//echo "alert($product_id.'^'.$rest_id.'^'$cust_id);";
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
					$query = "SELECT r.rest_name, r.rest_pic_file, p.product_name, p.product_price, p.product_pic_path, p.product_id, r.rest_id
						FROM PRODUCT p, RESTAURANT r
						WHERE r.rest_id = p.rest_id;";
					
					$result = mysqli_query($connectData, $query);

					echo "<table id='display' class='table'>";
						echo "<tr>";
							echo    "<th>Restaurant Name</th>";
							echo    "<th>Restaurant Logo</th>";
							echo    "<th>Product</th>";
							echo    "<th>Product Name</th>";
							echo    "<th>Product price</th>";
							echo		"<th></th>";
						echo "</tr>";

						while($row=mysqli_fetch_array($result, MYSQLI_ASSOC)) {
							// display each row 
							echo "<tr>";
							echo "<td>".$row['rest_name']."</td>"; 
							echo "<td>"."<img src='../adminpage/".$row['rest_pic_file']."'  style='width:100px;height:100px;'></td>"; 
							echo "<td>"."<form id='form1' action='review.php' method='GET'>
                                <input type='image' name='submit' src='../adminpage/".$row['product_pic_path']."'style='width:100px;height:100px;'>
                                <input type='hidden' name='getid' value='".$row['product_id']."'>
                        </form>
                </td>";
							echo "<td>".$row['product_name']."</td>"; 
							echo "<td>CAD$ ".$row['product_price']."</td>";
							echo '<td>  <form action="food.php" method="GET">
										<input type="hidden" name="product_id" value="'.$row['product_id'].'" />
										<input type="hidden" name="rest_id" value="'.$row['rest_id'].'" />
										<input type="submit" class="button btn" value="Add Cart"></form>
								  </td>'; 
			
			
							echo "</tr>";
							
							 
						}
					echo "</table>";  
		  }
        ?>
    </div> 
</div>
