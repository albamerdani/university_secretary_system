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
<title>Shto Departamentin</title>
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

<div id="dep">
<p>
<form method="POST" action="">
<table>

<tr>
<td>Zgjidh fakultetin: </td>
<td><select name="fakultet" id="fakultet">
<option value=""></option>

<?php
	$query = mysqli_query($lidhje, "SELECT * FROM fakulteti");
	while($fakulteti = mysqli_fetch_array($query)){
		echo "<option value='".$fakulteti['Id_Fakulteti']."'>".$fakulteti['Emertimi_F']."</option>";
	}
?>
</select></td>
</tr>
<tr>
<td>Emertimi: </td>
<td><input type ="text" name="emertimi" id="emertimi"/></td>
</tr>
<tr>
<td>Shefi Departamentit: </td>
<td><input type ="text" name="shefi" id="shefi"/></td>
</tr>

</table>

<input type="submit" name="shto_dep" id="shto_dep" value="Shto Departamentin" class="btn btn-success"/>
</form>
</p>
</div>

<?php
if(isset($_POST['shto_dep'])){
	
	$fakulteti = $_POST['fakultet'];
	$emertimi = $_POST['emertimi'];
	$shefi = $_POST['shefi'];
	
	$shto_dep = mysqli_query($lidhje, "INSERT INTO departamenti(Id_Dep,Emertimi, Shefi, Id_Fakulteti) VALUES ('','$emertimi', '$shefi', '$fakulteti')");

	if (!isset($shto_dep))
		echo "<p>Nuk u realizua veprimi.</p>";
	else
		echo "<p>Veprimi u ekzekutua me sukses. Ju sapo shtuat nje departament.</p>";
}
?>


<p><b>Lista e Departamenteve</b></p>
<div>
<table border = "2" id="departamentet" class="table table-hover table-striped">
<thead>
<tr class="table success">
<th>Id_Departamenti</th>
<th>Emertimi</th>
<th>Shefi</th>
<th>Fakulteti</th>

</tr>
</thead>
<tbody>

<?php
	$lista = "SELECT * FROM departamenti";
	$lista_dep = mysqli_query($lidhje, $lista);
	
	if(!$lista_dep)
	{
		echo("Veprimi nuk u realizua");
	}
	else{
		
		while($row = mysqli_fetch_array($lista_dep))
		{
			$id_f = $row['Id_Fakulteti'];
			$emri = mysqli_query($lidhje, "SELECT Emertimi_F FROM fakulteti WHERE Id_Fakulteti = '$id_f'");
			$emri_f = mysqli_fetch_assoc($emri);
		
			echo "<tr align = 'center' ><td>" . $row['Id_Dep'] ."</td>";
			echo "<td>".$row['Emertimi']."</td>";
			echo "<td>".$row['Shefi']."</td>";
			echo "<td>".$emri_f['Emertimi_F']."</td></tr>";
		}
	
	}

	mysqli_close($lidhje);
?>
</tbody>
</table>
</div>

<script>
$(document).ready(function() {
    $('#departamentet').DataTable();
} );
</script>

<p><form method="post" action="logout.php"><input type="submit" name="logout" value="Log out" id="logout" class="btn btn-primary"></form></p>

	<?php include("footer.php");?>

</body>
</html>

