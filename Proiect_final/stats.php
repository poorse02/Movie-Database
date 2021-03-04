
<!DOCTYPE html>
<html>
<body style = "background-color:aquamarine;">
Statistici<br>
Alegeti una din optiunile de mai jos pentru a o afisa.
<form action="stats.php" method="post">
	<select name="stats">
		<option value=""> </option>
		<option value="best_rating">Afisati filmele in ordinea ratingului</option>
		<option value="most_films_actor">Afiseaza actorii cu cele mai multe filme</option>
		<option value="number_mov_house">Afiseaza cate filme din fiecare gen are fiecare casa de productie</option>
		<option value="top_house">Afiseaza top5 case cu cele mai multe filme</option>
		<option value="top_house_rating">Afiseaza top 3 case cu cel mai bun rating</option>
		
	</select>
	<input type="submit" value="Afisati">
</form>
<p> <a href="main.php">Inapoi</a> </p>
<p> <a href="stats.php">Refresh</a> </p>

</html>

<?php
session_start();
require_once('conexiune_stabilita.php');

if(isset($_POST['stats'])){
if(!empty($_POST['stats'])){
	$select = $_POST['stats'];
	
	if($select === 'best_rating'){
		$query = "SELECT F.Nume AS Nume, AVG(Stele) AS Rating
				FROM Film F JOIN Recenzie R ON F.ID_Film = R.ID_Film 
				GROUP BY F.Nume
				ORDER BY AVG(Stele) DESC";
		$met = sqlsrv_query($conn,$query) or die(print_r(sqlsrv_errors(),true));
		
		while($get = sqlsrv_fetch_object($met)){
			echo $get->Nume;
			echo " - Rating: ";
			echo $get->Rating;
			echo "/5";
			echo "<br>";
		}
	}
	
	if($select === 'most_films_actor'){
		$query = "SELECT TOP 3 A.Nume AS Nume,COUNT(*) AS Nr_Filme
				FROM Actor A JOIN FilmActor FA ON A.ID_Actor = FA.ID_Actor
				GROUP BY A.ID_Actor, A.Nume
				ORDER BY Nr_Filme DESC";
		$met = sqlsrv_query($conn,$query) or die(print_r(sqlsrv_errors(),true));
		echo "<br>";
		
		while($get = sqlsrv_fetch_object($met)){
			
			echo $get->Nume;
			echo " - Numar filme: ";
			echo $get->Nr_Filme;
			echo "<br>";
		}
	}
	
	if($select === 'number_mov_house'){
		$query = "SELECT G.Nume AS Nume_Gen, COUNT(*) AS Nr_Filme,C.Nume_Casa_Productie AS Nume_Casa
				FROM Casa_Productie C JOIN Film F ON F.ID_Casa_Productie = C.ID_Casa_Productie 
										JOIN FilmGen FG ON FG.ID_Film = F.ID_Film 
										JOIN Gen G ON G.ID_Gen = FG.ID_Gen
				GROUP BY G.Nume,C.Nume_Casa_Productie
				ORDER BY Nr_Filme DESC";
		$met = sqlsrv_query($conn,$query) or die(print_r(sqlsrv_errors(),true));
		echo "<br>";
		
		while($get = sqlsrv_fetch_object($met)){
			
			echo $get->Nume_Casa;
			echo" - ";
			echo $get->Nume_Gen;
			echo " - Numar filme: ";
			echo $get->Nr_Filme;
			echo "<br>";
		}
	}
	if($select === 'top_house'){
		$query = "SELECT TOP 5 COUNT(X.Nume_Casa_Productie) AS Nr_Filme, 		X.Nume_Casa_Productie AS Nume_Casa_Productie
					FROM (SELECT C.Nume_Casa_Productie, F.Nume
					FROM Film F JOIN Casa_Productie C ON C.ID_Casa_Productie = F.ID_Casa_Productie
					GROUP BY C.Nume_Casa_Productie, F.Nume) AS X
					GROUP BY X.Nume_Casa_Productie
					ORDER BY COUNT (X.Nume_Casa_Productie) DESC";
		$met = sqlsrv_query($conn,$query) or die(print_r(sqlsrv_errors(),true));
		echo $select;
		echo "<br>";
		
		while($get = sqlsrv_fetch_object($met)){
			
			echo $get->Nume_Casa_Productie;
			echo" - ";
			echo " - Numar filme: ";
			echo $get->Nr_Filme;
			echo "<br>";
		}
	}
	if($select === 'top_house_rating'){
		$query = "SELECT TOP 3 MAX(R.Stele) AS Rating, F.Nume AS Nume_Film, C.Nume_Casa_Productie As Nume_Casa
					FROM Casa_Productie C JOIN Film F ON F.ID_Casa_Productie = C.ID_Casa_Productie JOIN Recenzie R ON F.ID_Film = R.ID_Film
					GROUP BY C.Nume_Casa_Productie, F.Nume
					ORDER BY Rating DESC";
					
		$met = sqlsrv_query($conn,$query) or die(print_r(sqlsrv_errors(),true));
		echo "<br>";
		
		while($get = sqlsrv_fetch_object($met)){
			
			echo $get->Nume_Casa;
			echo" - ";
			echo " - ";
			echo $get->Nume_Film;
			echo " - ";
			echo $get->Rating;
			echo"/5";
			echo "<br>";
		}
	}
	
	
}
}
?>