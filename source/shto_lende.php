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
<title>Shto Lende</title>
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

<style type="text/css">
p					{font-size:16pt; font-style:bold; font-family:arial,sanserif; color:black;}
div					{left:5%; top:10%;}
</style>
</head>

<body>
<p><a href="sekretaria.php">Home <span class="glyphicon glyphicon-home"></span></a></p>
<p>
<form method="POST" action="">
<table>
<tr>
<td>Lenda</td>
<td><input type = "text" name="lenda" id="lenda"></td>
</tr>
<tr>
<td>Numri Leksioneve</td>
<td><input type = "number" name="nr_Leksion" id="nr_Leksion"/></td>
</tr>
<tr>
<td>Numri Seminareve</td>
<td><input type = "number" name="nr_Seminar" id="nr_Seminar"/></td>
</tr>
<tr>
<td>Numri Laboratoreve</td>
<td><input type = "number" name="nr_Lab" id="nr_Lab"/></td>
</tr>
<tr>
<td>Detyra Kursi</td>
<td><input type="radio" name="detyra" id="detyra" value="1"/> Po <input type="radio" name="detyra" id="detyra" value="0"/> Jo </td>
</tr>
<tr>
<td>Numri Krediteve</td>
<td><input type = "number" name="nr_KFU" id="nr_KFU"/></td>
</tr>

<tr>
<td>Zgjidh Pedagogun: </td>
<td><select name="pedagogu" id="pedagogu">
<option value=""></option>

<?php
	$query_pedagog = mysqli_query($lidhje, "SELECT * FROM pedagogu");
	while($p = mysqli_fetch_array($query_pedagog)){
		echo "<option value='".$p['IdPedagog']."'>".$p['Emer Mbiemer']."</option>";
	}
?>
</select></td>
</tr>

</table>
<input type="submit" name="shto_lende" value="Shto Lende" class="btn btn-success"/>
</form>
</p>

<?php
if(isset($_POST['shto_lende'])){
	
	$lenda = $_POST['lenda'];
	$nr_lex = $_POST['nr_Leksion'];
	$nr_sem = $_POST['nr_Seminar'];
	$nr_lab = $_POST['nr_Lab'];
	$detyra = $_POST['detyra'];
	$nr_kfu = $_POST['nr_KFU'];
	$id_pedagog = $_POST['pedagogu'];
	$shto_lende = "INSERT INTO lende(Id_Lende,Emertim_L,Nr_Leksion,Nr_Seminar,Nr_Lab,Detyre_Kursi,Nr_KFU,IdPedagog) 
					VALUES ('','$lenda','$nr_lex','$nr_sem','$nr_lab','$detyra','$nr_kfu','$id_pedagog')";

	if (!$shto_lende)
		echo "<p>Nuk u realizua veprimi.</p>";
	else
		echo "<p>Veprimi u ekzekutua me sukses. Ju sapo shtuat nje lende.</p>";
}
?>

<p><b>Lista e Lendeve Mesimore</b></p>
<div>
<table border = "2" id="lendet" class="table table-hover table-striped">
<thead>
<tr class="table info">
<th>Id Lenda</th>
<th>Emertimi Lendes</th>
<th>Leksione</th>
<th>Seminare</th>
<th>Laboratore</th>
<th>Detyra</th>
<th>Kredite</th>
<th>Pedagogu</th>
</tr>
</thead>
<tbody>

<?php
	$lista_lende = mysqli_query($lidhje, "SELECT * FROM lende");
	
	if(!$lista_lende)
	{
		echo("Veprimi nuk u realizua");
	}
	else{
		
		while($lende = mysqli_fetch_array($lista_lende))
		{
			$id_p = $lende['IdPedagog'];
			echo "<tr align = 'center' ><td>" . $lende['Id_Lende'] ."</td>";
			echo "<td>".$lende['Emertim_L']."</td>";
			echo "<td>".$lende['Nr_Leksion']."</td>";
			echo "<td>".$lende['Nr_Seminar']."</td>";
			echo "<td>".$lende['Nr_Lab']."</td>";
			
			if($lende['Detyre_Kursi'] == 1){
				echo "<td>Po</td>";
			}
			else{
				echo "<td>Jo</td>";
			}
			echo "<td>".$lende['Nr_KFU']."</td>";
			
			$pedagog = mysqli_query($lidhje, "SELECT * FROM pedagogu WHERE IdPedagog = '$id_p'");
			$pedagog_em = mysqli_fetch_array($pedagog);
			
			echo "<td>".$pedagog_em['Emer Mbiemer']."</td></tr>";
		}
	}
	mysqli_close($lidhje);
?>
</tbody>
</table>
</div>

<script>
$(document).ready(function() {
    $('#lendet').DataTable();
} );
</script>


<p><form method="post" action="logout.php"><input type="submit" name="logout" value="Log out" id="logout" class="btn btn-primary"></form></p>
	<?php include("footer.php");?>

</body>
</html>
