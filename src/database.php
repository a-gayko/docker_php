<?php

declare(strict_types=1);

class TestDatabase
{
    public function __construct(
        private string $dbname,
        private array $tables,
        private TestPDO $pdo
    ) {}

    public function createDatabase() : void
    {
        $query = "SHOW DATABASES";
        $databases = $this->pdo->getIfDBNotExists()->query($query);
        $result = $databases->fetchAll(PDO::FETCH_COLUMN);

        if (!in_array($this->dbname, $result)) {
            try {
                $this->pdo->getIfDBNotExists()->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $query = "CREATE DATABASE $this->dbname";
                $this->pdo->getIfDBNotExists()->exec($query);
                echo "<h2 style='text-align: center;'>Database \"" . strtoupper($this->dbname) . "\" created successfully!</h2><hr>";
            } catch(PDOException $e) {
                echo $e->getMessage();
            }
        } else {
            echo "<hr><h2 style='text-align: center;'>\"" . strtoupper($this->dbname) . "\" DATABASE </h2><hr>";
        }
    }

    public function createTables() : void
    {
        try {
            $listTables = '';
            foreach ($this->tables as $name => $table) {
                $this->pdo->getIfDBExists()->exec($table);
                $listTables .= '"' . $name . '", ';
            }
            echo "<h2 style='text-align: center;'>Tables: $listTables created successfully!</h2><br>";
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function showTables() : void
    {
        $query = "SHOW TABLES FROM test";
        $result = $this->pdo->getIfDBExists()->query($query);
        $arrayTables = $result->fetchAll(PDO::FETCH_COLUMN);
        $listTables = '';

        if (null != $arrayTables) {
            try {
                $i = 1;
                foreach ($arrayTables as $row) {
                    $listTables .= "$i.<b>  $row; </b>";
                    $i++;
                }
                echo "<div style='text-align: center'><h2><b>TABLES:</b></h2><p> $listTables </p></div><hr>";
            } catch(PDOException $e) {
                echo $e->getMessage();
            }
        } else {
            $this->createTables();
        }
    }
}