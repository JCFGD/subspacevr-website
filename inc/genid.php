<?php
mysql_connect("rdbms.strato.de", "U1919879", "DB12357DB-DB12357DB") or die("Mysql wurde nicht Gefunden!!");
mysql_select_db("DB1919879") or die("Keine Datenbank");

function genUserID(){
	do{
	$id = 'user'.genID();
	$already = CheckUserIdAlreadyExis($id);
	}while ($already);
	return $id;
};

function CheckUserIdAlreadyExis($id){	
	$sql = "SELECT * FROM subspace_users WHERE userid LIKE '$id'";
	$e = mysql_query($sql);
	$row = mysql_fetch_object($e);
	if($row)
	{
	return true;
	}
	return false;
}

function genWorldID(){
	do{
	$id = 'world'.genID();
	$already = CheckWorldIdAlreadyExis($id);
	}while ($already);
	return $id;
};

function CheckWorldIdAlreadyExis($id){	
	$sql = "SELECT * FROM subspace_worlds WHERE worldid LIKE '$id'";
	$e = mysql_query($sql);
	$row = mysql_fetch_object($e);
	if($row)
	{
	return true;
	}
	return false;
}

function genAvatarID(){
	do{
	$id = 'avatar'.genID();
	$already = CheckAvatarIdAlreadyExis($id);
	}while ($already);
	return $id;
};

function CheckAvatarIdAlreadyExis($id){	
	$sql = "SELECT * FROM subspace_avatars WHERE avatarid LIKE '$id'";
	$e = mysql_query($sql);
	$row = mysql_fetch_object($e);
	if($row)
	{
	return true;
	}
	return false;
}


function genID() {

	$block1 = genSalt(6);
	$block2 = genSalt(6);
	$block3 = genSalt(6);
	$block4 = genSalt(6);
	$block5 = genSalt(6);
	$block6 = genSalt(6);

	return "_".$block1."-".$block2."-".$block3."-".$block4."-".$block5."-".$block6;
}

function genSalt($length) {
	$variables = "AaBbCcDdEeFfGgHhIiJjKkLlMmNnOoPpQqRrSsTtUuVvWwXxYyZz0123456789";
	$charLength = strlen($variables);
	$returned = "";
	for($i = 0; $i < $length; $i++) {
		$returned .=$variables[rand(0, ($charLength -1))];
	}
	return $returned;
}
?>