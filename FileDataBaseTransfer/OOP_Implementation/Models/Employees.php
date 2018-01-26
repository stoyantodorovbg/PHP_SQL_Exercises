<?php

class Employees
{
    private $executeOnDb;

    public function __construct()
    {
        $this->executeOnDb = new ExecuteOnDB();
    }

    public function insert(array $processedData)
    {
        $this->executeOnDb->createStmt('
        INSERT INTO employees
        (id, firstName, lastName, salary, position_id)
        VALUES (?,?,?,?,?)');

        $this->insertIntoDB($processedData);
    }

    private function insertIntoDB(array $arr) {
        foreach ($arr as $row) {
            $id = $row[0]['id'];
            $firstName = $row[1]['firstName'];
            $lastName = $row[2]['lastName'];
            $salary = $row[3]['salary'];

            $this->executeOnDb->executeQuery([$id, $firstName, $lastName, $salary, 1]);
        }
    }
}