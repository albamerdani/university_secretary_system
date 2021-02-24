<?php		//Fshihen te dhenat ne SESSION te asaj faqeje kur shtypet butoni Log out dhe ridrejtohesh ne hyrje
if(isset($_POST['logout'])){
	session_start();
	$_SESSION['usr_session'] = "";
	$_SESSION['psw_session'] = "";
	$_SESSION['id_session'] = "";
	session_destroy();
	header("Location:hyrje.php");
}

?>