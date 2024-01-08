<?php

require_once 'Manager.php';

class UserManager extends Manager
{
    /**
     * @throws Exception
     */

    public function getUserPseudo($pseudo)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT COUNT(*) AS pseudoNumber FROM user WHERE pseudo = ?');
        $req->execute([$pseudo]);

        while($pseudoDb = $req->fetch()) {
            if ($pseudoDb['pseudoNumber'] != 0) {
                return true;
            }
        }
    }

    /**
     * @throws Exception
     */
    public function getUserPassword($password)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT * FROM user WHERE password = ?');
        $req->execute([$password]);

        while($user = $req->fetch()) {
            if ($user['password'] === $password) {
                return $user;
            }
        }
    }

    /**
     * @throws Exception
     */
    public function getUserEmail($email)
    {
        $db = $this->dbConnect();
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
        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO user(pseudo, email, password) VALUES(?, ?, ?)');
        return $req->execute([$pseudo, $email, $password]);
    }
}