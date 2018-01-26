<?php


class ConfigDB
{
    private $db = 'mysql:host=localhost;dbname=test';
    private $username = 'root';
    private $password = '123';
    private $connect;

    public function __construct()
    {
        $this->connect = new PDO($this->db, $this->username, $this->password);
    }

    /**
     * @return PDO
     */
    public function getConnect(): PDO
    {
        return $this->connect;
    }

}