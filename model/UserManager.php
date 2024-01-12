<?php

require_once 'Manager.php';

class UserManager extends Manager
{
    /**
     * @throws Exception
     */

    public function getUser()
    {
        $db = $this->getDb();
        $req = $db->prepare('SELECT * FROM user');
        $req->execute();
        return $req->fetch();
    }

    /**
     * @throws Exception
     */
    public function getUserPassword($pseudo)
    {
        $db = $this->getDb();
        $req = $db->prepare('SELECT password FROM user WHERE pseudo = :pseudo');
        $req->bindValue(':pseudo', $pseudo);
        $req->execute();
        $result = $req->fetch();
        $req->closeCursor();
        return $result['password'];
    }

    /**
     * @throws Exception
     */
    public function isPasswordValid($pseudo, $password): bool
    {
        $validPassword = $this->getUserPassword($pseudo);
        return password_verify($password, $validPassword);
    }

    /**
     * @throws Exception
     */
    public function getUserEmail($email)
    {
        $db = $this->getDb();
        $req = $db->prepare('SELECT COUNT(*) AS emailNumber FROM user WHERE email = ?');
        $req->execute([$email]);

        while($emailDb = $req->fetch()) {
            if ($emailDb['emailNumber'] != 0) {
                return true;
            }
        }
    }

    /**
     * @throws Exception
     */

    public function addUser($pseudo, $email, $password): bool
    {
        $db = $this->getDb();
        $req = $db->prepare('INSERT INTO user(pseudo, email, password) VALUES(?, ?, ?)');
        return $req->execute([$pseudo, $email, $password]);
    }
}