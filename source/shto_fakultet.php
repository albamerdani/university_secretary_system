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

<title>Regjistrim fakulteti</title>
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
<p><b>Regjistrim Fakulteti</b><p>

<a href="admin.php">Home <span class="glyphicon glyphicon-home"></span></a>

<div id="fakultet">

<form method="POST" action="">
<table>
<tr>
<td>Zgjidh IAL: </td>
<td><select name="ial" id="ial" style="color:black">
<option value=""></option>

<?php
	$query = mysqli_query($lidhje, "SELECT * FROM ial");
	while($ial = mysqli_fetch_array($query)){
		echo "<option value='".$ial['Id_IAL']."'>".$ial['Emertimi']."</option>";
	}
?>
</select></td>
</tr>
<tr>
<td>Emertimi i Fakultetit</td>
<td><input type="text" name="emertimi" id="emertimi" size="40" required/></td>
</tr>
<tr>
<td>Dekani</td>
<td><input type="text" name="dekani" id="dekani" required/></td>
</tr>
</table>
<input type="submit" name="buton_regjistrimi" id="buton_regjistrimi" value="Regjistro fakultet" class="btn btn-success"/>
</form>
<p><form method="POST" action="logout.php"><input type="submit" name="logout" value="Log out" id="logout" class="btn btn-primary"/></form></p>
</p>
</div>
<?php
if(isset($_POST['buton_regjistrimi'])){
	$emri = $_POST['emertimi'];
	$dekani = $_POST['dekani'];
	$ial = $_POST['ial'];
	
	$emertimi = mysqli_real_escape_string($lidhje, $emri);
	$dekani = mysqli_real_escape_string($lidhje, $dekani);
	
	
		$shto_rekord = mysqli_query($lidhje, "INSERT INTO fakulteti (Id_Fakulteti, Emertimi_F, Dekani, Id_IAL) VALUES ('','$emertimi','$dekani', '$ial')");
		
		if(!$shto_rekord){
			echo "Veprimi nuk u realizua.";
		}
		else 
		{
			echo "Veprimi u realizua me sukses. Fakulteti u regjistrua ne databaze.";
			header("Location:shto_fakultet.php");
		}
}
mysqli_close($lidhje);
?>

	<?php include("footer.php");?>

</body>
</html>

