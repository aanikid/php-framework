<?php

namespace App\Models;

use PDO;

class BDD
{
    private PDO $bdd;
    private static mixed $instance;

    public function __construct()
    {
        $this->bdd = new PDO('mysql:dbname=' . 'clqc0088_test_php' . ';host=' . 'clqc0088.odns.fr' , 'clqc0088_youness', 'lolo271190');
        $this->bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }


    public static function getInstance(): PDO
    {
        if (empty(self::$instance)) {
            self::$instance = new BDD();
        }
        return self::$instance->bdd;
    }

    public function getBdd(): PDO
    {
        return $this->bdd;
    }
}