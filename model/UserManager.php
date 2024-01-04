<?php

require_once 'Manager.php';

class UserManager extends Manager
{
    /**
     * @throws Exception
     */
    public function getUserInfo(): PDOStatement
    {
        $db = $this->dbConnect();
        return $db->query('SELECT * FROM user');
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