<!DOCTYPE html>
<html>
<body style = "background-color:powderblue;">
<p>Lista de actori existenti:</p>
</html>

<?php

session_start();
require_once('conexiune_stabilita.php');


$query_afis_actor ="SELECT Nume
					From Actor";
$met_query_afis_actor = sqlsrv_query($conn,$query_afis_actor) or die(print_r(sqlsrv_errors(),true));

while($afis = sqlsrv_fetch_object($met_query_afis_actor)){
	echo $afis->Nume;
	echo "<br>";
}
?>

<html>
<form action="add_actor_succes.php" method = "post">
	<b>Completați câmpurile următoare:</b>
	<input type="text" name="Nume" id="Nume" placeholder="Numele actorului">
	<p>Data de nastere:</p>

	<input type="date" name="Data_Nastere" id="Data_Nastere">
	<p>Selectati filmele in care a jucat actorul</p>
</html>

<?php

$sql_film = "SELECT ID_Film, Nume
			FROM Film";
$count = 0;
$result_film = sqlsrv_query($conn,$sql_film) or die(print_r(sqlsrv_errors(),true));
while($data_film = sqlsrv_fetch_array($result_film)){
	$count = $count + 1;
	echo $count; ?>
	<input type = "checkbox" id = "checkbox<?php echo $count?>" name="checkbox<?php echo $count?>" value="<?php echo $data_film['ID_Film'] ?>"><?php echo $data_film['Nume'];?> &nbsp;
<?php
	$ID_Film = $data_film['ID_Film'];
	}
	
?>


<html>
	<p>Nu exista filmul in care a jucat actorul?</p>
	<a href="add_film.php"> Adăugați-l de aici</a>
	<input type="submit" value="Adăugați"> </p>
	<p> <a href="main.php">Inapoi</a>

</form>
</html>