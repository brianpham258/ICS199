<?php
	include('header.html');
?>
 
<?php
	$restaurantid=$_GET['restaurant_id']; 
	echo '<form action="menu_add_vars.php" method="POST" enctype="multipart/form-data">
			Menu Name:<br> <input type="text" name="menuName" required><br>
			Menu Price:<br> <input type="text" name="menuPrice" required><br>
			Menu Category:<select name="menuCategory" required>
				<option value="06">Others</option><option value="02">Dessert</option>
				<option value="03">Fries</option><option value="04">Hamburger</option>
				<option value="05">Noodle</option><option value="01">Chicken</option>
				<option value="07">Pizza</option><option value="08">Rice</option>
				<option value="09">Seafood</option>
		    </select><br>
			Menu Description:<br> <textarea name="descMenu" rows="4" cols="50"></textarea><br>
			Menu Picture:<br> <input type="file" name="fileToUpload" id="fileToUpload" required>
			<input type="hidden" name="restaurant_id" value='.$restaurantid.' />
			<br><br>
			<input type="submit" value="submit">
		  </form>'
?> 
<?php

include('footer.html');
?>

<!-- Menu Category:<br> <input type="text" name="menuCategory"><br> -->
 
