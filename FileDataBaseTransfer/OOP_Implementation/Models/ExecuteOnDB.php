<?php
include('ConfigDB.php');

class ExecuteOnDB
{
    private $pdo;
    private $stmt;

    public function __construct()
    {
        $pdo = new ConfigDB();
        $this->pdo = $pdo->getConnect();
    }

    public function createStmt(string $query)
    {
        $this->stmt = $this->pdo->prepare($query);
    }

    public function executeQuery(array $array)
    {
        $this->stmt->execute($array);
    }
}