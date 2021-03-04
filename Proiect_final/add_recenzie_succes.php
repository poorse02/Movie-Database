<?php
session_start();
require_once('conexiune_stabilita.php');

if(isset($_POST['Text']))
		$Text = $_POST['Text'];
if(isset($_POST['Stele']))
		$Stele = $_POST['Stele'];
if(isset($_POST['Select_Film']));
		$Nume_Film = $_POST['Select_Film'];
		
		echo "OKdata";
		
	$query_film = "SELECT ID_Film
			FROM Film
			WHERE Nume = '{$Nume_Film}'";
	$met_film = sqlsrv_query($conn,$query_film) or die(print_r(sqlsrv_errors(),true));
	$ID_Film = sqlsrv_fetch_object($met_film);	

	$query_id_user = "SELECT ID_User,Nume
						FROM User_site
						WHERE Mail = '{$_SESSION['Mail']}'";
	$metoda_id_user = sqlsrv_query($conn,$query_id_user) or die(print_r(sqlsrv_errors(),true));
	$id_user = sqlsrv_fetch_object($metoda_id_user);
	
	

	if(empty($_POST['Text']) || empty($_POST['Stele']))
	{
		echo "Nu s-a introdus o recenzie inca!";
	}
	else
	{
		$query = "INSERT INTO Recenzie(Text,ID_User,ID_Film,Data_recenzie,Stele) VALUES('$Text', '$id_user->ID_User', '$ID_Film->ID_Film',GETDATE(),'$Stele')";
		$metoda= sqlsrv_query($conn,$query) or die(print_r(sqlsrv_errors(),true));
		echo "S-a introdus recenzia";
		echo "<br>";
		echo $id_user->Nume;
		echo "<br>";
		echo $Stele;
		echo "<br>";
		echo $Text;
		echo "Pentru filmul";
		echo $Nume_Film;
	}
?>
<!DOCTYPE html>
<html>
<body style = "background-color:aquamarine;">
<p> <a href="add_recenzie.php"> Doriti sa adaugati o alta recenzie</a> </p>
<p> <a href="main.php">Inapoi la pagina principala</a> </p>
</html>