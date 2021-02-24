<?php
include("lidhje_databaze.php");
global $lidhje;
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
<script type="text/javascript" src="validime.js"></script>

</head>

<body>

<div id="regjistrim" class="div">
<p><b>Regjistrim Studenti</b><p>

<a href="sekretaria.php">Home <span class="glyphicon glyphicon-home"></span></a>

<form method="POST" action="">
<table>
<tr>
<td>Username</td>
<td><input type="text" name="username" id="username" size="20"/></td>
</tr>
<tr>
<td>Password</td>
<td><input type="password" name="password" id="password" size="20" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,} required/></td>
</tr>
<tr>
<td>Re-enter Password</td>
<td><input type="password" name="re-password" id="re-password" size="20" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,} required/></td>
</tr>
<tr>
<td>Emer Mbiemer</td>
<td><input type="text" name="emri" id="emri" size="40" required/></td>
</tr>
<tr>
<td>Gjinia</td>
<td><input type="radio" name="gjinia" id="gjinia" value="Mashkull"/> Mashkull <input type="radio" name="gjinia" id="gjinia" value="Femer"/> Femer </td>
</tr>
<tr>
<td>Ditelindja</td>
<td><input type="date" name="ditelindja" id="ditelindja" required/></td>
</tr>
<tr>
<td>Email</td>
<td><input type="email" name="email" id="email" size="40" required/></td>
</tr>
<tr>
<td>Vendlindja</td>
<td><input type="text" name="vendlindja" id="vendlindja" size="40"/></td>
</tr>
<tr>
<td>Numer telefoni</td>
<td><input type="tel" name="nr_tel" id="nr_tel" size="20"/></td>
</tr>
<tr>
<td>Grupi Mesimor</td>
<td><select name="grupi" id="grupi" style="color:black;">
<option value=""></option>
<?php

	$query_gm = mysqli_query($lidhje, "SELECT * FROM grup_m");
	while($grupi_m = mysqli_fetch_array($query_gm)){
		echo "<option value='".$grupi_m['IdGM']."'>".$grupi_m['Emertimi']."</option>";
	}
?>
</select></td>
</tr>
<tr>
<td><input type="submit" name="buton_regjistrimi" id="buton_regjistrimi" value="Regjistro student" class="btn btn-success"/></td>
<td></td>
</tr>
</table>

<!--
<div id="message">
  <h3>Password duhet te permbaje:</h3>
  <p id="letter" class="invalid">Nje <b>shkronje te vogel</b></p>
  <p id="capital" class="invalid">Nje <b>shkronje te madhe</b></p>
  <p id="number" class="invalid">Nje <b>numer</b></p>
  <p id="length" class="invalid">Minimum <b>8 karaktere</b></p>
</div>-->

</form>
<form method="POST" action="logout.php"><input type="submit" name="logout" value="Log out" id="logout" class="btn btn-info"/></form>
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
	$gjinia = $_POST['gjinia'];
	print($gjinia);
	$ditelindja = $_POST['ditelindja'];
	print($ditelindja);
	$email = $_POST['email'];
	print($email);
	$vendlindja = $_POST['vendlindja'];
	print($vendlindja);
	$nr_tel = $_POST['nr_tel'];
	print($nr_tel);
	$grup = $_POST['grupi'];
	print($grup);
	
	$username = mysqli_real_escape_string($lidhje, $username);
	$password = mysqli_real_escape_string($lidhje, $password);
	$re_password = mysqli_real_escape_string($lidhje, $re_password);
	$emri = mysqli_real_escape_string($lidhje, $emri);
	
	if($password == $re_password)
	{
		$password = crypt($password, "$1995mysecretpassword");		//kriptimi i password-it me funksionin crypt dhe nje stringe me metoden hash
		
		$shto_rekord = mysqli_query($lidhje, "INSERT INTO student('IdStudent', 'Emer Mbiemer', 'IdGM', 'Gjinia', 'Ditelindja', 'Email', 'NrTel', 'Vendlindja') VALUES ('','$emri','$grup','$gjinia','$ditelindja','$email','$nr_tel','$vendlindja')");
			
		if($shto_rekord){
			$merr_id_query = mysqli_query($lidhje, "SELECT * FROM student WHERE 'Emer Mbiemer' = '$emri'");
			$merr_id = mysqli_fetch_array($merr_id_query);
			$id_std = $merr_id['IdStudent'];
			
			$shto_rekord2 = mysqli_query($lidhje, "INSERT INTO user(IdUser, LLoji, Username, Password, Id_S_P) VALUES ('','Student','$username','$password','$id_std')");

			if (!$shto_rekord2){
				echo "Veprimi nuk u realizua. Useri nuk u shtua!";
			}
			else 
			{
				echo "Veprimi u realizua me sukses. Studenti u regjistrua ne databaze.";
				header("Location:sekretaria.php");
			}
		}
		else{
			echo "Studenti nuk mund te shtohet!";
		}
	
	}
	else{
		echo "Password-et nuk perputhen. Ju lutem plotesojini sakte e njesoj te dy fushat e password-eve";
	}
}
mysqli_close($lidhje);
?>

	<?php include("footer.php");?>

</body>
</html>

