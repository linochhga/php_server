<?php
$host = "localhost";
$dbname = "game";
$login = "game_admin";
$pass = "5Gx2bH8iHqtAfmSG";
try {
	$db = new PDO("mysql:host=".$host.";dbname=".$dbname, $login, $pass);
} catch(PDOException $e) {
	die("Błąd połączenia: ".$e->getMessage());
}
?>
