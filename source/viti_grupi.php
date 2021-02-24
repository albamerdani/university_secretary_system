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
<title>Shto Vitin dhe Grupin</title>
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

<div id="viti">
<p>
<form method="POST" action="">
<table>
<tr>
<td>Viti Akademik</td>
<td><input type = "text" name="viti" id="viti"></td>
</tr>
</table>
<input type="submit" name="shto_vit" id="shto_vit" value="Shto Vit Akademik" class="btn btn-success"/>
</form>
</p>
</div>


<?php

if(isset($_POST['shto_vit'])){
	
	$viti = $_POST['viti'];

	$shto_vit = mysqli_query($lidhje, "INSERT INTO viti_akademik(Id_VA,Viti_Akademik) VALUES ('','$viti')");

	if (!isset($shto_vit))
		echo "<p>Nuk u realizua veprimi.</p>";
	else
		echo "<p>Veprimi u ekzekutua me sukses. Ju sapo shtuat nje vit akademik.</p>";
}

?>

<div id="grupi">
<p>
<form method="POST" action="">
<table>

<tr>
<td>Zgjidh vitin akademik: </td>
<td><select name="zgjedhje_viti" id="zgjedhje_viti">
<option value=""></option>

<?php
	$query = mysqli_query($lidhje, "SELECT * FROM viti_akademik");
	while($viti = mysqli_fetch_array($query)){
		echo "<option value='".$viti['Id_VA']."'>".$viti['Viti_Akademik']."</option>";
	}
?>
</select></td>
</tr>
<tr>
<td>Emertimi: </td>
<td><input type ="text" name="emertimi" id="emertimi"/></td>
</tr>
<tr>
<td>Zgjidh departamentin: </td>
<td><select name="zgjedhje_dep" id="zgjedhje_dep">
<option value=""></option>
<?php
	$query_dep = mysqli_query($lidhje, "SELECT Id_Dep,Emertimi FROM departamenti");
	while($dep = mysqli_fetch_array($query_dep)){
		echo "<option value='".$dep['Id_Dep']."'>".$dep['Emertimi']."</option>";
	}
?>

</select></td>
</tr>
</table>

<input type="submit" name="shto_grup" id="shto_grup" value="Shto Grupin" class="btn btn-success"/>
</form>
</p>
</div>

<?php

if(isset($_POST['shto_grup'])){
	
	$grupi = $_POST['emertimi'];
	$vit_akad = $_POST['zgjedhje_viti'];
	$vit_dep = $_POST['zgjedhje_dep'];

	$shto_grup = mysqli_query($lidhje, "INSERT INTO grup_m(IdGM,Emertimi,Id_VA,Id_Dep) VALUES ('','$grupi','$vit_akad','$vit_dep')");

	if (!isset($shto_grup))
		echo "<p>Nuk u realizua veprimi.</p>";
	else
		echo "<p>Veprimi u ekzekutua me sukses. Ju sapo shtuat nje grup mesimor.</p>";
}

?>


<p><b>Lista e Viteve Akademike</b></p>
<div>
<table border = "2" id="vitet" class="table table-hover table-striped">
<thead>
<tr class="table success">
<th>Id Viti Akademik</th>
<th>Viti Akademik</th>
</tr>
</thead>
<tbody>

<?php
	$lista_vit_query = "SELECT * FROM viti_akademik";
	$lista_vit = mysqli_query($lidhje, $lista_vit_query);
	
	if(!$lista_vit)
	{
		echo("Veprimi nuk u realizua");
	}
	else{
		
		while($viti_akad = mysqli_fetch_array($lista_vit))
		{
			echo "<tr align = 'center' ><td>" . $viti_akad['Id_VA'] ."</td>";
			echo "<td>".$viti_akad['Viti_Akademik']."</td></tr>";
		}
	
	}
?>
</tbody>
</table>
</div>


<p><b>Lista e Grupeve Mesimore</b></p>
<div>
<table border = "2" id="grupet" class="table table-hover table-striped">
<thead>
<tr class="table success">
<th>Id Grupi Mesimor</th>
<th>Emertimi Grupit</th>
<th>Departamenti</th>
<th>Id Vitit Akademik</th>
</tr>
</thead>
<tbody>

<?php
	$lista_gr_query = "SELECT * FROM grup_m";
	$lista_gr = mysqli_query($lidhje, $lista_gr_query);
	
	if(!$lista_gr)
	{
		echo("Veprimi nuk u realizua");
	}
	else{
		
		while($gm = mysqli_fetch_array($lista_gr))
		{
			$id_dep = $gm['Id_Dep'];
			echo "<tr align = 'center' ><td>" . $gm['IdGM'] ."</td>";
			echo "<td>".$gm['Emertimi']."</td>";
			
			$dep = mysqli_query($lidhje, "SELECT Emertimi FROM departamenti WHERE Id_Dep = '$id_dep'");
			$dep_em = mysqli_fetch_array($dep);
			
			echo "<td>".$dep_em['Emertimi']."</td>";
			echo "<td>".$gm['Id_VA']."</td></tr>";
		}
	}
	mysqli_close($lidhje);
?>
</tbody>
</table>
</div>

<script>
$(document).ready(function() {
    $('#grupet').DataTable();
	$('#vitet').DataTable();
} );
</script>

<p><form method="post" action="logout.php"><input type="submit" name="logout" value="Log out" id="logout" class="btn btn-primary"></form></p>

	<?php include("footer.php");?>

</body>
</html>
