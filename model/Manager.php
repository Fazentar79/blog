<?php

class Manager
{
    protected function connection()
    {
        try {
            $db = new PDO('mysql:host=localhost;dbname=blog_jdr;charset=utf8', 'root', '');
        } catch (Exception $e) {
            throw new Exception(('Erreur : ' . $e->getMessage()));
        }
        return $db;
    }
}
