<?php
session_start();
require_once('conexiune_stabilita.php');

$query="SELECT COUNT(*) as NrTotalFilm	FROM Film";
$rez=sqlsrv_query($conn, $query);
$row = sqlsrv_fetch_object($rez);
$NrTotalFilm =$row->NrTotalFilm;
	
	for ($i=1;$i<=$NrTotalFilm;$i++){
		if(isset($_POST['checkbox'.$i])){
			$select_film =$_POST['checkbox'.$i];
			echo " ";
			echo $select_film;
			echo " ";
			
		$query_delete_film_actor = "DELETE FROM FilmActor WHERE ID_Film = '{$select_film}'";
		$metoda2 = sqlsrv_query($conn,$query_delete_film_actor) or die(print_r(sqlsrv_errors(),true));
		echo "OK delete film actor";
		
		$query_delete_film_gen = "DELETE FROM FilmGen WHERE ID_Film = '{$select_film}'";
		$metoda4 = sqlsrv_query($conn,$query_delete_film_gen) or die(print_r(sqlsrv_errors(),true));
		echo "OK delete film gen";
		
		$query_delete_film ="DELETE FROM Film Where ID_Film = '{$select_film}'";
		$metoda3 = sqlsrv_query($conn,$query_delete_film) or die(print_r(sqlsrv_errors(),true));
		echo "OK delete film";
		
		
		}
	}

?>
<!DOCTYPE html>
<html>
<body style = "background-color:aquamarine;">
<p> Filmul/filmele au fost sters(e) cu succes. </p>
<p> <a href="delete_film.php"> Doriti sa stergeti alt film?</p></a>
<p> <a href= "main.php">Inapoi la pagina principala </p> </a>
</html>
