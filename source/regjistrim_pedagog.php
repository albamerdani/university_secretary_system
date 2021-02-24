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
<p><b>Regjistrim Pedagogu</b><p>

<a href="sekretaria.php">Home <span class="glyphicon glyphicon-home"></span></a>

<table>
<form method="POST" action="">
<tr>
<td>Username</td>
<td><input type="text" name="username" id="username" size="20"/></td>
</tr>
<tr>
<td>Password</td>
<td><input type="password" name="password" id="password" size="20" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required/></td>
</tr>
<tr>
<td>Re-enter Password</td>
<td><input type="password" name="re-password" id="re-password" size="20" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required/></td>
</tr>
<tr>
<td>Emer Mbiemer</td>
<td><input type="text" name="emri" id="emri" size="40" required/></td>
</tr>
<tr>
<td>Titulli</td>
<td><input type="text" name="titulli" id="titulli" required/></td>
</tr>
<tr>
<td>Email</td>
<td><input type="email" name="email" id="email" size="40" required/></td>
</tr>
</table>
<input type="submit" name="buton_regjistrimi" id="buton_regjistrimi" value="Regjistro pedagog" class="btn btn-success"/>


<!--
<div id="message">
  <h3>Password duhet te permbaje:</h3>
  <p id="letter" class="invalid">Nje <b>shkronje te vogel</b></p>
  <p id="capital" class="invalid">Nje <b>shkronje te madhe</b></p>
  <p id="number" class="invalid">Nje <b>numer</b></p>
  <p id="length" class="invalid">Minimum <b>8 karaktere</b></p>
</div>-->

</form>
<p><form method="POST" action="logout.php"><input type="submit" name="logout" value="Log out" id="logout" class="btn btn-info"/></form></p>
</div>
<?php
if(isset($_POST['buton_regjistrimi'])){
	$username = $_POST['username'];
		print($username);
	$password = $_POST['password'];
		print($password);
	$re_password = $_POST['re-password'];
		print($re_password);
	$emri = $_POST['emri'];
		print($emri);
	$titulli = $_POST['titulli'];
		print($titulli);
	$email = $_POST['email'];
	print($email);
	
	$username = mysqli_real_escape_string($lidhje, $username);
	$password = mysqli_real_escape_string($lidhje, $password);
	$re_password = mysqli_real_escape_string($lidhje, $re_password);
	$emri = mysqli_real_escape_string($lidhje, $emri);
	
	if($password == $re_password)
	{
		$password = crypt($password, "$1995mysecretpassword");		//kriptimi i password-it me funksionin crypt dhe nje stringe me metoden hash
		
		$shto_rekord = mysqli_query($lidhje, "INSERT INTO pedagogu('IdPedagog', 'Emer Mbiemer', 'Titulli', 'Email') VALUES ('','$emri','$titulli','$email')");
		
		if($shto_rekord){
			$merr_id_query = mysql_query("SELECT * FROM pedagogu WHERE 'Emer Mbiemer'='$emri'");
			$merr_id = mysql_fetch_array($merr_id_query);
			$id_p = $merr_id['IdPedagog'];
			
			$shto_rekord2 = mysqli_query($lidhje, "INSERT INTO user(IdUser, LLoji, Username, Password, Id_S_P) VALUES ('','Pedagog','$username','$password', '$id_p')");

			if (!$shto_rekord2){
				echo "Veprimi nuk u realizua.";
			}
			else 
			{
				echo "Veprimi u realizua me sukses. Pedagogu u regjistrua ne databaze.";
				header("Location:sekretaria.php");
			}
		}
		else{
			echo "Pedagogu nuk mund te regjistrohet!";
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

