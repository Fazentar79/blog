<?php
class Manager
{
    private static $db;
    /**
     * @throws Exception
     */
    private static function setDb(): PDO
    {
        try {
            self::$db = new PDO('mysql:host=localhost;dbname=blog_fantasy;charset=utf8', 'root', '');
        }catch (PDOException $e) {
            echo 'Erreur : ' . $e->getMessage();
        }
        return self::$db;
    }

    /**
     * @throws Exception
     */
    protected function getDb(): PDO
    {
        if (self::$db === null) {
            return self::setDb();
        }
        return self::$db;
    }
}