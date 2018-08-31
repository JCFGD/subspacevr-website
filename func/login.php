<?php
mysql_connect("rdbms.strato.de", "U1919879", "DB12357DB-DB12357DB") or die("Mysql wurde nicht Gefunden!!");
mysql_select_db("DB1919879") or die("Keine Datenbank");

$username = "";
$pass = "";
$username = $_POST["name"];
//$username = strtolower($username);
$pass = $_POST["password"];
$login = false;
$msg = "Fehler <br /> Bitte Administrator benarichtigen";
$arr = array('login' => $login, 'msg' => $msg);
if($username != "" && $pass != ""){
	$sql = "SELECT * FROM subspace_users WHERE username LIKE '$username'";
	$e = mysql_query($sql);
	$row = mysql_fetch_object($e);
	if(!$row)
	{
		$login = false;
		$msg = "Falscher Username und/oder Password";
		$arr = array('login' => $login, 'msg' => $msg);
		echo json_encode($arr);
	}else
	{
		if($row->username == $username && $row->password == md5($pass)) {
			$login = true;
			$msg = "<b>$row->username</b><br/> Erfolgreich eingelogt.";
			$arr = array('login' => $login, 'msg' => $msg);
			echo json_encode($arr);
		}else {
			$login = false;
			$msg = "$row->username == $username";
			//$msg = "Falscher Username und/oder Password";
			$arr = array('login' => $login, 'msg' => $msg);
			echo json_encode($arr);
		}
	}
	
}else{
	$login = false;
	$msg = "Bitte gegben sie Username oder Password ein.";
	$arr = array('login' => $login, 'msg' => $msg);
	echo json_encode($arr);
}

?>