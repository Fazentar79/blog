<?php

require_once 'Manager.php';

class UserManager extends Manager
{
    /**
     * @throws Exception
     */
    /*public function getUserInfo($pseudo, $email, $password): void
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

    /**
     * @throws Exception
     */

    public function getUserInfo($pseudo): mixed
    {
        try {
            $db = $this->dbConnect();
            $req = $db->prepare('SELECT * FROM user WHERE pseudo = :pseudo');
            $req->bindValue(":pseudo", $pseudo, PDO::PARAM_STR);
            $req->execute();
            $result = $req->fetch(PDO::FETCH_ASSOC);
            $req->closeCursor();
            return $result;
        }catch (Exception $e) {
            echo throw new Exception('Erreur : ' . $e->getMessage());
        }
    }

    /**
     * @throws Exception
     */
    public function isPseudoFree($pseudo): bool
    {
        return (empty($this->getUserInfo($pseudo)));
    }

    /**
     * @throws Exception
     */
    /*public function addUser($pseudo, $email, $password): bool
    {
        try {
            $db = $this->dbConnect();
            $req = $db->prepare('INSERT INTO user(pseudo, email, password) VALUES(?, ?, ?)');
            return $req->execute(array($pseudo, $email, $password));
        }catch (Exception $e) {
            echo throw new Exception('Erreur : ' . $e->getMessage());
        }
    }*/

    public function addUser($pseudo, $email, $password): bool
    {
        try {
            $db = $this->dbConnect();
            $req = $db->prepare('INSERT INTO user(pseudo, email, password) VALUES(:pseudo, :email, :password)');
            $req->bindValue(":pseudo", $pseudo, PDO::PARAM_STR);
            $req->bindValue(":email", $email, PDO::PARAM_STR);
            $req->bindValue(":password", $password, PDO::PARAM_STR);
            $req->execute();
            $isCreate = ($req->rowCount() > 0);
            $req->closeCursor();
            return $isCreate;
        }catch (Exception $e) {
            echo throw new Exception('Erreur : ' . $e->getMessage());
        }
    }
}