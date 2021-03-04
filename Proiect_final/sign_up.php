<?php
session_start();
require_once('conexiune_stabilita.php');

if(isset($_POST['Nume']))
    $Nume = $_POST['Nume'];
if(isset($_POST['Parola']))
    $Parola = $_POST['Parola'];
if(isset($_POST['Mail']))
    $Mail = $_POST['Mail'];

if(empty($_POST['Nume']) || empty($_POST['Parola']) || empty($_POST['Mail']))
{
	echo "Nu s-au introdus credentialele inca!";
}
else
{
	$query = "INSERT INTO User_site(Nume, Parola, Mail) VALUES('$Nume', '$Parola', '$Mail')";
	$metoda= sqlsrv_query($conn,$query) or die(print_r(sqlsrv_errors(),true));
}

?>


<!DOCTYPE html>
<html>
<body style = "background-color:powderblue;">
<form action="sign_up.php" method = "post">
<p> <img src="sign_up.png" alt="sign_up" width = 200px height = 100px> 
</p>
	<b>Pentru inregistrare, completati campurile urmatoare:</b>
	<p>Nume:</p>
	<input type="text" name="Nume" id="Nume">
	<p>Parola:</p>
	<input type="text" name="Parola" id="Parola">
	<p>Mail:</p>
	<input type="text" name="Mail" id="Mail">
	<p>
	<input type="submit" value="Trimite"> </p>
	<p>Sau daca aveti deja un cont, <a href="log_in.php">logati-va</a> </p>
	
	
</form>
</body>
</html>