<?php
session_start();
require_once('conexiune_stabilita.php');
if(isset($_POST['Limba']))
    $Limba = $_POST['Limba'];
if(isset($_POST['Link_Descarcare']))
    $Link_Descarcare = $_POST['Link_Descarcare'];
if(isset($_POST['Nume']))
    $Nume = $_POST['Nume'];
	
$query_film = "SELECT ID_Film
				FROM Film
				WHERE Nume = '{$Nume}'";
$metoda_film= sqlsrv_query($conn,$query_film) or die(print_r(sqlsrv_errors(),true));	
$ID_Film = sqlsrv_fetch_object($metoda_film);

	echo "OK1";
	$query = "INSERT INTO Subtitrare(ID_Film, Limba, Link_Descarcare) VALUES('$ID_Film->ID_Film', '$Limba', '$Link_Descarcare')";
	echo "OK2";
	$metoda= sqlsrv_query($conn,$query) or die(print_r(sqlsrv_errors(),true));
	echo "OK3";
?>

<!DOCTYPE html>
<html>
<body style = "background-color:aquamarine;">
<br>Subtitrarea a fost adaugata.<br>
<br>Lista actualizata cu subtitrari<br>
</html>

<?php
$query_afis_sub ="SELECT F.Nume AS Nume, S.Limba AS Limba
					From Subtitrare S JOIN Film F ON S.ID_Film = F.ID_Film";
$met_query_afis_sub = sqlsrv_query($conn,$query_afis_sub) or die(print_r(sqlsrv_errors(),true));

while($afis = sqlsrv_fetch_object($met_query_afis_sub)){
	echo "Film:";
	echo $afis->Nume;
	echo " - ";
	echo $afis->Limba;
	echo "<br>";
}
?>

<html>
<p><a href= "add_sub.php">Doriti sa mai adaugati o subtitrare?</a></p>
<p><a href= "main.php">Inapoi la pagina principala.</a></p>
</html>
