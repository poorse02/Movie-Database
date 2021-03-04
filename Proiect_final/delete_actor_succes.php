<?php
session_start();
require_once('conexiune_stabilita.php');

$query="SELECT COUNT(*) as NrTotalActor	FROM Actor";
$rez=sqlsrv_query($conn, $query);
$row = sqlsrv_fetch_object($rez);
$NrTotalActor =$row->NrTotalActor;
	
	for ($i=1;$i<=$NrTotalActor;$i++){
		if(isset($_POST['checkbox'.$i])){
			$select_actor =$_POST['checkbox'.$i];
			echo " ";
			echo $select_actor;
			echo " ";
			
		$query_delete_film_actor = "DELETE FROM FilmActor WHERE ID_Actor = '{$select_actor}'";
		$metoda2 = sqlsrv_query($conn,$query_delete_film_actor) or die(print_r(sqlsrv_errors(),true));
		echo "OK delete film actor";
		
		$query_delete_actor ="DELETE FROM Actor Where ID_Actor = '{$select_actor}'";
		$metoda3 = sqlsrv_query($conn,$query_delete_actor) or die(print_r(sqlsrv_errors(),true));
		echo "OK delete film";
		
		
		}
	}

?>
<!DOCTYPE html>
<html>
<body style = "background-color:aquamarine;">
<p> Actorul/actorii a/au fost sters(i) cu succes. </p>
<p> <a href="delete_actor.php"> Doriti sa stergeti alt actor?</p></a>
<p> <a href= "main.php">Inapoi la pagina principala </p> </a>
</html>
