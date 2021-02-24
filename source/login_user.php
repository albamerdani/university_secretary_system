<?php //Kushtet e Log in te instruktorit
include("lidhje_databaze.php");
global $lidhje;

if(isset($_POST['login_user']))
{
	$lloji = $_POST['lloji'];
	$user = $_POST['username'];
	$pass = $_POST['password'];

	$username = mysqli_real_escape_string($lidhje, $user);
	$password = mysqli_real_escape_string($lidhje, $pass);
	
	$password = crypt($password, "$1995mysecretpassword");
	
	$login = mysqli_query($lidhje, "SELECT * FROM user WHERE Lloji='$lloji' AND Username='$username' AND Password='$password' LIMIT 1");
	
	if($login)
	{
		$row = mysqli_fetch_assoc($login);
		
			$vlera_lloji = $row['Lloji'];
			$vlera_user = $row['Username'];
			$vlera_pass = $row['Password'];
			$vlera_id = $row['IdUser'];
		
		if(($vlera_user == $username) && ($vlera_pass == $password) && ($vlera_lloji == $lloji))
		{	
	
			//Ruaj ne SESSION vlerat e username, password, id te pedagogut qe ekziston si regjistrim dhe logohet 
			//per ti perdorur si kritere ne kushtet e funksionaliteteve te tjera, fshihen te dhenat nga SESSION kur shtypet butoni Log out
			
			$_SESSION['usr_session'] = $vlera_user;
			$_SESSION['psw_session'] = $vlera_pass;
			$_SESSION['id_session'] = $vlera_id;
			
			if($vlera_lloji == "Pedagog")
			{
				header("Location:pedagog.php");
			}
			else if($vlera_lloji == "Student")
			{
				header("Location:student.php");
			}
			else if($vlera_lloji == "Sekretari")
			{
				header("Location:sekretaria.php");
			}
			else if($vlera_lloji == "Admin")
			{
				header("Location:admin.php");
			}
			else{
				header("Location:hyrje.php");
			}
			
			if(isset($_POST['remember'])){
				$_COOKIE['user'] = $username;
				$_COOKIE['pass'] = $password;
				$_COOKIE['user_id'] = $vlera_id;
				setcookie("user_id","$vlera_id",time()+(60*60*24));		//Ruhen te dhenat id, username, pasword, roli ne cookie per 1 dite = 24 ore me pas fshihen.
			}
			
		}
		
		else
		{
			echo "Keni futur username ose password gabim!";
			header("Location:hyrje.php");
		}
	}
	else
	{
		echo "Ju nuk jeni i regjistruar.";
	}
}
mysqli_close($lidhje);
?>