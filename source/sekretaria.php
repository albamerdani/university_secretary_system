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
<title>Home</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

<link type="text/css" rel="stylesheet" href="style/sekretaria.css">

</head>

<body>
<header>Sekretaria - Universiteti Politeknik i Tiranes</header>
<div id="menu">
<nav>Menu
<ul>
<li><a href="regjistrim_student.php">Regjistro student</a></li>
<li><a href="regjistrim_pedagog.php">Regjistro Pedagog</a></li>
<li><a href="editim_student.php">Edito te dhenat e studentit</a></li>
<li><a href="editim_pedagog.php">Edito te dhenat e pedagogut</a></li>
<li><a href="shto_dep.php">Shto Departament</a></li>
<li><a href="shto_lende.php">Shto lende</a><span class="glyphicon glyphicon-book"></span></li>
<li><a href="viti_grupi.php">Shto Vitin Akademik dhe Grupet mesimore</a></li>
<li><a href="koke_provimi.php">Krijo koke provimi</a></li>

</ul>
</nav>
</div>

<div id="postime" class="div">
<form method="POST" action="">
<p><b>Vendos njoftime per studentet</b><span class="glyphicon glyphicon-notes-2"></span></p>
<p><textarea row="500" col="1000" name="njoftime" id="njoftime"></textarea></p>
<p><input type="submit" name="posto" id="posto" value="Posto" class="btn btn-success"/></p>
</form>
<?php
if(isset($_POST['posto']))
{
	$njoftime = $_POST['njoftime'];
	$file = fopen("njoftime.txt", "a+");
	fwrite($file, $njoftime);
	fclose($file);
	
}
mysqli_close($lidhje);
?>


<form method="post" action="logout.php"><input type="submit" name="logout" value="Log out" id="logout" class="btn btn-info"></form>

</div>

	<?php include("footer.php");?>

</body>
</html>