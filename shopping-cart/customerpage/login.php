<?php
    include('header.php');

    include('connect.php');
	$clickAgree = $_GET['clickAgree'];  
	if ($clickAgree == 'Y') {
		 $userName = $_SESSION['username']; 
	}
	else {
		$userName = $_GET['username'];
		$userPassword = $_GET['password'];    
	}
	
	 // just clicked the agree button
    //querying
    $selectUser = "SELECT * FROM CUSTOMER WHERE username = '$userName';";
	 //echo "<script type='text/javascript'>alert('$clickAgree');</script>"; 
     //echo "<script type='text/javascript'>alert('$user');</script>";
	$result = mysqli_query($connectData, $selectUser);
    if($result){
		//echo "<script type='text/javascript'>alert('ok');</script>"; 
    }else{
		//echo "<script type='text/javascript'>alert('fail');</script>"; 
    }

    $row = mysqli_fetch_array($result);
	$agree_yn = $row["AGREE_YN"];  // already agreed the policy 
    session_start(); 
	
    if(isset($userName)){ 
		if(($userName == $row["username"]) && (SHA1($userPassword) == $row["password"]) || $clickAgree == 'Y'){ 
			$_SESSION['cust_id']=$row["cust_id"];
			$_SESSION['user_authority']=$row["user_authority"];
			$_SESSION['username']=$userName;
			$_SESSION['first_name']=$row["first_name"]; 
			 
			if ($agree_yn == 'Y' || $clickAgree =='Y' ) { //   agreed  
					$cust_id = $_SESSION['cust_id']; 
					if ($clickAgree =='Y') {
						$sql_last_login = "UPDATE CUSTOMER SET LAST_LOGIN_DATE = NOW(), AGREE_YN = 'Y' WHERE CUST_ID = $cust_id;";
					}
					else {
						$sql_last_login = "UPDATE CUSTOMER SET LAST_LOGIN_DATE = NOW() WHERE CUST_ID = $cust_id;";
					}
					
					$result_sql_last_loging = mysqli_query($connectData, $sql_last_login);
					// check the result  
						if($result_sql_last_loging){  // 1(true)
							//header("Location: thinkfood.php");
						}else{  // null(false)
							print "<h4>Last Login Time, Error Occured.".mysqli_error($connectData)." Please contact with system administrator<h4>";
						}
					header("Location: thinkfood.php");
			}
			else {
				 header("Location: privacy_term.php");
			}
			// last login time update by james
		
		}else{
			print '<br><h1><center style="color: red;font-weight: bold;font-size: 0.6em;">Username or password are incorrect! Please try again!</center><br></h1>';
		}
    }


    mysqli_close($connectData);

?>
<head>
<link rel="stylesheet" href="includes/css/newStyle.css" type="text/css">
</head>
<!--Log in Modal-->
<div class="centerBox">
<h1>Log In</h1>
<br>
<form action="login.php" onsubmit="return loginFunction(this)" method="GET" id="login">
<label for="username">Username: <br><input id="username" type="text" name="username" size="30"><span id="usernameError"></span></label>
</br>
<label for="password">Password: <br><input id="password" type="password" name="password" size="30"><span id="passwordError"></span></label>
</br>
<input type="submit" value="Login">
</form>
</div>


<?php

    include('footer.html');
?>
