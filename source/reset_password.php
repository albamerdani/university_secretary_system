<?php
include("lidhje_databaze.php");
session_start();

if(isset($_SESSION['usr_session']) && isset($_SESSION['psw_session'])){
	$username_session = $_SESSION['usr_session'];
	$password_session = $_SESSION['psw_session'];
	$id_session = $_SESSION['id_session'];
}
else{
	$username_session = "";
	$password_session = "";
	$id_session = "";
}

?>

<!DOCTYPE html>
<html>
<head>

<title>Blog</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- jQuery library-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<link rel="stylesheet" type="text/css" href="style/regjistrim.css">

</head>

<body>

<div class="col-md-4" class="div" id="reset">
<form method="post">
<p>Username
<input type="text" name="username" id="username" size="30"  required/></p>
<p>Email
<input type="email" name="email" id="user_email" size="30" required/></p>
<p>New Password
<input type="password" name="new_password" id="password" size="30" required/></p>
<p>Re-enter Password
<input type="password" name="re_password" id="password" size="30" required/></p>

<input type="submit" name="reset" id="reset" value="Reset" class="btn btn-success"/>
</form>
</div>


<?php
if(isset($_POST['reset'])){
	$username=$_POST['username'];
	$email=$_POST['email'];
	$new_password=$_POST['new_password'];
	$re_password=$_POST['re_password'];
	
	$username = mysqli_real_escape_string($username);
	$new_password = mysqli_real_escape_string($new_password);
	$re_password = mysqli_real_escape_string($re_password);
	
	if($new_password="" || $re_password="" || $email="" || $username=""){
		echo "Ploteso fushat!";
	}
	
	else{
		
		if($new_password != $re_password){
			echo "<p>Passwordet nuk perputhen!</p>";
		}
	
		else{
			$new_password = crypt($new_password, "$1995mysecretpassword");
			
			$reset = "UPDATE user SET Password='$new_password' WHERE Username='$username' AND IdUser='$id_session'";
			$reset_query = mysqli_query($lidhje, $reset);

			if($reset_query){
				echo "<p>Password u ndryshua!</p>";
			}
			else{
				echo "<p>Password nuk mund te ndryshohet!</p>";
			}
			
		}
	}
}
mysqli_close($lidhje);
?>

<p><form method="post" action="logout.php"><input type="submit" name="logout" value="Log out" id="logout" class="buton"/></form></p>
	<?php include("footer.php");?>

</body>
</html>
