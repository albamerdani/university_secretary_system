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
	//header("Location:hyrje.php");
}

?>

<!DOCTYPE html>
<html>
<head>
<title>Home</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<link type="text/css" rel="stylesheet" href="style/profil_pedagog.css"> 
</head>
<body>
<p style="color:black"><b>Te dhenat e mia</b></p>

<p>Emri Mbiemri: 
<?php
$id_p = mysqli_query($lidhje, "SELECT 'Id_S_P' FROM user WHERE Username = '$username_session' AND Password = '$password_session' AND IdUser = '$id_session'");
$id_u = mysqli_fetch_assoc($id_p);
$id = $id_u['Id_S_P'];
$emri = mysqli_query($lidhje, "SELECT 'Emer Mbiemer' FROM pedagogu WHERE IdPedagog = '$id'");
$em = mysqli_fetch_assoc($emri);
echo $em['Emer Mbiemer'];
?></p>

<p>Titulli: 
<?php
$id_p = mysqli_query($lidhje, "SELECT 'Id_S_P' FROM user WHERE Username = '$username_session' AND Password = '$password_session' AND IdUser = '$id_session'");
$id_u = mysqli_fetch_assoc($id_p);
$id = $id_u['Id_S_P'];
$emri =mysqli_query($lidhje, "SELECT 'Titulli' FROM pedagogu WHERE IdPedagog = '$id'");
$em = mysqli_fetch_assoc($emri);

echo $em['Titulli'];
?></p>


<p>Email: 
<?php
$id_p = mysqli_query($lidhje, "SELECT 'Id_S_P' FROM user WHERE Username = '$username_session' AND Password = '$password_session' AND IdUser = '$id_session'");
$id_u = mysqli_fetch_assoc($id_p);
$id = $id_u['Id_S_P'];
$emri = mysqli_query($lidhje, "SELECT 'Email' FROM pedagogu WHERE IdPedagog = '$id'");
$em = mysqli_fetch_assoc($emri);
echo $em['Email'];
?></p>

<div id="menu">
<nav>Menu
<ul>
<li><a href="vendos_detyrimet.php">Vendos detyrimet akademike per studentet</a></li>
<li><a href="hidh_nota.php">Vendos vleresimet per studentet</a></li>
<li><a href="reset_password.php">Ndrysho password</a></li>
</ul>
</nav>
</div>


<form method="post" action="logout.php"><input type="submit" name="logout" value="Log out" id="logout" class="btn btn-primary"></form>

	<?php include("footer.php");?>

</body>
</html>