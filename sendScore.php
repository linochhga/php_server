<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Content-Type: application/json;charset=utf-8");
		
$data = json_decode(file_get_contents('php://input'),true);	
	
if(isset($data)){
    if(!isset($data['user']) || !isset($data['score'])){
        echo '{"error": "Brak niektórych pól"}';
    } else {
		include("db.php");
		$sqllogin = "SELECT `id` FROM `users` WHERE email =:email;";
		$loginquery = $db->prepare($sqllogin);
		$loginquery->bindParam(":email", $data['user']);
		$loginquery->execute();
		$row = $loginquery->fetch(PDO::FETCH_ASSOC);
		$sqlWstaw="INSERT INTO `scores` (user,score)
					VALUES (:id,:score);";
		if($loginquery->rowCount() > 0){
			$WstawQuery = $db->prepare($sqlWstaw);
			$WstawQuery ->bindParam(":score", $data['score']);
			$WstawQuery ->bindParam(":id", $row["id"]);
			$WstawQuery ->execute();
			if($WstawQuery ->rowCount() < 0){
				echo '{"error": "Nie wstawilem do tablicy"}';
			} else {
				echo '{"success": true}';
			}
		}
		else echo '{"error": "Nie ma takiego email w bazie"}';
	}
} else {
	echo '{"error": "Bład serwera"}';
}
?>