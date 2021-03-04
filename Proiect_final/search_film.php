<!DOCTYPE html>
<html>
	<p>Filme:</p>
</html>

<?php
session_start();
require_once('conexiune_stabilita.php');

$query_afis_film ="SELECT Nume
					From Film";
$met_query_afis_film = sqlsrv_query($conn,$query_afis_film) or die(print_r(sqlsrv_errors(),true));

while($afis = sqlsrv_fetch_object($met_query_afis_film)){
	echo $afis->Nume;
	echo "<br>";
}
echo "<br>";

if(!empty($_POST['Search_Film'])){
	$Search  = $_POST['Search_Film'];
	$Search1 = "%".$Search."%";

	$query_search_num = "SELECT F.Nume, C.Nume_Casa_Productie
						FROM Film F JOIN Casa_Productie C ON C.ID_Casa_Productie = F.ID_Casa_Productie
						WHERE Nume LIKE  '{$Search1}'";
	$met_query_search_num = sqlsrv_query($conn,$query_search_num) or die(print_r(sqlsrv_errors(),true));
	
	while($afis_srch_num = sqlsrv_fetch_object($met_query_search_num)){
		echo $afis_srch_num->Nume;
		echo " - Casa de productie: ";
		echo $afis_srch_num->Nume_Casa_Productie;
		echo "<br>";
	}
	
}
if(!empty($_POST['Search_Top_An'])){
	$Search_An = $_POST['Search_Top_An'];
	$query_search_an = "SELECT TOP 5 COUNT(X.Nume_Casa_Productie) AS Nr_Filme, X.Nume_Casa_Productie
						FROM (SELECT C.Nume_Casa_Productie, F.Nume
								FROM Film F JOIN Casa_Productie C ON C.ID_Casa_Productie = F.ID_Casa_Productie
								WHERE F.An_Aparitie = '{$Search_An}'
								GROUP BY C.Nume_Casa_Productie, F.Nume) AS X
								GROUP BY X.Nume_Casa_Productie
								ORDER BY COUNT (X.Nume_Casa_Productie) DESC";
	$met_query_search_an = sqlsrv_query($conn,$query_search_an) or die(print_r(sqlsrv_errors(),true));
	
	while($afis_srch_an = sqlsrv_fetch_object($met_query_search_an)){
		echo "Casa de productie: ";
		echo $afis_srch_an->Nume_Casa_Productie;
		echo" - ";
		echo $afis_srch_an->Nr_Filme;
		echo" - ";
		echo $Search_An;
		echo "<br>";
	}
}
?>

<html>
<body style = "background-color:peachpuff;">
<form action = "search_film.php" method = "post">
<p> Introduceti filmul pe care doriti sa il cautati</p>
	<input type = "text" name = "Search_Film">
<p> Vizualizati top 5 al caselor de productie cu cele mai multe filme scoase in anul dorit</p>
	<input type = "text" name ="Search_Top_An">
	<input type = "submit" value = "Cautati">
	
</form>
<br>


<p> <a href="main.php">Inapoi</a> </p>
</html>


