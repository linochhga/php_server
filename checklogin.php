<?php

header("Content-Type: application/json;charset=utf-8");

if($_GET && $_GET['login']){
	include("db.php");
	$sql = "SELECT id FROM users WHERE login=:login";
	$query = $db->prepare($sql);
	$query->bindParam(":login", $_GET['login']);
	$query->execute();
	$row = $query->fetch(PDO::FETCH_ASSOC);
	if($query->rowCount() > 0) {
		$json = '{"logged": false}';
	} else {
		$json = '{"logged": true}';
	}
	echo $json;
} else {
	echo '{"logged": false}';
}


?>
