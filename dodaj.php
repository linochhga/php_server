<?php
include("db.php");
if(!isset($_POST["login"]) || !isset($_POST["password"]) || !isset($_POST["mail"]))
	die("Brak niektórych pól");

if(empty($_POST["login"]) || strlen($_POST["login"]) > 20)
	die("Pusty lub zbyt długi login");
	
if(!preg_match("/^[a-zA-Z0-9_-]*$/", $_POST["login"]))
	die("Login nie zgodny ze wzorcem");

if(empty($_POST["password"]) || strlen($_POST["password"]) > 75)
	die("Puste lub zbyt długie hasło");

if(empty($_POST["password"]) || strlen($_POST["mail"]) > 100)
	die("Pusty lub zbyt długi mail");

if(!filter_var($_POST["mail"], FILTER_VALIDATE_EMAIL))
	die("Niepoprawny adres mail");

$sql = "INSERT INTO `users` VALUES (NULL, :login, :password, :mail)";
$params = [ ":login" => $_POST["login"],
            ":password" => password_hash($_POST["password"], PASSWORD_DEFAULT),
            ":mail" => htmlspecialchars($_POST["mail"]) ];
$query = $db->prepare($sql);
$query->execute($params);
if($query->errorCode() != 0)
  echo "Błąd: ".$query->errorInfo()[2];
else
  echo "Pomyślnie dodano nowego użytkownika.";

?>
