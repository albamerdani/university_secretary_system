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
<title>Njoftimet</title>
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

<p><a href="student.php">Home <span class="glyphicon glyphicon-home"></span></a></p>
<p><b>Njoftimet e sekretarise</b></p>
<div>
<?php
$f = fopen("njoftime.txt","r");
$postime = fread($f, filesize("njoftime.txt"));
echo "<p id='postim'>".$postime."</p></br>";
fclose($f);
mysqli_close($lidhje);
?>
</div>
<p><form method="post" action="logout.php"><input type="submit" name="logout" value="Log out" id="logout" class="btn btn-primary"></form></p>
	<?php include("footer.php");?>
</body>
</html>