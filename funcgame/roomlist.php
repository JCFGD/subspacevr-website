<?php
mysql_connect("rdbms.strato.de", "U1919879", "DB12357DB-DB12357DB") or die("Mysql wurde nicht Gefunden!!");
mysql_select_db("DB1919879") or die("Keine Datenbank");


$response = "";
$ergebnis = mysql_query("SELECT * FROM subspace_rooms");
while($row = mysql_fetch_object($ergebnis)) {
	
	$room = array('GameId' => $row->gameid, 'WorldId' => $row->worldid,'Status' => $row->status,'UserCount' => $row->usercount,'MaxPlayer' => $row->maxplayers);
	$response[] = $room;
}
$output = array('rooms' => $response);
echo json_encode($output);

?>