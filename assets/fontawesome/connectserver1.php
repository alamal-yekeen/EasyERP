<?php
$serverName = "TJ-DC-SRV-MISDB\RONADESQL"; //serverName\instanceName
$connectionInfo = array( "Database"=>"Taj", "UID"=>"ronadesqluser", "PWD"=>"password10$");
$conn = sqlsrv_connect( $serverName, $connectionInfo);

if($conn) {
     
}else{
     echo "Connection could not be established.<br />";
     die( print_r( sqlsrv_errors(), true));
     die( print_r( sqlsrv_errors(), true));
}


	 
?>