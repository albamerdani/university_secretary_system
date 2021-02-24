<?php

$lidhje = mysqli_connect('localhost', 'root', '');
if(!$lidhje)
	die("<p>Nuk u lidh dot me databazen");
if(!mysqli_select_db($lidhje, "sekretaria"))
	die("Databaza nuk mund te aksesohet</p>");
?>
