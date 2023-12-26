<?php

class Manager
{
    /**
     * @throws Exception
     */
    protected function dbConnect(): PDO
    {
        try {
            return new PDO('mysql:host=localhost;dbname=blog_fantasy;charset=utf8', 'root', '');
        }catch (Exception $e) {
            throw new Exception('Erreur : ' . $e->getMessage());
        }
    }
}