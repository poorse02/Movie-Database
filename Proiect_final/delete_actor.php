<!DOCTYPE html>
<html>
<body style = "background-color:lightpink;">
<form action = "delete_actor_succes.php" method = "post">
<p>Selectati actorul/actorii pe care doriti sa il/ii stergeti.</p>
</html>

<?php

session_start();
require_once('conexiune_stabilita.php');

$sql_actor = "SELECT ID_Actor, Nume
			FROM Actor";
$count = 0;
$result_actor = sqlsrv_query($conn,$sql_actor) or die(print_r(sqlsrv_errors(),true));
while($data_actor = sqlsrv_fetch_array($result_actor)){
	$count = $count + 1;
	echo $count; ?>
	<input type = "checkbox" id = "checkbox<?php echo $count?>" name="checkbox<?php echo $count?>" value="<?php echo $data_actor['ID_Actor'] ?>"><?php echo $data_actor['Nume'];?> &nbsp;
<?php
	$ID_Actor = $data_actor['ID_Actor'];
	}
?>

<html>
	<input type="submit" value="Stergeti"> </p>
	<p> <a href="main.php">Inapoi</a>

</form>
</html>