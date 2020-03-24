<div class="foodHeader">
    <div class="foodContent">
        <?php 
			session_start(); 
			if (isset($_SESSION['username'])){
				//echo ">username->".$_SESSION['username'].">cust_id->".$_SESSION['cust_id']; 
		    
			$product_id=$_GET['product_id']; 
			$rest_id=$_GET['rest_id'];  
			$cust_id=$_SESSION['cust_id'];  // it shuoud be changed later to real data on webpage!!! 
            include("connect.php");   
			 
				$query = "SELECT CASE WHEN A.RNUM = 1 THEN A.ORDER_ID ELSE '' END MAIN_NO, A.ORDER_ID, A.REST_ID, 
									CASE WHEN A.RNUM =1 THEN A.REST_NAME ELSE '' END REST_NAME,  
									A.PRODUCT_ID, A.PRODUCT_NAME, A.PRODUCT_PIC_PATH, A.QUANTITY, A.PRODUCT_PRICE,
									ROUND(A.PRODUCT_PRICE * A.QUANTITY,2) TOTAL_AMOUNT, 
									(SELECT COUNT(1) FROM ORDERINFO OO, SOLD_PRODUCT SS
											WHERE OO.ORDER_ID = SS.ORDER_ID 
														AND OO.ORDER_STATUS='05' 
														AND OO.CUST_ID = $cust_id 
														AND OO.ORDER_ID = A.ORDER_ID) CNT
							FROM (
							SELECT O.ORDER_ID, O.REST_ID, R.REST_PIC_FILE, S.PRODUCT_ID, P.PRODUCT_PIC_PATH, S.QUANTITY, R.REST_NAME, P.PRODUCT_NAME, P.PRODUCT_PRICE
							  , (CASE @vorder_id WHEN O.ORDER_ID THEN @rownum:=@rownum+1 ELSE @rownum:=1 END) rnum
							  ,  (@vorder_id:=O.ORDER_ID) vorder_id 
							FROM ORDERINFO O, SOLD_PRODUCT S, PRODUCT P, RESTAURANT R, (SELECT @vorder_id:=0, @rownum:=0 FROM DUAL) b
							WHERE O.CUST_ID = $cust_id  
							AND O.ORDER_ID = S.ORDER_ID
							AND O.ORDER_STATUS = '05'
							AND O.REST_ID = R.REST_ID
							AND S.PRODUCT_ID = P.PRODUCT_ID
							AND S.QUANTITY > 0
							) A
							UNION ALL                                
							SELECT '', '', '', '', '','', '','',ROUND(SUM(XP.PRODUCT_PRICE * XS.QUANTITY),2) TOTAL_AMOUNT, '', ''
														 FROM ORDERINFO XO, SOLD_PRODUCT XS, PRODUCT XP, RESTAURANT XR 
														WHERE XO.CUST_ID = $cust_id  
														  AND XO.ORDER_ID = XS.ORDER_ID
														  AND XO.ORDER_STATUS = '05'
														  AND XO.REST_ID = XR.REST_ID
														  AND XS.PRODUCT_ID = XP.PRODUCT_ID
														  AND XS.QUANTITY > 0 ;";
				$result = mysqli_query($connectData, $query);

				echo "<table id='display' class='table'>";
					echo "<tr>"; 
						echo    "<th>Restaurant</th>"; 
						echo    "<th>Product Name</th>";
						echo    "<th>Product Picture</th>";
						echo    "<th>Product Price</th>";
						echo    "<th>Product Quantity</th>";
						echo    "<th>Sub Amount</th>"; 
					echo "</tr>"; 

					while($row=mysqli_fetch_array($result, MYSQLI_ASSOC)) {
						// display each row 
						echo "<tr>";
						echo "<td>".$row['REST_NAME']."</td>";   // COL1. RESTAURANT
						echo "<td>".$row['PRODUCT_NAME']."</td>";  // COL2. PRODUCT_NAME
						if (!empty($row['PRODUCT_PIC_PATH'])){    // COL3. PRODUCT PICTURE
							echo "<td>"."<img src='../adminpage/".$row['PRODUCT_PIC_PATH']."'  style='width:50px;height:50px;'></td>";  
						}
						else {
							echo "<td></td>";
						}
						if (!empty($row['PRODUCT_PIC_PATH'])) {    // COL4. PRODUCT PRICE
							echo "<td>CDN $".number_format($row['PRODUCT_PRICE'],2)."</td>"; 
						}
						else {
							echo "<td><h3 style=color:red;>Total Amount:<h3></td>";
						}
						if (!empty($row['QUANTITY'])) {    // COL5. PRODUCT QUANTITY
			// Start of Quang's code
							echo "<td>
									<form action='update-product.php' method='POST'> 
										<input type='number' id='qty' name='quantity' value=".$row['QUANTITY']." min=0 max=100>
										<br>
											<div class='row'>
												<div class='col-md-3'>
													<input type='submit' class='btn btn-success' value='Update'>
													<input type='hidden' name='product_id' value='".$row['PRODUCT_ID']."'>
													<input type='hidden' name='order_id' value='".$row['ORDER_ID']."'>
													<input type='hidden' name='count' value='".$row['CNT']."'>
												</div>
									</form>
									<form action='delete-product.php' method='POST'>
												<div class='col-md-3'>
													<input type='submit' class='btn btn-danger' value='Delete'>
													<input type='hidden' name='product_id' value='".$row['PRODUCT_ID']."'>
													<input type='hidden' name='order_id' value='".$row['ORDER_ID']."'>
													<input type='hidden' name='count' value='".$row['CNT']."'>
												</div>
											</div>
									</form>
							 </td>";
						}
			// End of Quang's code
						else {
							echo "<td><h3 style=color:red;>CDN $".number_format($row['PRODUCT_PRICE'],2)."<h3></td>"; 
						}
						if (empty(!$row['QUANTITY'])){     //COL6. PRODUCT SUB TOTAL
							echo "<td>CDN $".number_format($row['TOTAL_AMOUNT'],2)."</td>"; 
						}
						else {
							if($row['PRODUCT_PRICE'] > 0){
							  echo "<td> 
								   <form action='checkout.php' method='GET'> 
									<input type='hidden' name='amount' value='".$row['PRODUCT_PRICE']."'>  
									<input type='submit' class='button btn' value='CHECK OUT'>
								   </form>
								   </td>";
							}
						}
					echo"</tr>";		 
				}
				echo "</table>";
			}

			mysqli_close($dbc);
        ?>
    </div> 
</div>
</body>
<footer></footer>
</html>
