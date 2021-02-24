<?php
include("lidhje_databaze.php");
global $lidhje;
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

<link type="text/css" rel="stylesheet" href="style/profil_student.css">
</head>

<body>

<p style="font-size:18pt; color:black"><b>Te dhenat e mia</b></p>

<div class="div">
<p>Emri Mbiemri: 
<?php
$id_s = mysqli_query($lidhje, "SELECT 'Id_S_P' FROM user WHERE Username = '$username_session' AND Password = '$password_session' AND IdUser = '$id_session'");
$id_std= mysqli_fetch_assoc($id_s);
$id = $id_std['Id_S_P'];
$emri = mysqli_query($lidhje, "SELECT 'Emer Mbiemer' FROM student WHERE IdStudent = '$id'");
$em = mysqli_fetch_assoc($emri);
echo $em['Emer Mbiemer'];
?></p>

<p>Gjinia: 
<?php
$id_s = mysqli_query($lidhje, "SELECT Id_S_P FROM user WHERE Username = '$username_session' AND Password = '$password_session' AND IdUser = '$id_session'");
$id_std= mysqli_fetch_assoc($id_s);
$id = $id['Id_S_P'];
$gjinia = mysqli_query($lidhje, "SELECT 'Gjinia' FROM student WHERE IdStudent = '$id'");
$gj = mysqli_fetch_assoc($gjinia);
echo $gj['Gjinia'];
?></p>

<p>Ditelindja: 
<?php
$id_s = mysqli_query($lidhje, "SELECT Id_S_P FROM user WHERE Username = '$username_session' AND Password = '$password_session' AND IdUser = '$id_session'");
$id_std= mysqli_fetch_assoc($id_s);
$id = $id['Id_S_P'];
$ditelindja = mysqli_query($lidhje, "SELECT 'Ditelindja' FROM student WHERE IdStudent = '$id'");
$dite = mysqli_fetch_assoc($ditelindja);
echo $dite['Ditelindja'];
?></p>

<p>Vendlindja: 
<?php
$id_s = mysqli_query($lidhje, "SELECT Id_S_P FROM user WHERE Username = '$username_session' AND Password = '$password_session' AND IdUser = '$id_session'");
$id_std= mysqli_fetch_assoc($id_s);
$id = $id['Id_S_P'];
$adresa = mysqli_query($lidhje, "SELECT 'Vendlindja' FROM student WHERE IdStudent = '$id'");
$adr = mysqli_fetch_assoc($adresa);
echo $adr['Vendlindja'];
?></p>

<p>Grupi Mesimor: 
<?php
$id_s = mysqli_query($lidhje, "SELECT Id_S_P FROM user WHERE Username = '$username_session' AND Password = '$password_session' AND IdUser = '$id_session'");
$id_std= mysqli_fetch_assoc($id_s);
$id = $id['Id_S_P'];
$gm = mysqli_query($lidhje, "SELECT 'IdGM' FROM student WHERE IdStudent = '$id'");
$grup = mysqli_fetch_assoc($gm);
$dega = $grup['IdGM'];
$query_grup = mysqli_query($lidhje, "SELECT 'Emertimi' FROM grup_m WHERE IdGM='$dega'");
$grupi = mysqli_fetch_assoc($query_grup);
echo $grupi['Emertimi'];

echo "</p>";
echo "<p>Viti Akademik: ";

$viti = mysqli_query($lidhje, "SELECT 'Id_VA' FROM grup_m WHERE IdGM='$grupi'");
$v = mysqli_fetch_assoc($viti);
$vit = $v['Id_VA'];
$va_query = mysqli_query($lidhje, "SELECT 'Viti_Akademik' FROM viti_akademik WHERE Id_VA='$vit'");
$va = mysqli_fetch_assoc($va_query);
echo $va['Viti_Akademik'];
?>
</p>

<?php
mysqli_close($lidhje);
?>
</div>

<div class="menu">
<nav>Menu
<ul>
<li><a href="lista_lendeve.php">Shiko listen e lendeve</a></li>
<li><a href="shiko_vleresimet.php">Shiko vleresimet e provimeve</a></li>
<li><a href="shiko_njoftimet.php">Shiko njoftimet e sekretarise</a></li>
<li><a href="reset_password.php">Ndrysho password</a></li>
</ul>
</nav>
</div>
<form method="post" action="logout.php"><input type="submit" name="logout" value="Log out" id="logout" class="btn btn-primary"></form>
<?php include("footer.php");?>
</body>
</html>