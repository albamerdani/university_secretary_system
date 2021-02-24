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

<title>Regjistrim IAL</title>
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

</head>

<body>

<div id="regjistrim" class="div">
<p><b>Regjistrim IAL</b><p>

<a href="admin.php">Home <span class="glyphicon glyphicon-home"></span></a>

<form method="POST" action="">
<table>
<tr>
<td>Emertimi i IAL</td>
<td><input type="text" name="emertimi" id="emertimi" size="40" required/></td>
</tr>
<tr>
<td>Rektori</td>
<td><input type="text" name="rektori" id="rektori" size="40" required/></td>
</tr>
</table>
<input type="submit" name="buton_regjistrimi" id="buton_regjistrimi" value="Regjistro IAL" class="btn btn-success"/>
</form>
<p><form method="POST" action="logout.php"><input type="submit" name="logout" value="Log out" id="logout" class="btn btn-primary"/></form></p>
</p>
</div>
<?php
if(isset($_POST['buton_regjistrimi'])){
	
	$emri = $_POST['emertimi'];
	$rek = $_POST['rektori'];
	
	$emertimi = mysqli_real_escape_string($lidhje, $emri);
	$rek_ial = mysqli_real_escape_string($lidhje, $rek);
	
	
		$shto_rekord = mysqli_query($lidhje, "INSERT INTO ial (Id_IAL, Emertimi, Rektori) VALUES ('','$emertimi','$rek_ial')");
		
		if(!$shto_rekord){
			echo "Veprimi nuk u realizua.";
		}
		else 
		{
			echo "Veprimi u realizua me sukses. IAL u regjistrua ne databaze.";
			header("Location:shto_IAL.php");
		}
}
mysqli_close($lidhje);
?>

	<?php include("footer.php");?>

</body>
</html>

