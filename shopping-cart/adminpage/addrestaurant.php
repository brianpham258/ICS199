<?php
	include('header.html');

?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
<div class="containers">
	<div class="addrestaurant">
	<form id="restform" action="restaurant_add_vars.php" method="POST" enctype="multipart/form-data">
        	Restaurant Name: 
		<br><input type="text" size="30" name="restaurantName" required><br><br>
        	Restaurant Address: 
		<br><input type="text" size="50" name="restaurantAddress"><br><br>
        	Restaurant Phone: 
		<br><input type="text" size="30" name="restaurantPhone"><br><br>
        	Restaurant Description: 
		<br><textarea name="descRestaurant" rows="4" cols="50"></textarea><br><br>
        	Restaurant Picture: <input type="file" name="fileToUpload" id="fileToUpload" required><br><br><br>
        	<br>
        	<input type="submit" value="submit">
	</form> 
	</div>
</div>

<?php
	include('footer.html');
?>

