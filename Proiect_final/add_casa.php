<!DOCTYPE html>
Casele de productie disponibile:
</html>
<?php
session_start();
require_once('conexiune_stabilita.php');

$query_afis_case ="SELECT Nume_Casa_Productie
					From Casa_Productie";
$met_query_afis_case = sqlsrv_query($conn,$query_afis_case) or die(print_r(sqlsrv_errors(),true));

while($afis = sqlsrv_fetch_object($met_query_afis_case)){
	echo $afis->Nume_Casa_Productie;
	echo "<br>";
}


if(isset($_POST['Nume_Casa_Productie']))
    $Nume_Casa_Productie = $_POST['Nume_Casa_Productie'];
if(isset($_POST['Locatie_Sediu']))
    $Locatie_Sediu = $_POST['Locatie_Sediu'];
if(isset($_POST['Data_Infiintare']))
    $Data_Infiintare = $_POST['Data_Infiintare'];
if(isset($_POST['Organizatie_Mama']))
    $Organizatie_Mama = $_POST['Organizatie_Mama'];

if(empty($_POST['Nume_Casa_Productie']) || empty($_POST['Locatie_Sediu']) || empty($_POST['Data_Infiintare']))
{
	echo "Nu s-au introdus datele inca inca!";
}
else
{
	echo "OK1";
	$query = "INSERT INTO Casa_Productie(Nume_Casa_Productie,Locatie_Sediu,Data_Infiintare,Organizatie_Mama) VALUES('$Nume_Casa_Productie', '$Locatie_Sediu', '$Data_Infiintare', '$Organizatie_Mama')";
	echo "OK2";
	$metoda= sqlsrv_query($conn,$query) or die(print_r(sqlsrv_errors(),true));
	echo "OK3";
	
}

?>


<html>
</p>
<body style = "background-color:powderblue;">
<form action="add_casa.php" method = "post">
	<b>Completați câmpurile următoare:</b>
	<input type="text" name="Nume_Casa_Productie" id="Nume_Casa_Productie" placeholder="Numele casei de productie>
	<input type="text" name="Locatie_Sediu" id="Locatie_Sediu" placeholder="Locatia sediului">
	<p>Data infiintarii:</p>
	<input type="date" name="Data_Infiintare" id="Data_Infiintare">
	<input type="text" name="Organizatie_Mama" id="Organizatie_Mama" placeholder="Organizatia mama">
	<input type="submit" value="Adăugați"> </p>
	<p> <a href="main.php">Inapoi</a>

</form>
</html>