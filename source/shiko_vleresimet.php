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

<link type="text/css" rel="stylesheet" href="style/profil_student.css">
</head>

<body>
<p><a href="student.php">Home <span class="glyphicon glyphicon-home"></span></a></p>
<p><b>Vleresimet e Lendeve</b></p>
<div>
<table border = "2">
<thead>
<tr>
<th>Lenda</th>
<th>Sezoni</th>
<th>Data</th>
<th>Kryetari</th>
<th>Anetari 1</th>
<th>Anetari 2</th>
<th>Pedagogu</th>
<th>Kredite</th>
<th>Nota</th>
<th>View</th>

</tr>
</thead>
<tbody>

<?php
	$id_s = mysqli_query($lidhje, "SELECT * FROM user WHERE Username = '$username_session' AND Password = '$password_session' AND IdUser = '$id_session'");
	$id = mysqli_fetch_assoc($id_s);
	$id_std = $id['Id_S_P'];
	
	$vleresimet = mysqli_query($lidhje, "SELECT * FROM flete_provimi WHERE IdStudent = '$id_std'");
	
	if(!$vleresimet)
	{
		echo("Veprimi nuk u realizua");
	}

	while($row = mysqli_fetch_array($vleresimet))
	{
		$id_lenda = $row['IdLenda'];
		$emri_l = mysqli_query($lidhje, "SELECT * FROM lende WHERE Id_Lende = '$id_lenda'");
        $lenda = mysqli_fetch_assoc($emri_l);
		$id_l = $lenda['Id_Lende'];
		$id_pedagog = $lenda['IdPedagog'];
		$pedagog_query = mysqli_query($lidhje, "SELECT * from pedagogu WHERE IdPedagog = '$id_pedagog'");
		$pedagog = mysqli_fetch_assoc($pedagog_query);
		
		$id_kp = $row['Id_KokeProvimi'];
		
		$select = mysqli_query($lidhje, "SELECT * FROM koke_provimi WHERE Id_KokeProvimi = '$id_kp' AND IdLenda = '$id_l'");
		$kp = mysqli_fetch_array($select);
		echo "<tr align = 'center' ><td>" . $lenda['Emertim_L'] ."</td>";
		echo "<td>".$kp['Sezoni']."</td>";
		echo "<td>".$kp['Data']."</td>";
		echo "<td>".$kp['Kryetari']."</td>";
		echo "<td>".$kp['Anetar1']."</td>";
		echo "<td>".$kp['Anetar2']."</td>";
		echo "<td>".$pedagog['Emer Mbiemer']."</td>";
		echo "<td>".$lenda['Nr_KFU']."</td>";
		echo "<td>".$row['Nota']."</td>";
		echo "<td><a href='shiko_note.php?view=$id_l&std=$id_std'>View</a></td></tr>";
	}
	
	mysqli_close($lidhje);
?>
</tbody>
</table>
</div>

<p><form method="post" action="logout.php"><input type="submit" name="logout" value="Log out" id="logout" class="btn btn-primary"/></form></p>
	<?php include("footer.php");?>

</body>
</html>
