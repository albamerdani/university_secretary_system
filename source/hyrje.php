<?php
include("lidhje_databaze.php");
session_start();
?>
<!DOCTYPE html>
<html>

<head>
<title>Sekretaria Shkolles</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- jQuery library-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<script type="text/javascript" src="validime.js"></script>

<link type="text/css" rel="stylesheet" href="style/hyrje.css"> 

</head>

<body>

<div id="header">
<link rel="stylesheet" type="text/css" href="style/header.css">
<h1>Miresevini ne portalin e sekretarise mesimore</h1><img src="images/logo.jpg" id="logo">

	<div id = "cover">
		<img class="slide" src="images/upt.jpg">
		<img class = "slide" src="images/fti.jpg">
		<img class = "slide" src="images/fie.jpg">
		<button  class="btn" id = "prev" onclick = "plusIndex(-1)">&#10094;</button>
		<button class="btn" id = "next" onclick = "plusIndex(1)">&#10095;</button>
	</div>
	
<script type="text/javascript">

	var slideIndex = 1;
	showSlides(slideIndex);

		
	function plusIndex(n){  
		showSlides(slideIndex +=n);

	}

	function showSlides(n) {
		var i;
		var slide = document.getElementsByClassName("slide");
		
		if (n > slide.length) {slideIndex = 1};
		if (n < 1) {slideIndex = slide.length};	
		for (i = 0; i < slide.length; i++)
		{
		   slide[i].style.display = "none";  
		}
		
		slide[slideIndex-1].style.display = "block";
		setInterval(showSlides,2000);
	}
</script>
</div>

	<?//php include("faqe.php");?>

<input type="button" value="Login" id="log_in" name="login" data-toggle="modal" data-target="#loginModal"/>
<a href="#" id="reset_pass" data-toggle="modal" data-target="#reset_passwordModal" ><button id="reset">Reset password</button></a>


<!-- Modal per tu loguar -->	
	<div class="modal fade" id="loginModal" role="dialog">
		<div class="modal-dialog">
		  
			<div class="modal-content">
			
				<div class="modal-header" style = "background:lightblue">
					<button type="button" class="close" data-dismiss="modal" style="color:navy">&times;</button>
					<h2 class="modal-title" class="modal_style">Log in</h2>
				</div>
				
				<form method="POST" action="login_user.php">
				<div class="modal-body" style="background:black; color:white; font-style:bold;">
					<table id="log">
						<tr>
							<td>Lloji</td>
							<td><select name="lloji" id="lloji" style="color:black;">
							<option value=""></option>
							<option value="Student">Student</option>
							<option value="Pedagog">Pedagog</option>
							<option value="Sekretari">Sekretaria</option>
							<option value="Admin">Administratori</option>
							</select></td>
							</tr>
						<tr>
							<td>Username</td>
							<td><input type="text" name="username" id="username" size="20" style="color:black;" required/></td>
						</tr>
						<tr>
							<td>Password</td>
							<td><input type="password" name="password" id="password" size="20" style="color:black;" required /> <input type="checkbox" name="check" id="check" onclick="show_password();"> Show Password</td></td>
						</tr>
						<tr>
							<td>Remember me</td>
							<td><input type="checkbox" name="remember" id="remember"/></td>
						</tr>
						<tr>
							<td><a href="" data-toggle="modal" data-target="#reset_passwordModal" id="link">Reset password</a></td>
							<td></td>
						</tr>
					</table>
				</div>
				<div class="modal-footer" style="background:navy">
					<input type="submit" name="login_user" id="login_user" value="Log in" class="btn btn-success"/>
					<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
				</div>
				</form>
			</div>
		</div>
	</div>
	
	<?php
		include("login_user.php");
	?>
	
	
	<!-- Modal per te resetuar passwordin duke futur adresen e emailit-->
	<div class="modal fade" id="reset_passwordModal" role="dialog">
		<div class="modal-dialog">
		  <!-- Modal content-->
			<div class="modal-content">
			
				<div class="modal-header" style="background:lightblue">
					<button type="button" class="close" data-dismiss="modal" style="color:navy">&times;</button>
					<h2 class="modal-title" class="modal_style">Enter your email to reset password</h2>
				</div>
				
				<form method="POST" action="" id="reset">
				<div class="modal-body" style = "background:black; color:white; font-style:bold;">
					<p>User Email <i class="material-icons" style="color:white">mail_outline</i></p>
					<input type="email" name="email" id="user_email" size="30" class="form-control" required/>
				</div>
				
				<div class="modal-footer" style="background:navy">
					<input type="submit" name="submit" id="submit" value="Submit" class="btn btn-success"/>
					<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
				</div>
				</form>
				
				<?php 
			

					if(isset($_POST['submit'])){
	
						$to = $_POST['email'];
						$header = $_POST['email'];
						email_reset_password($to, $header);		//funksion qe e ridrejton nje user te faqja per te ndryshuar password-in
					}
					
				
					function email_reset_password($to, $header){		//funksion qe realizon dergimin e nje emaili per te ndryshuar password-in, merr dy parametra qe do jene te tipit email
						global $lidhje;
						$subject = "Reset password";
						$msg="Click here to confirm your email and to reset your password. <a href='localhost/Projekt - Sekretaria/reset_password.php'>header('Location: localhost/Projekt - Sekretaria/reset_password.php')</a>";
						mail($to, $subject, $msg, $header);				//funksioni ne PHP qe realizon dergimin e email-it dhe ridrejton userin te faqja ku do ndryshoje password-in.
					}
				?>
				
			</div>
		</div>
	</div>
	
<p>
	<?php include("footer.php");?>
	</p>
</body>
</html>