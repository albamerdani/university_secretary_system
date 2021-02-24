
function check()
{
	var user = document.getElementById("username").value;
	if(user == "")
	{
	document.getElementById("mesazh").innerHTML = "Vendos nje username";
	}
	user.focus();
	return false;
}

var password1 = document.getElementById("password").value;
var password2 = document.getElementById("re-password").value;

function show_password(){
	
	var pass = document.getElementById("password");
	if(document.getElementById("check").checked){
		pass.setAttribute("type", "text");
	}
	else{
		pass.setAttribute("type", "password");
	}
}

function kontrollPassword()
{
	if(password1.length <= 6)
	{
	document.getElementById("mesazh").innerHTML = "Password duhet te jete me i gjate se 6 karaktere";
	}
	password1.focus();
	return false;
}

function formatPassword()
{
	var shprehje = /^\w*(?=\w*\d)(?=\w*[a-z])(?=\w*[A-Z])\w*$/;
	if(!shprehje.test(password1))
	{
		document.getElementById("mesazh").innerHTML = "Password duhet te permbaje te pakten nje shkronje te madhe, nje numer dhe karaktere te tjera shkronjore";
	}
	password1.focus();
	return false;
}


function krahasoPassword()
{
	if(password1 != password2)
	{
		document.getElementById("mesazh").innerHTML = "Password duhet te jene njesoj!";
	}
	password1.focus();
	return false;
}

function kontrollEmail()
{
var string = /^[a-zA-Z 0-9._-]+@upt\.edu\.al$/;
	email = document.getElementById("email");
	if(!string.test(email.value))
	{
		document.getElementById("mesazh").innerHTML = "Email nuk eshte i vlefshem.";
	}
	email.focus();
	return false;
}
	

function start()
{
	
var myInput = document.getElementById("password");
var letter = document.getElementById("letter");
var capital = document.getElementById("capital");
var number = document.getElementById("number");
var length = document.getElementById("length");

// When the user clicks on the password field, show the message box
myInput.onfocus = function() {
  document.getElementById("message").style.display = "block";
}

// When the user clicks outside of the password field, hide the message box
myInput.onblur = function() {
  document.getElementById("message").style.display = "none";
}

// When the user starts to type something inside the password field
myInput.onkeyup = function() {
  // Validate lowercase letters
  var lowerCaseLetters = /[a-z]/g;
  if(myInput.value.match(lowerCaseLetters)) { 
    letter.classList.remove("invalid");
    letter.classList.add("valid");
  } else {
    letter.classList.remove("valid");
    letter.classList.add("invalid");
}

  // Validate capital letters
  var upperCaseLetters = /[A-Z]/g;
  if(myInput.value.match(upperCaseLetters)) { 
    capital.classList.remove("invalid");
    capital.classList.add("valid");
  } else {
    capital.classList.remove("valid");
    capital.classList.add("invalid");
  }

  // Validate numbers
  var numbers = /[0-9]/g;
  if(myInput.value.match(numbers)) { 
    number.classList.remove("invalid");
    number.classList.add("valid");
  } else {
    number.classList.remove("valid");
    number.classList.add("invalid");
  }

  // Validate length
  if(myInput.value.length >= 8) {
    length.classList.remove("invalid");
    length.classList.add("valid");
  } else {
    length.classList.remove("valid");
    length.classList.add("invalid");
  }
}
	var buton = document.getElementById("buton_regjistrimi");
	buton.addEventListener("click", check, false);
	buton.addEventListener("click", kontrollPassword, false);
	buton.addEventListener("click", formatPassword, false);
	buton.addEventListener("click", krahasoPassword, false);
	buton.addEventListener("click", kontrollEmail, false);
	
}

window.addEventListener("load", start, false);
