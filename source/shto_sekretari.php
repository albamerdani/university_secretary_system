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

<title>Regjistrim</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<link type="text/css" rel="stylesheet" href="style/regjistrim.css"> 
<script type="text/javascript" src="validime_regjistrimi.js"></script>

</head>

<body>

<div id="regjistrim" class="div">
<p><b>Regjistrim Sekretarie</b><p>

<a href="admin.php">Home <span class="glyphicon glyphicon-home"></span></a>

<table>
<form method="POST" action="">

<tr>
<td>Username</td>
<td><input type="text" name="user" id="user" required/></td>
</tr>
<tr>
<td>Password</td>
<td><input type="password" name="psw" id="psw" required/></td>
</tr>
<tr>
<td>Re - Password</td>
<td><input type="password" name="re_psw" id="re_psw" required/></td>
</tr>
</table>
<input type="submit" name="buton_regjistrimi" id="buton_regjistrimi" value="Regjistro sekretarine" class="btn btn-success"/>
</form>
<p><form method="POST" action="logout.php"><input type="submit" name="logout" value="Log out" id="logout" class="btn btn-primary"/></form></p>
</div>
<?php
if(isset($_POST['buton_regjistrimi'])){
	$username = $_POST['user'];
	$password = $_POST['psw'];
	$re_password = $_POST['re_psw'];
	
	$user = mysqli_real_escape_string($lidhje, $username);
	$psw = mysqli_real_escape_string($lidhje, $password);
	$re_psw = mysqli_real_escape_string($lidhje, $re_password);
	
	if($password == $re_password)
	{
		$pass = crypt($psw, "$1995mysecretpassword");		//kriptimi i password-it me funksionin crypt dhe nje stringe me metoden hash
		
		$shto_rekord = mysqli_query($lidhje, "INSERT INTO user (IdUser, Lloji, Username, Password) VALUES ('','Sekretari','$user','$pass')");
		
		if(!$shto_rekord){
			echo "Veprimi nuk u realizua.";
		}
		else 
		{
			echo "Veprimi u realizua me sukses. Sekretaria u regjistrua ne databaze.";
			header("Location:admin.php");
		}
	}
	else
		echo "Password-et nuk perputhen. Ju lutem plotesojini sakte e njesoj te dy fushat e password-eve";
}
mysqli_close($lidhje);
?>

	<?php include("footer.php");?>
</body>
</html>

