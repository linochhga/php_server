<?php
include("db.php");
$sql = "SELECT id FROM users WHERE login=:login";
$query = $db->prepare($sql);
$query->bindParam(":login", $_GET['login']);
$query->execute();
$row = $query->fetch(PDO::FETCH_ASSOC);
if($query->rowCount() > 0) {
	header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found"); 
} else {
	echo "OK";
}
?>
