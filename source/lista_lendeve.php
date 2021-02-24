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
<title>Lista Lendeve</title>
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

<link type="text/css" rel="stylesheet" href="style/profil_student.css">
</head>

<body>
<p><a href="student.php">Home <span class="glyphicon glyphicon-home"></span></a></p>
<p><b>Lista e Lendeve</b></p>

<div>
<table id="lista_lende" border="2" class="table table-hover table-striped">
<thead>
<tr class="table danger">
<th>Id Lende</th>
<th>Emertim Lende</th>
<th>Ore Leksion</th>
<th>Ore Seminar</th>
<th>Numri Laboratoreve</th>
<th>Detyre Kursi</th>
<th>Numri KFU</th>
<th>Pedagog</th>
<th>Detyrim</th>
</tr>
</thead>
<tbody>

<?php
	$lista_lendeve = mysqli_query($lidhje, "SELECT* FROM lende");
	
	if(!$lista_lendeve)
	{
		echo("Veprimi nuk u realizua");
	}

	while($row = mysqli_fetch_array($lista_lendeve))
	{
		$id_p = $row['IdPedagog'];
		$emri = mysqli_query($lidhje, "SELECT * FROM pedagogu WHERE IdPedagog = '$id_p'");
        $em = mysqli_fetch_array($emri);
		
		$id_lende = $row['Id_Lende'];
		
		$id_s_query = mysqli_query($lidhje, "SELECT 'Id_S_P' FROM user WHERE Username = '$username_session' AND Password = '$password_session' AND IdUser = '$id_session'");
        $id_s = mysqli_fetch_assoc($id_s_query);
		$id = $id_s['Id_S_P'];
		
		$select = mysqli_query($lidhje, "SELECT Detyrim_A FROM detyrim WHERE IdStudent = '$id' AND IdLenda = '$id_lende'");
		$detyrim = mysqli_fetch_array($select);
		echo "<tr align = 'center' ><td>" . $row[0] ."</td>";
		echo "<td>".$row[1]."</td>";
		echo "<td>".$row[2]."</td>";
		echo "<td>".$row[3]."</td>";
		echo "<td>".$row[4]."</td>";
		echo "<td>".$row[5]."</td>";
		echo "<td>".$row[6]."</td>";
		echo "<td>".$em['Emer Mbiemer']."</td>";
		if($detyrim['Detyrim_A'] == 1){
			echo "<td>Po</td></tr>";
		}
		else{
			echo "<td>Jo</td></tr>";
		}
	}
	
	mysqli_close($lidhje);
?>
</tbody>
</table>
</div>

<script>
	$(document).ready(function() {
		$('#lista_lende').DataTable();
	} );
</script>

<p><form method="post" action="logout.php"><input type="submit" name="logout" value="Log out" id="logout" class="btn btn-primary"/></form></p>

	<?php include("footer.php");?>

</body>
</html>
