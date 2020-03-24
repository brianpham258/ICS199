<?php
include('header.php');

session_start();

if(isset($_SESSION['username'])){
	//user is login
	$user = $_SESSION['cust_id'];
	// user $user
}else{
	//user is not login
}

?>

<!-- HEADER -->
<div id="header" style="height:660px; padding-top:200px">
    <h1>Welcome To ThinkFood</h1>
    <br>
    <h4>Are you feeling hungry? Thinking about food?</h4>
    <br>
    <h4>&#10084 &#10084 &#10084 We are here for you &#10084 &#10084 &#10084</h4>
</div>


<?php
include("connect.php");

$customer_id = $_SESSION['cust_id'];

// display the first recomm
$query = "SELECT product_pic_path, product_id, product_name FROM PRODUCT
			WHERE product_category = (SELECT product_category 
										FROM PRODUCT 
										WHERE product_id = (SELECT sd.product_id
															FROM SOLD_PRODUCT sd, ORDERINFO o, CUSTOMER c
															WHERE o.order_status='03'
															AND	sd.order_id = o.order_id
															AND o.cust_id = c.cust_id
															AND c.cust_id = $customer_id
															ORDER BY sd.order_id 
															DESC LIMIT 1))
			AND RECOMMEND_YN = 'Y'
            GROUP BY product_id
            ASC LIMIT 1;";
			
// display the second recomm
$query1 = "SELECT product_pic_path, product_id, product_name FROM PRODUCT
			WHERE product_category = (SELECT product_category 
										FROM PRODUCT 
										WHERE product_id = (SELECT sd.product_id
															FROM SOLD_PRODUCT sd, ORDERINFO o, CUSTOMER c
															WHERE o.order_status='03'
															AND	sd.order_id = o.order_id
															AND o.cust_id = c.cust_id
															AND c.cust_id = $customer_id
															ORDER BY sd.order_id 
															DESC LIMIT 1))
			AND RECOMMEND_YN = 'Y'
            GROUP BY product_id
            ASC LIMIT 1,1;";

// display the third recomm	
$query2 = "SELECT product_pic_path, product_id, product_name FROM PRODUCT
			WHERE product_category = (SELECT product_category 
										FROM PRODUCT 
										WHERE product_id = (SELECT sd.product_id
															FROM SOLD_PRODUCT sd, ORDERINFO o, CUSTOMER c
															WHERE o.order_status='03'
															AND	sd.order_id = o.order_id
															AND o.cust_id = c.cust_id
															AND c.cust_id = $customer_id
															ORDER BY sd.order_id 
															DESC LIMIT 1))
			AND RECOMMEND_YN = 'Y'
            GROUP BY product_id
            DESC LIMIT 1;";
			
$result = mysqli_query($connectData, $query);
$result1 = mysqli_query($connectData, $query1);
$result2 = mysqli_query($connectData, $query2);

while($row=mysqli_fetch_array($result, MYSQLI_ASSOC)) {
		echo ' <div class="containers">';
			echo '<center>';
				echo '<div class="row">';
						echo '<div class="col-md-4">';
								echo "<div>".$row['product_name']."</div>"; 
								echo "<div>"."<form id='form1' action='review.php' method='GET'>
									<input type='image' name='submit' src='../adminpage/".$row['product_pic_path']."''>
									<input type='hidden' name='getid' value='".$row['product_id']."'>
									</form>";
								echo '</div>';
						echo '</div>';

}
while($row=mysqli_fetch_array($result1, MYSQLI_ASSOC)) {
						echo '<div class="col-md-4">';
								echo "<div>".$row['product_name']."</div>"; 
								echo "<div>"."<form id='form1' action='review.php' method='GET'>
									<input type='image' name='submit' src='../adminpage/".$row['product_pic_path']."''>
									<input type='hidden' name='getid' value='".$row['product_id']."'>
									</form>";
								echo '</div>';
						echo '</div>';
}						
while($row=mysqli_fetch_array($result2, MYSQLI_ASSOC)) {
						echo '<div class="col-md-4">';
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
	echo '<div class="blank"></div>';
}



													/*This situation based on there is no order history (random select 3 recomm in thinkphood.php)*/
//check there is a product_category	id or not											
$query3 = "SELECT product_pic_path, product_id, product_name FROM PRODUCT
			WHERE product_category = (SELECT product_category 
										FROM PRODUCT 
										WHERE product_id = (SELECT sd.product_id
															FROM SOLD_PRODUCT sd, ORDERINFO o, CUSTOMER c
															WHERE o.order_status='03'
															AND	sd.order_id = o.order_id
															AND o.cust_id = c.cust_id
															AND c.cust_id = $customer_id
															ORDER BY sd.order_id 
															DESC LIMIT 1))
			AND RECOMMEND_YN = 'Y'
            GROUP BY product_id
            ASC LIMIT 1;";													
$result3 = mysqli_query($connectData, $query3);		
$row=mysqli_fetch_array($result3, MYSQLI_ASSOC);
//get the product_category
$product_category = $row["product_category"];  

	if(empty($product_category)){
		include("connect.php");
		//first
		$query4 = "SELECT product_pic_path, product_id, product_name 
				   FROM PRODUCT
				   WHERE RECOMMEND_YN = 'Y'
				   ORDER BY RAND()
				   ASC LIMIT 1;";	
		//second
		$query5 = "SELECT product_pic_path, product_id, product_name 
				   FROM PRODUCT
				   WHERE RECOMMEND_YN = 'Y'
				   ORDER BY RAND()
				   ASC LIMIT 1,1;";	
		//third
		$query6 = "SELECT product_pic_path, product_id, product_name 
				   FROM PRODUCT
				   WHERE RECOMMEND_YN = 'Y'
				   ORDER BY RAND()
				   DESC LIMIT 1;";		

	$result4 = mysqli_query($connectData, $query4);
	$result5 = mysqli_query($connectData, $query5);
	$result6 = mysqli_query($connectData, $query6);	

		while($row=mysqli_fetch_array($result4, MYSQLI_ASSOC)) {
				echo ' <div class="containers">';
					echo '<center>';
						echo '<div class="row">';
								echo '<div class="col-md-4">';
										echo "<div>".$row['product_name']."</div>"; 
										echo "<div>"."<form id='form1' action='review.php' method='GET'>
											<input type='image' name='submit' src='../adminpage/".$row['product_pic_path']."''>
											<input type='hidden' name='getid' value='".$row['product_id']."'>
											</form>";
										echo '</div>';
								echo '</div>';

		}
		while($row=mysqli_fetch_array($result5, MYSQLI_ASSOC)) {
								echo '<div class="col-md-4">';
										echo "<div>".$row['product_name']."</div>"; 
										echo "<div>"."<form id='form1' action='review.php' method='GET'>
											<input type='image' name='submit' src='../adminpage/".$row['product_pic_path']."''>
											<input type='hidden' name='getid' value='".$row['product_id']."'>
											</form>";
										echo '</div>';
								echo '</div>';
		}						
		while($row=mysqli_fetch_array($result6, MYSQLI_ASSOC)) {
								echo '<div class="col-md-4">';
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
			echo '<div class="blank"></div>';
		}		   
	}










											
						
?>

           
<?php
    include('footer.html');
?>
