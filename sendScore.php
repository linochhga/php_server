<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Content-Type: application/json;charset=utf-8");

include("db.php");
include("sesje.php");
$sesja = new Session($db);
$data = json_decode(file_get_contents('php://input'), true);

if(isset($data)){
    if(!isset($data['email']) || !isset($data['password'])){
        echo '{"error": "Brak niektórych pól"}';
    } else {
		echo ($sesja->loginAs($data['email'], $data['password']));
	}
} else {
	echo '{"logged": false}';
}
?>
