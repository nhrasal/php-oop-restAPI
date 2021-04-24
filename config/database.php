<?php 
    class Database {
        private $host = "remotemysql.com";
        private $database_name = "RtGx15WPWf";
        private $username = "RtGx15WPWf";
        private $password = "Rd3PanEKVA";

        public $conn;

        public function getConnection(){
            $this->conn = null;
            try{
                $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->database_name, $this->username, $this->password);
                $this->conn->exec("set names utf8");
            }catch(PDOException $exception){
                echo "Database could not be connected: " . $exception->getMessage();
            }
            return $this->conn;
        }
    }  
?>