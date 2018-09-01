<?php
mysql_connect("rdbms.strato.de", "U1919879", "DB12357DB-DB12357DB") or die("Mysql wurde nicht Gefunden!!");
mysql_select_db("DB1919879") or die("Keine Datenbank");

$input = file_get_contents('php://input');
$json = json_decode($input);

$gameid = $json->GameId;

//file_put_contents("onclose.txt", $input);

$sql = "DELETE FROM subspace_rooms WHERE gameid like '$gameid' LIMIT 1";
$ergebnis = mysql_query($sql);

echo "{ 'ResultCode' : 0 }";

?>