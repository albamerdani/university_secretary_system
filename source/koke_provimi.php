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
<title>Koke Provimi</title>
<meta charset="utf8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

<link type="text/css" rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link type="text/css" rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css">

<link type="text/css" rel="stylesheet" href="stilet/instruktor.css">

<style type="text/css">
p					{font-size:16pt; font-style:bold; font-family:arial,sanserif; color:black;}
div					{left:5%; top:10%;}
</style>
</head>

<body>
<p><a href="sekretaria.php">Home <span class="glyphicon glyphicon-home"></span></a></p>

<div id="k_p">
<p>
<form method="POST" action="">
<table>

<tr>
<td>Zgjidh Grupin Mesimor: </td>
<td><select name="grupi" id="grupi">
<option value=""></option>

<?php
	$query_gm = mysqli_query($lidhje, "SELECT * FROM grup_m");
	while($grupi = mysqli_fetch_array($query_gm)){
		echo "<option value='".$grupi['IdGM']."'>".$grupi['Emertimi']."</option>";
	}
?>
</select></td>
</tr>

<tr>
<td>Zgjidh Lenden: </td>
<td><select name="lenda" id="lenda">
<option value=""></option>

<?php
	$query_l = mysqli_query($lidhje, "SELECT * FROM lende");
	while($lende = mysqli_fetch_array($query_l)){
		echo "<option value='".$lende['Id_Lende']."'>".$lende['Emertim_L']."</option>";
	}
?>
</select></td>
</tr>

<tr>
<td>Zgjidh Kryetarin e Komisionit: </td>
<td><select name="kryetar" id="kryetar">
<option value=""></option>

<?php
	$query_k = mysqli_query($lidhje, "SELECT * FROM pedagogu WHERE Titulli = 'Prof.Asoc'");
	while($krye = mysqli_fetch_array($query_k)){
		echo "<option value='".$krye['IdPedagog']."'>".$krye['Emer Mbiemer']."</option>";
	}
?>
</select></td>
</tr>

<tr>
<td>Zgjidh Anetarin 1 te Komisionit: </td>
<td><select name="anetar1" id="anetar1">
<option value=""></option>

<?php
	$query_a1 = mysqli_query($lidhje, "SELECT * FROM pedagogu");
	while($an1 = mysqli_fetch_array($query_a1)){
		echo "<option value='".$an1['IdPedagog']."'>".$an1['Emer Mbiemer']."</option>";
	}
?>
</select></td>
</tr>

<tr>
<td>Zgjidh Anetarin 2 te Komisionit: </td>
<td><select name="anetar2" id="anetar2">
<option value=""></option>

<?php
	$query_a2 = mysqli_query($lidhje, "SELECT * FROM pedagogu");
	while($an2 = mysqli_fetch_array($query_a2)){
		echo "<option value='".$an2['IdPedagog']."'>".$an2['Emer Mbiemer']."</option>";
	}
?>
</select></td>
</tr>


<tr>
<td>Zgjidh Sezonin: </td>
<td><select name="sezoni" id="sezoni">
<option value=""></option>
<option value="Dimer">Dimer</option>
<option value="Vere">Vere</option>
<option value="Vjeshte">Vjeshte</option>

</select></td>
</tr>



<tr>
<td>Data: <span class="glyphicons glyphicons-calendar"></span></td>
<td><input type ="date" name="data" id="data"/></td>
</tr>


</table>

<input type="submit" name="shto_koke_provimi" id="shto_koke_provimi" value="Krijo Koke Provimi" class="btn btn-success"/>
</form>
</p>
</div>

