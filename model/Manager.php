<?php
class Manager
{
    private static PDO $db;

    /**
     * @throws Exception
     */
    protected static function dbConnect(): PDO
    {
        try {
            self::$db = new PDO('mysql:host=localhost;dbname=blog_fantasy;charset=utf8', 'root', '');
        }catch (Exception $e) {
            throw new Exception('Erreur : ' . $e->getMessage());
        }
        return self::$db;
    }

    /**
     * @throws Exception
     */
    protected function getDB(): PDO
    {
        if (self::$db === null) {
            try {
                self::dbConnect();
            } catch (Exception $e) {
                throw new Exception('Erreur : ' . $e->getMessage());
            }
        }
        return self::$db;
    }
}