<?php
mysql_connect("rdbms.strato.de", "U1919879", "DB12357DB-DB12357DB") or die("Mysql wurde nicht Gefunden!!");
mysql_select_db("DB1919879") or die("Keine Datenbank");

$userid = "";
$userid = $_POST["UserId"];


if($userid != ""){
	$sql = "SELECT * FROM subspace_users WHERE userid LIKE '$userid'";
	$e = mysql_query($sql);
	$row = mysql_fetch_object($e);
	if($row)
	{																					
		$arr = array('UserId' => $row->userid,'Rank' => $row->rank,'AvatarId' => $row->avatarid);
		echo json_encode($arr);
	}
	
}else{
	
}
?>
