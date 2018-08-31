<?php
mysql_connect("rdbms.strato.de", "U1919879", "DB12357DB-DB12357DB") or die("Mysql wurde nicht Gefunden!!");
mysql_select_db("DB1919879") or die("Keine Datenbank");

$username = "";
$username = $_GET["name"];
//$username = strtolower($username);

$pass = "";
$pass = $_GET["pass"];

$arr = array('ResultCode' => 3);

if($username != "" && $pass != ""){
	$sql = "SELECT * FROM subspace_users WHERE username LIKE '$username'";
	$e = mysql_query($sql);
	$row = mysql_fetch_object($e);
	if(!$row)
	{
		$arr = array('ResultCode' => 2);
		echo json_encode($arr);
	}else
	{
		if($row->username == $username && $row->password == md5($pass)) {
			$arr = array('ResultCode' => 1, 'UserId' => $row->userid,'Nickname' => $row->username);
			echo json_encode($arr);
		}else {
			$arr = array('ResultCode' => 2);
			echo json_encode($arr);
		}
	}
	
}else{
	$arr = array('ResultCode' => 3);
	echo json_encode($arr);
}

?>