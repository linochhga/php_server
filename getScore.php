<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Content-Type: application/json;charset=utf-8");

include("db.php");
$sql = "SELECT `name`, `score` FROM `users`
		LEFT JOIN `scores`
		ON (`users`.`id`=`scores`.`user`)
		WHERE `score` IS NOT NULL
		ORDER BY `score`
		LIMIT 10;";
		//WHERE `user`=1 z tym beda nie wszystkie where `score`!=NULL
$query = $db->prepare($sql);
$query->execute();
$result = $query->setFetchMode(PDO::FETCH_ASSOC);
if($query->rowCount() > 0) {
	echo '[';
	$inc = 1;
	while($row=$query->fetch(PDO::FETCH_OBJ)) {
		if($query->rowCount()!=$inc){
        echo '{"name":"'. $row->name .'", "score": '. $row->score .'},';
		$inc++;
		}
		else {
			echo '{"name":"'. $row->name .'", "score": '. $row->score .'}';
		} 
    }
	echo ']';
} else {
	echo '{"error": "Nie udalo sie pobrac scora, wynik 0 rows"}';
}
?>
