<?php

class Connexion {
	static private $hostname = "localhost";
	static private $database = "prj-as-2002";
	static private $login = "prj-as-2002";
	static private $password = "EGlp1Q2yix1xK7yC";
	
	static private $tabUTF8 = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");
	static private $pdo = false;
	
	static public function pdo() {
		if (!self::$pdo){
			self::connect();
		}
		return self::$pdo;
	}
	
	static public function connect(){
		try {
			self::$pdo = new PDO("mysql:host=".self::$hostname.";dbname=".self::$database,self::$login,self::$password,self::$tabUTF8);
			self::$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		} catch(PDOException $e) {
			echo "erreur de connexion : ".$e->getMessage()."<br>";
		}	
	}

}
?>