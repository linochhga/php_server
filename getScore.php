<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Content-Type: application/json;charset=utf-8");

include("db.php");
$sql = "SELECT `name`, `score` FROM `users`
		LEFT JOIN `scores`
		ON (`users`.`id`=`scores`.`user`)
		LIMIT 10;";
		//WHERE `user`=1 z tym beda nie wszystkie where `score`!=NULL
$query = $db->prepare($sql);
$query->execute();
$result = $query->setFetchMode(PDO::FETCH_ASSOC);
if($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
		echo '{"name":", $row["name"]
			   "score": $row["score"]}';
	}
} else {
	echo '{"error": "Nie udalo sie pobrac scora, wynik 0 rows"}';
}
?>
