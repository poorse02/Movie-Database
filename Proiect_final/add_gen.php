<?php
session_start();
require_once('conexiune_stabilita.php');

if(isset($_POST['Nume']))
	$Nume = $_POST['Nume'];
if(isset($_POST['Descriere']))
	$Descriere = $_POST['Descriere'];
	
	
if(empty($_POST['Nume']) || empty($_POST['Descriere']) )
	{
		echo "Nu s-a introdus un gen inca!";
	}
	else
	{
		$query = "INSERT INTO Gen(Nume,Descriere) VALUES('$Nume', '$Descriere')";
		$insert_gen= sqlsrv_query($conn,$query) or die(print_r(sqlsrv_errors(),true));
		echo "A fost introdus genul.";
	}
?>


<!DOCTYPE html>
<html>
<body style = "background-color:powderblue;">
<form action="add_gen.php" method = "post">

	<b>Pentru adaugare gen, completati campurile urmatoare:</b>
	<input type="text" name="Nume" id="Nume" placeholder="Numele genului">
	<input type="text" name="Descriere" id="Descriere" placeholder="Scurta descriere a genului">
	<input type="submit" value="Adauga"> </p>
	<p> <a href="main.php">Inapoi</a> </p>
</form>
</html>