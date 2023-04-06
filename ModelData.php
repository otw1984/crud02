<?php

class ModelData
{
    /*private $host = '';
    private $dbname = '';
    private $usarname = '';
    private $pass = '';*/
    public $bdpath = __DIR__ . '/banco.sqlite';

    public function getConn()
    {
        try {
            return new PDO('sqlite:' . $this->bdpath);
        } catch (PDOException $error) {
            echo 'Erro ao tentar conexão com o banco, erro: ' . $error->getMessage();
        }
    }
}