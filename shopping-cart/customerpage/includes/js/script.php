<script>
function loginFunction(){
	//alert("JS is working");
	var username = document.getElementById("username").value;
	var password = document.getElementById("password").value;
	if(username == ""){
		document.getElementById("usernameError").innerHTML= "*Invalid Username ID";
		//return false;
	}
	if(password == ""){
		document.getElementById("passwordError").innerHTML="*Invalid Password";
		//return false;
	}
	if((username == "") || (password == ""))
		return false;
}
</script>
