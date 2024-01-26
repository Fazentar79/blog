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

    // Connection to the database avoiding duplicate connections
    /**
     * @throws Exception
     */
    protected function getDb(): PDO
    {
        return self::$db ?? self::setDb();
    }
}
