function loginFunction(){
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

function registerFunction(){
	//Clear the error output
	document.getElementById("errorUsername").innerHTML="";
	document.getElementById("errorPass").innerHTML="";
	document.getElementById("errorFirstName").innerHTML="";
	document.getElementById("errorLastName").innerHTML="";
	document.getElementById("errorAddress").innerHTML="";
	document.getElementById("errorEmail").innerHTML="";
	document.getElementById("errorPhone").innerHTML="";

	var regUsername = document.getElementById("regUsername").value;
	var regPass = document.getElementById("regPassword").value;
	var regConPass = document.getElementById("regConfirmPass").value;
	var regFirstName = document.getElementById("regFirstName").value;
	var regLastName = document.getElementById("regLastName").value;
	var regAddress = document.getElementById("regAddress").value;
	var regEmail = document.getElementById("regEmail").value;
	var regPhone = document.getElementById("regPhone").value;

	//Validate username
	var checkUserName = validateUserName(regUsername);
	//Validate password
	var checkPassword = validatePassword(regPass, regConPass);
	//Validate First and Last Name
	var checkName = validateName(regFirstName, regLastName);
	//Validate address
	var checkAddress = validateAddress(regAddress);
	//Validate email
	var checkEmail = validateEmail(regEmail);
	//Validate Phone number
	var checkPhone = validatePhone(regPhone);
	
	if((!checkUserName) || (!checkPassword) || (!checkName) || (!checkAddress) || (!checkEmail) || (!checkPhone)){
	//	alert("return false" + checkUserName + checkPassword + checkName + checkAddress + checkEmail + checkPhone);
		return false;
	}
}
// validation function for username
function validateUserName(username){
	if(username == ""){
		document.getElementById("errorUsername").innerHTML=" *Username is Empty";
		return false;
	}
	var regUsername = /[^a-zA-Z0-9\-\/]/;
	if(regUsername.test(username)){
		document.getElementById("errorUsername").innerHTML=" *Invalid character";
		return false;
	}
	if(regUsername.length > 16){
		document.getElementById("errorUsername").innerHTML=" *Username is too long";
		return false;
	}
	return true;
	
}
//validation for password
function validatePassword(password, confirmPassword){
	var isNotValid = true;
	if(password == ""){
                document.getElementById("errorPass").innerHTML=" *Password is Empty";
		isNotValid = false;
	}
	if(confirmPassword == ""){
		document.getElementById("errorConPass").innerHTML=" *Confirmation password is Empty";
		isNotValid = false;
	}else{
		if(password != confirmPassword){
			document.getElementById("errorConPass").innerHTML=" *Password Doesn't Match";
			isNotValid = false;
		}else{
			document.getElementById("errorConPass").innerHTML="";
		}
	}
	if(password.length < 8){
		document.getElementById("errorPass").innerHTML=" *Password should be more than 8 characters";
		isNotValid = false;
	}
	if(password.length > 17){
                document.getElementById("errorPass").innerHTML=" *The Maximum character is 16";
		isNotValid = false;
        }
	return isNotValid;
}
// validation function for first and last name
function validateName(firstName, lastName){
	var isNotValid = true;
	if(firstName == ""){
                document.getElementById("errorFirstName").innerHTML=" *First name is empty";
		isNotValid = false;
        }else if(/[^a-zA-Z]/.test(firstName)){
		document.getElementById("errorFirstName").innerHTML=" *Invalid characters";
		isNotValid = false;
	}else if(firstName.length > 16){
                document.getElementById("errorfirstName").innerHTML=" *First name is too long";
		isNotValid = false;
        }
	if(lastName == ""){
                document.getElementById("errorLastName").innerHTML=" *Last name is empty";
		isNotValid = false;
        }else if(/[^a-zA-Z]/.test(firstName)){
                document.getElementById("errorLastName").innerHTML=" *Invalid characters";
		isNotValid = false;
        }else if(lastName.length > 16){
		document.getElementById("errorLastName").innerHTML=" *Last name is too long";
		isNotValid = false;
	}
	return isNotValid;
}

//validation function for Address
function validateAddress(address){
        if(address == ""){
                document.getElementById("errorAddress").innerHTML=" *Address is empty";
		return false;
        }else if(/[<>?@#$%^*()]/.test(address)){
                document.getElementById("errorAddress").innerHTML=" *Invalid characters";
		return false;
        }else if(address.length > 30){
		document.getElementById("errorAddress").innerHTML=" *Characters is too long";
		return false;
	}
	return true;

}

//validation function for email
function validateEmail(email){
	var regEmail = /.*\w@(.*[a-zA-Z]){2}\.(.*[a-zA-Z]){2}/;
	if(email == ""){
		document.getElementById("errorEmail").innerHTML=" *Email is empty";
		return false;
	}else if (!regEmail.test(email)){
		document.getElementById("errorEmail").innerHTML=" *Invalid email address";
		return false;
	}else if(email > 25){
		document.getElementById("errorEmail").innerHTML=" *This email is too long";
		return false;
	}
	return true;
}
//validation function for phone number
function validatePhone(phone){
	var regEx1 = /\d{3}-\d{3}-\d{4}$/;
	var regEx2 = /^\d{10}$/;
	var regEx3 = /\d{3}\s\d{3}\s\d{4}$/;
	if ((regEx1.test(phone)) || (regEx2.test(phone)) || (regEx3.test(phone))){
		return true;
	}else{
		document.getElementById("errorPhone").innerHTML=" *Invalid phone number";
		return false;
	}
}
