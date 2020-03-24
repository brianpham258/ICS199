
<?php
include('header.php');
?>
	
<br>
<div class="centerBox content_wrap">
<form action="register_complete.php" method="POST" onsubmit="return registerFunction(this)">
<legend> <h2> Create an Account </h2> </legend>
</br>
<label for="regUsername">Username:<br><input id="regUsername" type="text" name="regUsername" size="30"><span id="errorUsername"></span></label>
</br>
<label for="regPassword">Password: <br><input id="regPassword" type="password" name="regPassword" size="30"><span id="errorPass"></span></label>
</br>
<label for="regConfirmPass">Password Confirmation: <br><input id="regConfirmPass" type="password" name"regConfirmpass" size="30"><span id="errorConPass"></span></label>
</br>
<label for="regFirstname">First Name: <br><input id="regFirstName" type="text" name="regFirstname"><span id="errorFirstName"></span></label>
</br>
<label for="regLastname">Last Name: <br><input id="regLastName" type="text" name="regLastName"><span id="errorLastName"></span></label>
</br>
<label for="regAddress">Address: <br><input id="regAddress" type="text" name="regAddress" size="40"><span id="errorAddress"></span></label>
</br>
<label for="regEmail">Email: <br><input id="regEmail" type="email" name="regEmail" size="30"><span id="errorEmail"></span></label>
</br>
<label for="regPhone">Phone number: <br><input id="regPhone" type="tel" placeholder="000-000-0000" name="regPhone"><span id="errorPhone"></span></label>
</br>
</br>
<input type="submit" value="submit">
</form>
	</div>
</br>

<?php

include('footer.html');
?>