<?php
if(isset($_POST['shto_koke_provimi'])){
	
	$grupi = $_POST['grupi'];
	$lenda = $_POST['lenda'];
	$kryetar = $_POST['kryetar'];
	$anetar1 = $_POST['anetar1'];
	$anetar2 = $_POST['anetar2'];
	$sezoni = $_POST['sezoni'];
	$data = $_POST['data'];
	
	if($kryetar != $anetar1 && $kryetar != $anetar2 && $anetar1 != $anetar2){
		$shto_kp = mysqli_query($lidhje, "INSERT INTO koke_provimi(Id_KokeProvimi, Sezoni, Data, Id_Lende, Kryetar, Anetar1, Anetar2, IdGM) 
											VALUES ('','$sezoni', '$data', '$lenda', '$kryetar', '$anetar1', '$anetar2', '$grupi')");
											
		if (!$shto_kp)
			echo "<p>Nuk u realizua veprimi.</p>";
		else
			echo "<p>Veprimi u ekzekutua me sukses. Ju sapo krijuat nje koke provimi.</p>";
	}
	else{
		echo "<p>Vendosni 3 pedagoge te ndryshem si pjesetare komisioni.</p>";
	}
	
}
?>


<p><b>Lista e Provimeve</b></p>
<div>
<table border = "2" id="provime" class="table table-hover table-striped">
<thead>
<tr class="table danger">
<th>Id Koke Provimi</th>
<th>Sezoni</th>
<th>Data</th>
<th>Lenda</th>
<th>Kryetari Komisionit</th>
<th>Anetari i Komisionit</th>
<th>Anetari i Komisionit</th>
<th>Grupi Mesimor</th>

</tr>
</thead>
<tbody>

<?php
	$lista = "SELECT * FROM koke_provimi";
	$lista_kp = mysqli_query($lidhje, $lista);
	
	if(!$lista_kp)
	{
		echo("Veprimi nuk u realizua");
	}
	else{
		
		while($row = mysqli_fetch_array($lista_kp))
		{
			$id_l = $row['Id_Lende'];
			$lenda_q = mysqli_query($lidhje, "SELECT Emertim_L FROM lende WHERE Id_Lende = '$id_l'");
			$lenda = mysqli_fetch_assoc($lenda_q);
			
			$id_k = $row['Kryetar'];
			$pedagog_k = mysqli_query($lidhje, "SELECT 'Emer Mbiemer' FROM pedagogu WHERE IdPedagog = '$id_k'");
			$pedagog_kryetar = mysqli_fetch_assoc($pedagog_k);
			
			$id_a1 = $row['Anetar1'];
			$pedagog_a1_q = mysqli_query($lidhje, "SELECT 'Emer Mbiemer' FROM pedagogu WHERE IdPedagog = '$id_a1'");
			$pedagog_a1 = mysqli_fetch_assoc($pedagog_a1_q);
			
			$id_a2 = $row['Anetar2'];
			$pedagog_a2_q = mysqli_query($lidhje, "SELECT 'Emer Mbiemer' FROM pedagogu WHERE IdPedagog = '$id_a2'");
			$pedagog_a2 = mysqli_fetch_assoc($pedagog_a2_q);
			
			$id_gm = $row['IdGM'];
			$grup_q = mysqli_query($lidhje, "SELECT Emertimi FROM grup_m WHERE IdGM = '$id_gm'");
			$grup = mysqli_fetch_assoc($grup_q);
		
			echo "<tr align = 'center' ><td>" . $row['Id_KokeProvimi'] ."</td>";
			echo "<td>".$row['Sezoni']."</td>";
			echo "<td>".$row['Data']."</td>";
			echo "<td>".$lenda['Emertim_L']."</td>";
			echo "<td>".$pedagog_kryetar['Emer Mbiemer']."</td>";
			echo "<td>".$pedagog_a1['Emer Mbiemer']."</td>";
			echo "<td>".$pedagog_a2['Emer Mbiemer']."</td>";
			echo "<td>".$grup['Emertimi']."</td></tr>";

		}
	
	}

	mysqli_close($lidhje);
?>
</tbody>
</table>
</div>


<script>
$(document).ready(function() {
    $('#provime').DataTable();
} );
</script>

<p><form method="post" action="logout.php"><input type="submit" name="logout" value="Log out" id="logout" class="btn btn-primary"></form></p>

	<?php include("footer.php");?>

</body>
</html>

