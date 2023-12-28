<?php

require_once 'Manager.php';

class UserManager extends Manager
{
    /**
     * @throws Exception
     */
    public function addUser($pseudo, $email, $password): bool
    {
        try {
            $db = $this->dbConnect();
            $req = $db->prepare('INSERT INTO user(pseudo, email, password) VALUES(?, ?, ?)');
            return $req->execute(array($pseudo, $email, $password));
        }catch (Exception $e) {
            echo throw new Exception('Erreur : ' . $e->getMessage());
        }

    }

    /**
     * @throws Exception
     */
    public function getUserInfo($pseudo, $email, $password): void
    {
        try {
            $db = $this->dbConnect();
            $req = $db->query('SELECT * FROM user');

            while ($data = $req->fetch()) {
                if ($data['pseudo'] === $pseudo || $data['email'] === $email || $data['password'] === $password) {
                    exit();
                }
            }
        }catch (Exception $e) {
            echo throw new Exception('Erreur : ' . $e->getMessage());
        }
    }
}