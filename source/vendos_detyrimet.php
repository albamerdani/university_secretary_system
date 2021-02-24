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
<title>Detyrimet Akademike</title>
<meta charset="utf8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<link type="text/css" rel="stylesheet" href="style/profil_pedagog.css">
</head>

<body>
<p><a href="pedagog.php">Home <span class="glyphicon glyphicon-home"></span></a></p>

<div id="detyrimi">
<p>
<form method="POST" action="">
<table>

<tr>
<td>Zgjidh studentin: </td>
<td><select name="zgjedhje_std" id="zgjedhje_std">
	<option value=""></option>

<?php
	$query = mysqli_query($lidhje, "SELECT * FROM student");
	while($std = mysqli_fetch_array($query)){
		echo "<option value='".$std['IdStudent']."'>".$std['Emer Mbiemer']."</option>";
	}
?>
</select></td>
</tr>
<tr>
<td>Zgjidh lenden: </td>
<td><select name="zgjedhje_lende" id="zgjedhje_lende">
	<option value=""></option>

<?php
	$query_lende = mysqli_query($lidhje, "SELECT Id_Lende,Emertim_L FROM lende");
	while($lenda = mysqli_fetch_array($query_lende)){
		echo "<option value='".$lenda['Id_Lende']."'>".$lenda['Emertim_L']."</option>";
	}
?>

</select></td>
</tr>
<tr>
<td>Detyrimi Akademik</td>
<td><input type="radio" name="detyrimi" id="detyrimi" value="1"/> Po <input type="radio" name="detyrimi" id="detyrimi" value="0"/> Jo </td>
</tr>
</table>

<input type="submit" name="shto_detyrim" id="shto_detyrim" value="Shto Detyrimin Akademik" class="btn btn-success"/>
</form>
</p>
</div>


<?php
if(isset($_POST['shto_detyrim'])){
	
	$detyrimi = $_POST['detyrimi'];
	$std = $_POST['zgjedhje_std'];
	$lende = $_POST['zgjedhje_lende'];

	$shto_detyrim = mysqli_query($lidhje, "INSERT INTO detyrim(Id_Detyrim, Detyrim_A, IdStudent, IdLenda) VALUES ('','$detyrimi', '$std', '$lende')");

	if (!isset($shto_detyrim))
		echo "<p>Nuk u realizua veprimi.</p>";
	else
		echo "<p>Veprimi u ekzekutua me sukses. Ju sapo vendoset nje detyrim akademik.</p>";
}

mysqli_close($lidhje);
?>


<p><form method="post" action="logout.php"><input type="submit" name="logout" value="Log out" id="logout" class="btn btn-primary"></form></p>

	<?php include("footer.php");?>

</body>
</html>
