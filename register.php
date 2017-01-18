<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Content-Type: application/json;charset=utf-8");

include("db.php");
include("sesje.php");
$sesja = new Session($db);
$data = json_decode(file_get_contents('php://input'), true);

if(isset($data)){
    if(!isset($data['userName']) || !isset($data['email']) || !isset($data['password']) || !isset($data['password2'])){
        echo '{"error": "Brak niektórych pól"}';
    } elseif ($data['password'] != $data['password2']) {
        echo '{"error": "Hasła są nie zgodne"}';
    } elseif (empty($data['password']) || strlen($data["password"]) > 75 || strlen($data["password"]) < 6) {
        echo '{"error": "Hasła nie odpowiada wymogom"}';
    } else  {
        echo ($sesja->register($data['userName'], $data['email'], $data['password'], $data['password2']));
    }
} else {
	echo '{"logged": false}';
}
?>
