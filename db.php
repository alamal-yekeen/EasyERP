
<?php
$serverName = "RIDWAN\RIDWAN";
$connectionOptions = [
    "Database" => "ERP",
    "Uid" => "",
    "PWD" => ""
];
$conn = sqlsrv_connect($serverName, $connectionOptions);
if (!$conn) {
    die(print_r(sqlsrv_errors(), true));
}
?>
