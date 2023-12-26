<?php

require_once 'Manager.php';

class UserManager extends Manager
{
    /**
     * @throws Exception
     */
    public function addUser($pseudo, $email, $password): bool
    {
        $db = $this->dbConnect();
        $req = $db->prepare('INSERT INTO user(pseudo, email, password) VALUES(?, ?, ?)');
        return $req->execute(array($pseudo, $email, $password));
    }

    /**
     * @throws Exception
     */
    public function getUser($pseudo, $password, $email)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, pseudo, email, password FROM user WHERE pseudo = ?');
        $req->execute(array($pseudo, $password, $email));
        return $req->fetch();
    }
}