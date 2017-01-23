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
		    $_SESSION['login'] = $email;
            $_SESSION['id'] = $row["id"];
            return '{"success": true}';
          } else {
            return  '{"error": "Niepoprawne hasło."}';
          }
		} else {
		    return  '{"error": "Taki użytkownik nie istnieje w bazie danych."}';
		}
	}

	public function register($name, $email, $password) {
			$islogin = "SELECT `id` FROM `users` WHERE name =:name";
			$query = $this->db->prepare($islogin );
			$query->bindParam(":name", $name);
			$query->execute();
			if($query->rowCount() > 0) {
				 return '{"error": "Login jest zajęty"}';
			}
			
			$ismail = "SELECT `id` FROM `users` WHERE email =:email";
			$query = $this->db->prepare($ismail);
			$query->bindParam(":email", $email);
			$query->execute();
			if($query->rowCount() > 0) {
				 return '{"error": "E-mail jest już zarejestrowany"}';
			}

    		$sql = "INSERT INTO `users` VALUES (NULL, :name, :password, :email)";
    		$params = [ ":name" => $name,
                        ":password" => password_hash($password, PASSWORD_DEFAULT),
                        ":email" => $email ];
    		$query = $this->db->prepare($sql);
    	    $query->execute($params);
    		if($query->errorCode() != 0) {
              return  '{"error": "'.$query->errorInfo()[2].'"}';
    		} else {
    		  return '{"success": true}';
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
