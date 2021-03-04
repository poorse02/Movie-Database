<?php
session_start();
require_once('conexiune_stabilita.php');

$Mail = $_SESSION['Mail'];

?>


<!DOCTYPE html>
<html>
<div align=center>
<p><b>Bine ai venit,
</html>


<?php
	
	echo $_SESSION['Nume'];
?>
<html>
!Acestea sunt filmele disponibile pentru recenziat:<br></b>
<br>
</html>
<?php
	$query_afis_filme ="SELECT Nume
					From Film";
	$met_query_afis_filme = sqlsrv_query($conn,$query_afis_filme) or die(print_r(sqlsrv_errors(),true));

	while($afis = sqlsrv_fetch_object($met_query_afis_filme)){
	echo $afis->Nume;
	echo "<br>";
	
	}

	if($met_query_afis_filme == NULL)
		echo "Nu există filme de recenziat momentan";
	
	
?>

<!DOCTYPE html>
<html>
<body style = "background-color:peachpuff;">
<p>Nu exista filmul cautat? <a href="add_film.php">Adauga un film</a> </p>
<p><a href = "search_film.php">Sau cauta-l aici </a> </p>
<p> <a href="add_recenzie.php">Adaugă o recenzie.</a> </p>
<p> <a href="add_gen.php">Adaugă un gen.</a> </p>
<p> <a href="add_casa.php">Adaugă o casa de productie.</a> </p>
<p> <a href="add_actor.php">Adaugă un actor.</a> </p>
<p> <a href="add_sub.php">Adauga subtitrare.</a> </p>
<p> </p>
<br>
<p> <a href="stats.php">Vizualizeaza statistici.</a> </p>
<p> <a href="fun.php">Vizualizeaza fun facts despre useri.</a> </p>
<p>Operatii de stergere:</p>
<p><a href="delete_actor.php"> >Sterge unul sau mai multi actori</a> </p>
<p><a href="delete_film.php">  >Sterge unul sau mai multe filme</a> </p>
</html>
<p>Operatii de actualizare:</p>
<p><a href="update_casa.php"> >Actualizeaza numele si/sau sediul unei case de productie</a> </p>
<p><a href="update_sub.php"> >Actualizeaza linkul de descarcare al unei subtitrari</a> </p>
</body>
<p> <a href="log_out.php">Log out</a> </p>
</div>
</html>