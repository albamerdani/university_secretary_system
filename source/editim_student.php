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

<style type="text/css">
p					{font-size:16pt; font-style:bold; font-family:arial,sanserif; color:black;}
.buton				{background-color:royalblue; width:12em; heigth:3em; text-align:center; color:white}
div					{left:5%; top:10%;}
</style>
</head>
<body>
<p><a href="sekretaria.php">Home <span class="glyphicon glyphicon-home"></span></a></p>
<p><b>Edito te dhenat e studentit</b></p>

			<table id="studentet" class="table table-hover table-striped" border="2">
				<thead>
					<tr class="table info">
					<th>Student ID</th>
					<th>Emer Mbiemer</th>
					<th>Gjinia</th>
					<th>Ditelindja</th>
					<th>Email</th>
					<th>Nr Tel</th>
					<th>Vendlindja</th>
					<th>Grupi Mesimor</th>
					<th>Edit</th>

					</tr>
				</thead>
					
				<tbody>
					<?php
						$select = "SELECT * FROM student";
						$select_std = mysqli_query($lidhje, $select);
						
						while($row = mysqli_fetch_array($select_std)){
							$std_id = $row['IdStudent'];
							$emri = $row['Emer Mbiemer'];
							$gj = $row['Gjinia'];
							$dit = $row['Ditelindja'];
							$email = $row['Email'];
							$nr = $row['NrTel'];
							$vend = $row['Vendlindja'];
							$gr = $row['IdGM'];
							
							$query = "SELECT * FROM grup_m WHERE IdGM = '$gr'";
							$select_gr = mysqli_query($lidhje, $query);
							$grupi = mysqli_fetch_array($select_gr);
							
							echo "<tr><td>$std_id</td>";
							echo "<td>$emri</td>";
							echo "<td>$gj</td>";
							echo "<td>$dit</td>";
							echo "<td>$email</td>";
							echo "<td>$nr</td>";
							echo "<td>$vend</td>";
							echo "<td>".$grupi['Emertimi']."</td>";
							echo "<td><a href='editim_student.php?edit=$std_id'>Edit</a></td></tr>";
						}
					?>
				</tbody>
			</table>
			
		<div class="col-xs-6">
			<form action="" method="post">
				<div class="form-group">
					<?php 		
						if(isset($_GET['edit'])){
							$std_id = $_GET['edit'];
						
							$select_query = "SELECT * FROM student WHERE IdStudent ='$std_id'";
							$select_std_id = mysqli_query($lidhje, $select_query);
							while($edit = mysqli_fetch_assoc($select_std_id)){
								$std_id = $edit['IdStudent'];
								$email = $edit['Email'];
								$nr = $edit['NrTel'];
								$gr = $edit['IdGM'];
					?>
					<input type="text" class="form-control" name="email" value="<?php if(isset($email))echo $email;?>">
					<input type="text" class="form-control" name="nrtel" value="<?php if(isset($nr))echo $nr;?>">
					<input type="text" class="form-control" name="grupi" value="<?php if(isset($gr))echo $gr;?>">
					<?php } ?>

				</div>

				<div class="form-group">
					<input class="btn btn-primary" type="submit" name="update" value="Update Student">
				</div>
			</form>
				<?php 
					if(isset($_POST['update'])){
						$email_update = $_POST['email'];
						$nr_update = $_POST['nrtel'];
						$gr_update = $_POST['grupi'];
						$query_update = "UPDATE student SET Email='$email_update', NrTel='$nr_update', IdGM='$gr_update' WHERE IdStudent='$std_id'";
						$update_query = mysqli_query($lidhje, $query_update);
						header("Location:editim_student.php");
					}
					}
					
					mysqli_close($lidhje);
				?>
		</div>
    </div>
	
	<script>
		$(document).ready(function() {
			$('#studentet').DataTable();
		} );
	</script>

<p><form method="post" action="logout.php"><input type="submit" name="logout" value="Log out" id="logout" class="btn btn-primary"></form></p>

	
	<?php include("footer.php");?>
</body>
</html>