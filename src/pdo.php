<?php

declare(strict_types=1);

class TestPDO extends PDO
{
    public function __construct(
        private string $host,
        private string $user,
        private string $password,
        private string $dbname
    ){}

    public function getIfDBExists() : PDO
    {
        $dsn = "mysql:host=$this->host;dbname=$this->dbname;charset=UTF8";
        $pdo = new PDO($dsn, $this->user, $this->password);
        return $pdo;
    }

    public function getIfDBNotExists() : PDO
    {
        $dsn = "mysql:host=$this->host;charset=UTF8";
        $pdo = new PDO($dsn, $this->user, $this->password);
        return $pdo;
    }
}