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
<p><a href="shiko_vleresimet.php">Go back</a></p>
<p><b></b></p>

<div>
<?php 

	if (isset($_GET['view'])&&isset($_GET['std'])){
		$view_id = $_GET['view'];
		$std_id = $_GET['std'];
		
		$vleresimet = mysqli_query($lidhje, "SELECT * FROM flete_provimi WHERE IdStudent = '$std_id' AND IdLenda = '$view_id'");
	
	if(!$vleresimet)
	{
		echo("Veprimi nuk u realizua");
	}

	while($row = mysqli_fetch_array($vleresimet))
	{
		$emri_l = mysqli_query($lidhje, "SELECT * FROM lende WHERE Id_Lende = '$view_id'");
        $lenda = mysqli_fetch_array($emri_l);
		$id_pedagog = $lenda['IdPedagog'];
		$pedagog_query = mysqli_query($lidhje, "SELECT * from pedagogu WHERE IdPedagog = '$id_pedagog'");
		$pedagog = mysqli_fetch_assoc($pedagog_query);
		
		$id_kp = $row['Id_KokeProvimi'];
		
		$select = mysqli_query($lidhje, "SELECT * FROM koke_provimi WHERE Id_KokeProvimi = '$id_kp' AND IdLenda = '$id_lenda'");
		$kp = mysqli_fetch_array($select);
		echo "<p>Lenda: " . $lenda['Emertim_L'] ."</p>";
		echo "<p>Sezoni: ".$kp['Sezoni']."</p>";
		echo "<p>Data: ".$kp['Data']."</p>";
		echo "<p>Komisioni</p>";
		echo "<p>Kryetari: ".$kp['Kryetari']."</p>";
		echo "<p>Anetari 1: ".$kp['Anetar1']."</p>";
		echo "<p>Anetari 2: ".$kp['Anetar2']."</p>";
		echo "<p>Pedagogu i lendes: ".$pedagog['Emer Mbiemer']."</p>";
		echo "<p>Kredite: ".$lenda['Nr_KFU']."</p>";
		echo "<p>Nota: ".$row['Nota']."</p>";
	}
}
?>
</div>

<p><form method="post" action="logout.php"><input type="submit" name="logout" value="Log out" id="logout" class="btn btn-primary"/></form></p>
	<?php include("footer.php");?>

</body>
</html>
