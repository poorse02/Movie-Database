<?php
//prin aceasta pagina se face conexiunea la baza de date
$serverName = "PIERSE\SQLEXPRESS"; //serverName\instanceName

$connectionInfo = array( "Database"=>"Proiect");
$conn = sqlsrv_connect( $serverName, $connectionInfo);

if( $conn ) {
    // echo "Connection established.<br />"; //se decomenteaza in caz de debugging
}else{
     echo "Connection could not be established.<br />";
     die( print_r( sqlsrv_errors(), true));
	 echo['Nume'];
}

?>