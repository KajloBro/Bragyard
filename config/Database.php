<?php

class Database {
    private $host = 'localhost';
    private $db = 'bragyard';
    private $user = 'root';
    private $pass = '';
    private $charset = 'utf8mb4';
    private $pdo;
    private $dsn;
    private $options;

    public function connect() {
        $this->pdo = null;
        $this->dsn = 'mysql:host='.$this->host.';dbname='.$this->db.';charset='.$this->charset;
        $this->options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        try {
            $this->pdo = new PDO($this->dsn, $this->user, $this->pass, $this->options);
         } catch (PDOException $e) {
            echo 'Connection error: ' . $e->getMessage();
        }
        
        return $this->pdo;
    }
}

?>