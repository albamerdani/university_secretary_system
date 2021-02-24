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
<title>Vleresimet</title>
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

<div id="vleresimi">
<p>

<table>

<form method="POST">
<tr>
<td>Zgjidh lenden: </td>
<td><select name="zgjedhje_lende" id="zgjedhje_lende">
	<option value=""></option>

<?php
	$query = mysqli_query($lidhje, "SELECT * FROM koke_provimi WHERE Kryetar = '$id_session'");
	while($id_kp = mysqli_fetch_array($query)){
		
		$id_lenda = array();
		for($i = 0; $i < 100; $i++) {
			$id_lenda[$i] = $id_kp['Id_Lende'];
		}
		$arrlength = count($id_lenda);
		
		for($i = 0; $i < $arrlength; $i++) {
			$query_lende = mysqli_query($lidhje, "SELECT * FROM lende WHERE Id_Lende = '$id_lenda[$i]'");
			$lenda =  mysqli_fetch_array($query_lende);
			echo "<option value='".$id_lenda[$i]."'>".$lenda['Emertim_L']."</option>";
		}
	}
?>

</select></td>
<tr>
<td><input type="submit" name="zgjidh_lende" id="zgjidh_lende" value="Zgjidh lende" class="btn btn-success"/></td></tr>
</form>
</table>

<table>
<form method="POST">
<tr>
<td>Zgjidh studentin: </td>
<td><select name="zgjedhje_std" id="zgjedhje_std">
	<option value=""></option>

<?php
if(isset($_POST['zgjidh_lende'])){
	$id_l = $_POST['zgjedhje_lende'];
	$query_std = mysqli_query($lidhje, "SELECT * FROM student_detyrim WHERE IdLenda = '$id_l'");
	while($std = mysqli_fetch_array($query_std)){
		echo "<option value='".$std['IdStudent']."'>".$std['Emer Mbiemer']."</option>";
	}
}
	
?>
</select></td>
</tr>

<tr>
<td>Zgjidh grupin mesimor: </td>
<td><select name="zgjedhje_gm" id="zgjedhje_gm">
	<option value=""></option>

<?php
if(isset($_POST['zgjidh_lende'])){
	$id_l = $_POST['zgjedhje_lende'];
	$query_gm = mysqli_query($lidhje, "SELECT * FROM koke_provimi WHERE Kryetar = '$id_session' AND Id_Lende = '$id_l'");
	while($gm = mysqli_fetch_array($query_gm)){
		$id_grupi = $gm['IdGM'];
		$query_grupi = mysqli_query($lidhje, "SELECT * FROM grup_m WHERE IdGM = '$id_grupi'");
		$grupi = mysqli_fetch_array($query_grupi);
		echo "<option value='".$grupi['IdGM']."'>".$grupi['Emertimi']."</option>";
	}
}
	
?>
</select></td>
</tr>

<tr>
<td>Zgjidh daten e provimit: <span class="glyphicons glyphicons-calendar"></span></td>
<td><select name="zgjedhje_date" id="zgjedhje_date">
	<option value=""></option>

<?php
if(isset($_POST['zgjidh_lende'])){
	$id_l = $_POST['zgjedhje_lende'];
	$query_date = mysqli_query($lidhje, "SELECT * FROM koke_provimi WHERE Kryetar = '$id_session' AND Id_Lende = '$id_l'");
	while($date = mysqli_fetch_array($query_date)){
		echo "<option value='".$date['Data']."'>".$date['Data']."</option>";
	}
}
	
?>
</select></td>
</tr>

<tr>
<td>Nota</td>
<td><input type="text" name="nota" id="nota" required /></td>
</tr>
<tr>
<td><input type="submit" name="shto_note" id="shto_note" value="Vendos noten" class="btn btn-success"/></td></tr>
</form>
</table>
</p>
</div>


<?php
if(isset($_POST['shto_note'])){
	
	$lenda = $_POST['zgjedhje_lende'];
	$std = $_POST['zgjedhje_std'];
	$grupi_mesimor = $_POST['zgjedhje_gm'];
	$data = $_POST['zgjedhje_date'];
	$nota = $_POST['nota'];

	$query_kp = mysqli_query($lidhje, "SELECT * FROM koke_provimi WHERE Kryetar = '$id_session' AND Id_Lende = '$id_l' AND Data = '$data'");
	$kp = mysql_fetch_array($query_kp);
	$provim = $kp['Id_KokeProvimi'];
	
	$shto_note = "INSERT INTO flete_provimi(Nr_rendor, Nota, Id_KokeProvimi, IdStudent, IdLenda) VALUES ('','$nota', '$provim', '$std', '$lenda')";
	
	if (!$shto_note){
		echo "<p>Nuk u realizua veprimi.</p>";
	}
	else{
		echo "<p>Veprimi u ekzekutua me sukses. Ju sapo shtuat nje vleresim.</p>";
	}
}

/*	else{
		echo "Ju duhet te zgjidhni ne fillim lenden, prandaj nuk mund te vendosni vleresimin!";
	}
*/
mysqli_close($lidhje);
?>


<p><form method="post" action="logout.php"><input type="submit" name="logout" value="Log out" id="logout" class="btn btn-primary"></form></p>

	<?php include("footer.php");?>

</body>
</html>
