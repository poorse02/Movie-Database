<?php
session_start();
require_once('conexiune_stabilita.php');
echo $_SESSION['Mail'];
$Mail = $_SESSION['Mail'];
echo $Mail;
	

	$query_afis_filme ="SELECT Nume
					From Film";
$met_query_afis_filme = sqlsrv_query($conn,$query_afis_filme) or die(print_r(sqlsrv_errors(),true));

while($afis = sqlsrv_fetch_object($met_query_afis_filme)){
	echo $afis->Nume;
	echo "<br>";
	
}
	
	
?>


<!DOCTYPE html>
<html>
<p>Bine ai venit,
</html>


<?php
	
	/*$bun_venit_q = "SELECT Nume	
					FROM User_site
					WHERE Mail ='{$Mail}'";
	$bun_venit_exec = sqlsrv_query($conn,$bun_venit_q) or die(print_r(sqlsrv_errors(),true));
	$row2 = sqlsrv_fetch_array($bun_venit_exec);
	echo row2->Nume;*/
	echo $_SESSION['Nume'];
?>


<html>
! Acestea sunt filmele disponibile pentru recenziat</p>
</html>

<?php
	if($met_query_afis_filme == NULL)
		echo "Nu există filme de recenziat momentan";
	
	
?>

<!DOCTYPE html>
<html>
<p>Nu exista filmul cautat? <a href="add_film.php">Adauga un film</a> </p>
<p><a href = "search_film.php">Sau cauta-l aici </a> </p>
<p> <a href="add_recenzie.php">Adaugă o recenzie.</a> </p>
<p> <a href="add_gen.php">Adaugă un gen.</a> </p>
<p> <a href="add_casa.php">Adaugă o casa de productie.</a> </p>
<p> <a href="add_actor.php">Adaugă un actor.</a> </p>
<p> <a href="add_sub.php">Adauga subtitrare.</a> </p>
<p> </p>
<p>Operatii de stergere:</p>
<p><a href="delete_actor.php"> >Sterge unul sau mai multi actori</a> </p>
<p><a href="delete_film.php">  >Sterge unul sau mai multe filme</a> </p>
</html>
<p>Operatii de actualizare:</p>
<p><a href="update_casa.php"> >Actualizeaza numele si/sau sediul unei case de productie</a> </p>
<p><a href="update_sub.php"> >Actualizeaza linkul de descarcare al unei subtitrari</a> </p>

<html>
<p> <a href="log_out.php">Log out</a> </p>
</html>