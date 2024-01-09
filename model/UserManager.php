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
        $req = $db->prepare('SELECT * FROM user WHERE pseudo = ?');
        $req->execute([$pseudo]);

        return $req->fetch();
    }

    /**
     * @throws Exception
     */
    public function getUserPassword($pseudo)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT password FROM user WHERE pseudo = :pseudo');
        $req->bindValue(':pseudo', $pseudo, PDO::PARAM_STR);
        $req->execute();
        $result = $req->fetch(PDO::FETCH_ASSOC);
        return $result['password'];
    }

    /**
     * @throws Exception
     */
    public function isCombinationPassword($pseudo, $password): bool
    {
        $passwordDb = $this->getUserPassword($pseudo);
        return password_verify($password, $passwordDb);
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