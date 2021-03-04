<?php
session_start();
require_once('conexiune_stabilita.php');


if(isset($_POST['Nume']))
    $Nume = $_POST['Nume'];
if(isset($_POST['An_Aparitie']))
    $An_Aparitie = $_POST['An_Aparitie'];
if(isset($_POST['Nume_Casa_Productie']))
    $Nume_Casa_Productie = $_POST['Nume_Casa_Productie'];



$query_casa = "SELECT ID_Casa_Productie
				FROM Casa_Productie
				WHERE Nume_Casa_Productie = '{$Nume_Casa_Productie}'";
$metoda_casa= sqlsrv_query($conn,$query_casa) or die(print_r(sqlsrv_errors(),true));	
$ID_Casa_Productie = sqlsrv_fetch_object($metoda_casa);


if(empty($_POST['Nume']) || empty($_POST['An_Aparitie']))
{
	echo "Nu s-au introdus datele inca inca!";
}
else
{
	$query = "INSERT INTO Film(Nume, An_Aparitie,ID_Casa_Productie) VALUES('$Nume', '$An_Aparitie','$ID_Casa_Productie->ID_Casa_Productie')";
	$metoda= sqlsrv_query($conn,$query) or die(print_r(sqlsrv_errors(),true));
}



if(isset($_POST['Nume']) && isset($_POST['An_Aparitie'])){
	$Name = $_POST['Nume'];
	$An= $_POST['An_Aparitie'];
	
	$query_sel_id = "SELECT ID_Film
					FROM Film
					WHERE YEAR(An_Aparitie) = '{$An}' AND Nume = '{$Name}'";
	$met = sqlsrv_query($conn, $query_sel_id);
	$ID_Film = sqlsrv_fetch_object($met);
}


$query="SELECT COUNT(*) as NrTotalGenuri FROM Gen";
	$rez=sqlsrv_query($conn, $query);
	$row = sqlsrv_fetch_object($rez);
	$NrTotalGenuri =$row->NrTotalGenuri; 
	
	
	for ($i=1;$i<=$NrTotalGenuri;$i++){
	
		if(isset($_POST['checkbox'.$i])){
			$select_gen =$_POST['checkbox'.$i];
			echo " ";
			echo " ";
		
		$query_insert_film_gen = "INSERT INTO FilmGen(ID_Film,ID_Gen) VALUES('$ID_Film->ID_Film','$select_gen')";
			
		$metoda2 = sqlsrv_query($conn,$query_insert_film_gen) or die(print_r(sqlsrv_errors(),true));
		}
	}
	
?>

<!DOCTYPE html>
<html>
<body style = "background-color:aquamarine;">
<p>Felicitari! Filmul a fost adaugat cu succes.</p>


<p> <a href="add_film.php"> Doriti sa adaugati alt film?</a> </p>
<p> <a href="main.php">Inapoi la pagina principala</a> </p>
</html>
