<?php
mysql_connect("rdbms.strato.de", "U1919879", "DB12357DB-DB12357DB") or die("Mysql wurde nicht Gefunden!!");
mysql_select_db("DB1919879") or die("Keine Datenbank");

$input = file_get_contents('php://input');
$json = json_decode($input);

$gameid = $json->GameId;
$worldid = $json->CreateOptions->CustomProperties->worldid;
$status = $json->CreateOptions->CustomProperties->status;
$usercount = $json->ActorNr;
$maxplayers = $json->CreateOptions->MaxPlayers;

//file_put_contents("oncreate.txt", $input);

if(checkalreadyexist($gameid) == ""){

	$sql = "INSERT INTO subspace_rooms(gameid, worldid, status, usercount ,maxplayers) VALUES('$gameid','$worldid', '$status', '$usercount', '$maxplayers')";
	$ergebnis = mysql_query($sql);

	echo "{ 'ResultCode' : 0 }";

}else{
	
	echo "{ 'ResultCode' : 0, 'Message' : 'something went wrong'}";
	
}




function checkalreadyexist($gameid){
	$response = "";
	$ergebnis = mysql_query("SELECT * FROM subspace_rooms WHERE gameid like '$gameid' LIMIT 1");
	while($row = mysql_fetch_object($ergebnis)) {
		$response = "$row->gameid";
	}
	return $response;
}
?>