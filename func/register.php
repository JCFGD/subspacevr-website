<?php
mysql_connect("rdbms.strato.de", "U1919879", "DB12357DB-DB12357DB") or die("Mysql wurde nicht Gefunden!!");
mysql_select_db("DB1919879") or die("Keine Datenbank");

$status = 1;
$msg = "";
$createable = 1;
$creating = 0;

$user = $_POST["name"];
$pass = $_POST["password"];
$pass2 = $_POST["wpassword"];
$mail = $_POST["email"];
$maildb = "";
$userdb = "";

$activation = "";
$passhash = "";

if($creating == 0){
	if($status == 1) {
		$maildb = checkemail($mail);
		$userdb = checkuser($user);
		$status = 2;
	}

	if($status == 2) {
		if($pass == "") {
			$createable = 0;
			$msg = "Das Passwort darf nicht Leer sein!";
		}
		if($userdb != "") {
			$createable = 0;
			$msg = "Dieser Benutzername exestiert bereits!";
		}
		/*if(!preg_match("=^[a-zA-Z0-9-_]{4,}$=", $user)) {
			$createable = 0;
			$msg = "Login fehlerhaft";
		}*/ 
		if($pass != $pass2) {
			$createable = 0;
			$msg = "Das Passwort muss mit dem anderem Passwort &uuml;bereinstimmen!";
		}
		if($maildb != "") {
			$createable = 0;
			$msg = "Du hast bereits einen Account!";
		}
		
		if($createable == 1){ $creating = 1; }		
		$status = 3;
	}
}

if($creating == 1){
	if($status == 3) {
		//$activation = md5(uniqid(rand(), true));
		//$passhash = md5(md5($salt)).md5($pass);
		
		$passhash = md5($pass);
		$sql = "INSERT INTO subspace_users(username, password, email) VALUES('$user', '$passhash', '$mail')";
		$ergebnis = mysql_query($sql);
/*		$empfaenger = "$user<$mail>";
		$from  = "MIME-Version: 1.0\r\n";
		$from .= "Content-type: text/html; charset=iso-8859-1\r\n";
		$from .= "From: Webmaster YouTube Manager<webmaster@ytmanager.speidy674.de>";
		$betreff = "E-Mail verifizieren - YouTube Manager";
		$text = "<img src='http://ytmanager.speidy674.de/mctexturedb/img/logo.png' alt='Logo' height='130px'/><br/>
		Hello $user,<br/>
		To use the the page click the link:<br/>
		<a href='http://ytmanager.speidy674.de/activate/$mail/$activation/'>activating</a><br/>
		or use this: <br/>
		http://ytmanager.speidy674.de/activate/$mail/$activation/
		";
		mail($empfaenger, $betreff, $text, $from);
		*/ 
		$msg = "Thank you for signing up.\n";
		
		$arr = array('register' => true, 'msg' => $msg);
		echo json_encode($arr);
		$status = 4;
	}
}else{
	$arr = array('register' => false, 'msg' => $msg);
	echo json_encode($arr);
}

function checkemail($email){
	$maildb = "";
	$ergebnis = mysql_query("SELECT * FROM subspace_users WHERE email like '$email' LIMIT 1");
	while($row = mysql_fetch_object($ergebnis)) {
		$maildb = "$row->email";
	}
	return $maildb;
}
function checkuser($user){
	$userdb = "";
	$ergebnis = mysql_query("SELECT * FROM subspace_users WHERE username like '$user' LIMIT 1");
	while($row = mysql_fetch_object($ergebnis)) {
		$userdb = "$row->username";
	}
	return $userdb;
} 
?>