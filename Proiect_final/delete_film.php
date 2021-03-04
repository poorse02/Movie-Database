<!DOCTYPE html>
<html>
<body style = "background-color:lightpink;">
<form action = "delete_film_succes.php" method = "post">
<p>Selectati filmul/filmele pe care doriti sa il/le stergeti.</p>
</html>

<?php

session_start();
require_once('conexiune_stabilita.php');

$sql_film = "SELECT ID_Film, Nume
			FROM Film";
$count = 0;
$result_film = sqlsrv_query($conn,$sql_film) or die(print_r(sqlsrv_errors(),true));
while($data_film = sqlsrv_fetch_array($result_film)){ //select de tip checkbox de unde se pot sterge mai multe filme dintr-o data
	$count = $count + 1;
	echo $count; ?>
	<input type = "checkbox" id = "checkbox<?php echo $count?>" name="checkbox<?php echo $count?>" value="<?php echo $data_film['ID_Film'] ?>"><?php echo $data_film['Nume'];?> &nbsp;
<?php
	$ID_Film = $data_film['ID_Film'];
	}
?>

<html>
	<input type="submit" value="Stergeti"> </p>
	<p> <a href="main.php">Inapoi</a>

</form>
</html>