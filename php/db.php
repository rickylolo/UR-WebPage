<?php

class DB
{
    private $host;
    private $db;
    private $user;
    private $password;
    private $charset;

    public function __construct()
    {
        $this->host = 'localhost';
        $this->db = 'UR_WEBPAGE';
        $this->user = 'root';
        $this->password = 'zL6MMqF51868520';
        $this->charset = 'utf8mb4';
    }

    function connect()
    {
        try {
            $connection = "mysql:host=" . $this->host . ";dbname=" . $this->db . ";charset=" . $this->charset;

            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ];
            $pdo = new PDO($connection, $this->user, $this->password, $options);

            return $pdo;
        } catch (PDOException $e) {
            print_r('Error Connection: ' . $e->getMessage());
        }
    }
    function myCon()
    {
        $con = mysqli_connect($this->host,  $this->user, $this->password, $this->db);
        return $con;
    }
}
