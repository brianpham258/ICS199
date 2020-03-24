

<head>
	<link rel="stylesheet" href="includes/css/newStyle.css" type="text/css">
</head>
<?php	
	include('header.php');
	include('connect.php');

	$regUser = $_POST['regUsername'];
	$regPass = SHA1($_POST['regPassword']);
	$regFirstName = $_POST['regFirstname'];
	$regLastName = $_POST['regLastName'];
	$regAddress = $_POST['regAddress'];
	$regEmail = $_POST['regEmail'];
	$regPhone = $_POST['regPhone'];

	$query = "INSERT INTO CUSTOMER (user_authority, username, password, first_name, last_name, email, address, phone, AGREE_YN)
			VALUES('03', '$regUser', '$regPass', '$regFirstName', '$regLastName', '$regEmail', '$regAddress', '$regPhone', 'Y');";

	$result = mysqli_query($connectData, $query);

	if($result){
		print "<p class='success'>Register Complete!</p>";
	}else{
		//print mysqli_error($connectData);
		print '<h2><span>Username Already Exist</span>';
	}

	mysqli_close($connectData); 

?>
