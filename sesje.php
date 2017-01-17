<?php

header("Access-Control-Allow-Origin: *");

class Session {
	private $error = false;
	private $db;
	public function __construct($db) {
		session_start();
		$this->db = $db;
	}
	
	public function loginAs($email, $password) {
		$sql = "SELECT id, password FROM users WHERE email=:email";
		$query = $this->db->prepare($sql);
		$query->bindParam(":email", $email);
		$query->execute();
		$row = $query->fetch(PDO::FETCH_ASSOC); 
		if($query->rowCount() > 0) {
		  if(password_verify($password, $row["password"])) {
		    $_SESSION['login'] = $login;
            $_SESSION['id'] = $row["id"];
            return '{"success": true}';
          } else {
            return  '{"error": "Niepoprawne hasło."}';
          }
		} else {
		    return  '{"error": "Taki użytkownik nie istnieje w bazie danych."}';
		}
	}
	
	public function getLogin() {
		if($this->isLogged())
			return $_SESSION['login'];
		else
			return null;
	}
	
	public function getID() {
		if($this->isLogged())
			return $_SESSION['id'];
		else
			return null;
	}
	
	public function isLogged() {
		return isset($_SESSION['login']);
	}
	
	public function getError() {
		return $this->error;
	}
	
	public function logout() {
		session_unset(); 
		session_destroy();
	}
}
?>
