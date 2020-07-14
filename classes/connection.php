<?php 

    class Database {

        private $server_name = "localhost";
        private $user_name = "root";
        private $password = "";
        private $database = "hair_salon_system";
        
        public $conn;

        public function __construct() {
            $this->conn = new mysqli($this->server_name, $this->user_name, $this->password, $this->database);

            if($this->conn->connect_error) {
                die("Connection error: ".$this->conn->connect_error);
            }

            return $this->conn;
        }
    }
; ?>    