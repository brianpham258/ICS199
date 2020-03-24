<?php 
	session_start(); 
    include('connect.php');
	$cust_id = $_SESSION['cust_id'];   
    $updateUser = "UPDATE CUSTOMER SET AGREE_YN = 'N' WHERE cust_id ='$cust_id';";
	 //echo "<script type='text/javascript'>alert('$clickAgree');</script>"; 
     //echo "<script type='text/javascript'>alert('$user');</script>";
	$result = mysqli_query($connectData, $updateUser);
    if($result){
		header("Location: logout.php"); 
    }else{
		//echo "<script type='text/javascript'>alert('fail');</script>"; 
    }
  
    mysqli_close($connectData);

?> 


<?php

    include('footer.html');
?>
