<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Content-Type: application/json;charset=utf-8");

if(isset($_SESSION['email'])){
	echo '{"logged": true}';
} else {
	echo '{"logged": false}';
}

?>
