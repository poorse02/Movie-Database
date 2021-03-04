<?php
session_start();
require_once('conexiune_stabilita.php');


if(isset($_POST['Nume']))
    $Nume = $_POST['Nume'];
if(isset($_POST['Data_Nastere']))
    $Data_Nastere = $_POST['Data_Nastere'];
if(isset($_POST['Film']))
    $Data_Nastere = $_POST['Data_Nastere'];
	
	$query_actor = "SELECT ID_Actor
				FROM Actor
				WHERE Nume = '{$Nume}'";
	$met_actor =sqlsrv_query($conn, $query_actor);
	$ID_Actor = sqlsrv_fetch_object($met_actor);
	echo $ID_Actor->ID_Actor;
	
	
	$query="SELECT COUNT(*) as NrTotalFilm FROM Film";
	$rez=sqlsrv_query($conn, $query);
	$row = sqlsrv_fetch_object($rez);
	$NrTotalFilm =$row->NrTotalFilm;
	
	for ($i=1;$i<=$NrTotalFilm;$i++){
		if(isset($_POST['checkbox'.$i])){
			$select_film =$_POST['checkbox'.$i];
			echo " ";
			echo $select_film;
			echo " ";
		$query_insert__film_actor = "INSERT INTO FilmActor(ID_Film,ID_Actor) VALUES('$select_film','$ID_Actor->ID_Actor')";
			
		$metoda2 = sqlsrv_query($conn,$query_insert__film_actor) or die(print_r(sqlsrv_errors(),true));
		echo "A fost adaugat actorul ";
		echo $Nume;
		echo" la filmul ";
		$query_find_film = "SELECT Nume
							FROM Film
							WHERE ID_Film = '{$select_film}'";
		$met_find_film = sqlsrv_query($conn,$query_find_film) or die(print_r(sqlsrv_errors(),true));
		$get_film = sqlsrv_fetch_object($met_find_film);
		echo $get_film->Nume;
		}
	}
	
	

?>
<!DOCTYPE html>
<html>
<body style = "background-color:aquamarine;">
<p> Actorul a fost adaugat cu succes. </p>
<p> Lista actualizata cu actori:</p>
</html>

<?php
$query_afis_actor ="SELECT Nume
					From Actor";
$met_query_afis_actor = sqlsrv_query($conn,$query_afis_actor) or die(print_r(sqlsrv_errors(),true));

while($afis = sqlsrv_fetch_object($met_query_afis_actor)){
	echo $afis->Nume;
	echo "<br>";
}
?>

<html>
<p> <a href="add_actor.php"> Doriti sa adaugati alt actor?</p></a>
<p> <a href= "main.php">Inapoi la pagina principala </p> </a>
</html>
