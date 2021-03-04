
<!DOCTYPE html>
<html>
<body style = "background-color:lightskyblue;">
Trivia despre useri<br>
Alegeti una din optiunile de mai jos pentru a o afisa.
<form action="fun.php" method="post">
	<select name="fun">
		<option value=""> </option>
		<option value="worst_rating">Afiseaza cea mai proasta recenzie de la fiecare film</option>
		<option value="unpopular">Afiseaza cele mai nepopulare filme (nu au recenzii)</option>
		<option value="productive_user">Afisati cei mai productivi useri (cei care au cele mai multe recenzii 
		<option value="popular_lang">Afiseaza limba cea mai populara pentru subtitrari</option> postate)</option>

		
	</select>
	<input type="submit" value="Afisati">
</form>
<p> <a href="main.php">Inapoi</a> </p>
<p> <a href="stats.php">Refresh</a> </p>

</html>

<?php
session_start();
require_once('conexiune_stabilita.php');

if(isset($_POST['fun'])){
if(!empty($_POST['fun'])){
	$fun = $_POST['fun'];
	echo $fun;
	
	if($fun === 'worst_rating'){
		$query = "SELECT F.Nume AS Nume, R.Stele AS Stele
					FROM Film F JOIN Recenzie R ON F.ID_FIlm = R.ID_Film
					WHERE R.Stele = (SELECT MIN(Stele)
									FROM Recenzie R1
									WHERE R.ID_Film  = R1.ID_Film)";
;
		$met = sqlsrv_query($conn,$query) or die(print_r(sqlsrv_errors(),true));
		echo "salut";
		
		while($get = sqlsrv_fetch_object($met)){
			echo $get->Nume;
			echo " - Rating: ";
			echo $get->Stele;
			echo "/5";
			echo "<br>";
		}
	}
	
	if($fun === 'unpopular'){
		$query = "SELECT F.Nume AS Nume
					FROM Film F
					WHERE F.ID_Film NOT IN (SELECT DISTINCT F2.ID_Film
											FROM Film F2 JOIN Recenzie R ON F2.ID_Film = R.ID_Film
											WHERE F2.ID_Film = R.ID_Film)";
		$met = sqlsrv_query($conn,$query) or die(print_r(sqlsrv_errors(),true));
		echo "salut2  ";
		echo $fun;
		echo "<br>";
		
		while($get = sqlsrv_fetch_object($met)){
			
			echo $get->Nume;
			echo "<br>";
		}
	}
	
	if($fun === 'productive_user'){
		$query = "SELECT COUNT(*) AS Nr_Recenzii, U.Nume AS Nume
				FROM User_site U JOIN Recenzie R ON U.ID_User = R.ID_User
				GROUP BY U.ID_User, U.Nume";
		$met = sqlsrv_query($conn,$query) or die(print_r(sqlsrv_errors(),true));
		echo "salut2  ";
		echo $fun;
		echo "<br>";
		
		while($get = sqlsrv_fetch_object($met)){
			
			echo $get->Nume;
			echo" - ";
			echo " - Numar recenzii: ";
			echo $get->Nr_Recenzii;
			
			echo "<br>";
		}
	}
	if($fun === 'popular_lang'){
		$query = "SELECT TOP 3 S.Limba AS Limba, COUNT(*) AS Nr_Subtitrari
				FROM Subtitrare S JOIN Film F ON F.ID_Film = S.ID_Film
				GROUP BY S.Limba
				ORDER BY COUNT(*) DESC";
		$met = sqlsrv_query($conn,$query) or die(print_r(sqlsrv_errors(),true));
		echo "salut2  ";
		echo $fun;
		echo "<br>";
		
		while($get = sqlsrv_fetch_object($met)){
			
			echo $get->Limba;
			echo" - ";
			echo " - Numar subtitrari: ";
			echo $get->Nr_Subtitrari;
			echo "<br>";
		}
	}
	
	
}
}
?>