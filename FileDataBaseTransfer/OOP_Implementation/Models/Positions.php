<?php


class Positions
{
    private $executeOnDb;

    public function __construct()
    {
        $this->executeOnDb = new ExecuteOnDB();
    }

    public function insert($processedData)
    {
        $this->executeOnDb->createStmt('
        INSERT INTO positions
        (name)
        VALUES (?)
        ');
        $this->insertIntoDB($processedData);
    }

    private function insertIntoDb(Array $processedData)
    {
        foreach($processedData as $row)  {
            $this->executeOnDb->executeQuery([$row]);
        }
    }
}