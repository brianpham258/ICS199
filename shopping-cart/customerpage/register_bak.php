<!DOCTYPE html>
<html>

<?php
include('header.php');
?>
    <head lang="en">
        <!--Required meta tags-->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Registration</title>
       
        <!--Bootstrap CSS-->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="includes/css/newStyle.css" type="text/css"/>
    </head>
	<body>
	<center><h1 id="logo">Registration</h1></center>
	
<br>
<div class="container">

<legend> <h2> Create an Account </h2> </legend>
</br>
<lable for="username">Username <input id="username" type="text"></lable>
</br>
<lable for="password">Password <input id="password" type="text"></lable>
</br>
<lable for="confirmPass">Password Confirmation <input id="confirmPass" type="text"></lable>
</br>
<lable for="firstname">First Name <input id="firstName" type="text"></lable>
</br>
<lable for="lastname">Last Name <input id="lastName" type="text"></lable>
</br>
<lable for="address">Adress <input id="adress" type="text"></lable>
</br>
<lable for="email">EMail <input id="EMail" type="email"></lable>
</br>
<lable for="phone">Phone # <input id="Phone" type="tel" placeholder="phone number"></lable>
</br>
</br>
<button id="myButton">Submit</button></div>
	</div>
</br>
<?php
	//database script
    	include('connect.php');
	


?>
	
        <!--Optional JavaScript-->
        <script src="includes/js/script.js"></script>
        <!--JQuery first, then Popper.js, then Bootstrap JS-->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>"
	</body>
	<footer>
	</footer>
	</html>
