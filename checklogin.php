<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Content-Type: application/json;charset=utf-8");

$data = json_decode(base64_decode(file_get_contents('php://input')),true);

if(isset($data)){
    if(!isset($data['email']) || !isset($data['password'])){
         echo '{"logged": false}';
    } else {
		include("db.php");
        $sql = "SELECT id, password FROM users WHERE email=:email";
        $query = $db->prepare($sql);
        $query->bindParam(":email", $data['email']);
        $query->execute();
        $row = $query->fetch(PDO::FETCH_ASSOC);
        if($query->rowCount() > 0) {
            if(password_verify($data['password'], $row["password"])) {
                echo '{"logged": true}';
            } else {
                echo '{"logged": false}';
            }
        } else {
        	echo '{"logged": false}';
        }
	}
} else {
	echo '{"logged": false}';
}

?>
