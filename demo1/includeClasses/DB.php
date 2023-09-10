<?php
class DB
{
    private $host = 'localhost';
    private $username = 'root';
    private $password = '';
    private $database = 'rating_store';
    protected $connection;

    public function __construct()
    {
        if (!isset($connection)) {
            $this->connection = new mysqli($this->host, $this->username, $this->password, $this->database);
            if (!$this->connection)
                die("Connection failed: " . $this->connection->connect_error);
         }
    }
}