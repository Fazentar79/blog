<?php

namespace App\Manager;

use Exception;
use PDO;

class Manager
{
    /**
     * @throws Exception
     */
    protected function connection(): PDO
    {
        try {
            $db = new PDO('mysql:host=localhost;dbname=blog_jdr;charset=utf8', 'root', '');
        } catch (Exception $e) {
            throw new Exception(('Erreur : ' . $e->getMessage()));
        }
        return $db;
    }
}
