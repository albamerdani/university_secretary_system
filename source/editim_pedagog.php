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
<title>Editim</title>
<meta charset="utf-8">
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
<p>Edito te dhenat e pedagogut</p>

		<div>
			<table id="pedagoget" class="table table-hover table-striped" border="2">
				<thead>
					<tr class="table info">
					<th>Pedagog ID</th>
					<th>Emer Mbiemer</th>
					<th>Email</th>
					<th>Titulli Shkencor</th>
					<th>Edit</th>
					</tr>
				</thead>
					
				<tbody>
					<?php
						$select =  "SELECT * FROM pedagogu";
						$select_p = mysqli_query($lidhje, $select);
						
						while($row = mysqli_fetch_array($select_p)){
							$p_id = $row['IdPedagog'];
							$emri = $row['Emer Mbiemer'];
							$email = $row['Email'];
							$titulli = $row['Titulli'];
							
							echo "<tr><td>$p_id</td>";
							echo "<td>$emri</td>";
							echo "<td>$email</td>";
							echo "<td>$titulli</td>";
							echo "<td><a href='editim_pedagog.php?edit=$p_id'>Edit</a></td></tr>";
						}
					?>
				</tbody>
			</table>
		</div>
		
		
		<div class="col-xs-6">
			<form action="" method="post">
				<div class="form-group">
					<?php 		
						if(isset($_GET['edit'])){
							$p_id = $_GET['edit'];
						
							$select_query = "SELECT * FROM pedagogu WHERE IdPedagog ='$p_id'";
							$select_p_id = mysqli_query($lidhje, $select_query);
							while($update = mysqli_fetch_assoc($select_p_id)){
								$p_id = $update['IdPedagog'];
								$email = $update['Email'];
								$titulli = $update['Titulli'];
					?>
					<input type="text" class="form-control" name="email" value="<?php if(isset($email))echo $email;?>">
					<input type="text" class="form-control" name="titulli" value="<?php if(isset($titulli))echo $titulli;?>">
					<?php } ?>

				</div>

				<div class="form-group">
					<input class="btn btn-primary" type="submit" name="update" value="Update Pedagog">
				</div>
			</form>
				<?php 
					if(isset($_POST['update'])){
						$email_p = $_POST['email'];
						$titulli_p = $_POST['titulli'];
						$query = "UPDATE pedagogu SET Email='$email_p', Titulli='$titulli_p' WHERE IdPedagog = '$p_id'";
						$update_query = mysqli_query($lidhje, $query);
						header("Location:editim_pedagog.php");
					}
					}
					
					mysqli_close($lidhje);
				?>
		</div>
    </div>
		
	<script>
		$(document).ready(function() {
			$('#pedagoget').DataTable();
		} );
	</script>

<p><form method="post" action="logout.php"><input type="submit" name="logout" value="Log out" id="logout" class="btn btn-primary"></form></p>

	<?php include("footer.php");?>

</body>
</html>