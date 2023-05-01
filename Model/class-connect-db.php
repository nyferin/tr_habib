<?php

class Connection
{
    public $host = "127.0.0.1",
    $db_name = "db_sekolah",
    $user = "root",
    $pass = "",
    $db;
    
    public function __construct() {
        $this->db = new PDO(
            "mysql:host={$this->host}; dbname={$this->db_name}",
            $this->user,
            $this->pass
        );
    }
}
