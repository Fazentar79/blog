<?php

require_once 'Manager.php';

class UserManager extends Manager
{
    /**
     * @throws Exception
     */
    public function getUserAdmin($pseudo)
    {
        $db = $this->getDb();
        $req = $db->prepare('SELECT role FROM user WHERE pseudo = :pseudo');
        $req->bindValue(':pseudo', $pseudo);
        $req->execute();

        if ($req->rowCount() == 1) {
            $roleDb = $req->fetch();
            return $roleDb['role'];
        }
    }

    /**
     * @throws Exception
     */

    public function getUserPseudo()
    {
        $db = $this->getDb();
        $req = $db->prepare('SELECT pseudo FROM user WHERE pseudo = ?');
        $req->execute(['pseudo']);

        if ($req->rowCount() > 0) {
            $pseudoDb = $req->fetch();
            return $pseudoDb['pseudo'];
        }
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

        if ($req->rowCount() > 0) {
            $passwordDb = $req->fetch();
            if (password_verify($_POST['password'], $passwordDb['password'])) {
                return $passwordDb['password'];
            }
        }
    }

    /**
     * @throws Exception
     */
    public function getUserEmail($pseudo)
    {
        $db = $this->getDb();
        $req = $db->prepare('SELECT email FROM user WHERE pseudo = :pseudo');
        $req->bindValue(':pseudo', $pseudo);
        $req->execute();

        if ($req->rowCount() > 0) {
            $emailDb = $req->fetch();
            return $emailDb['email'];
        }
    }

    /**
     * @throws Exception
     */
    public function getCheckUserEmail($email)
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

    /**
     * @throws Exception
     */
    public function deleteUser($pseudo): bool
    {
        $db = $this->getDb();
        $req = $db->prepare('DELETE FROM user WHERE pseudo = ?');
        return $req->execute([$pseudo]);
    }
}