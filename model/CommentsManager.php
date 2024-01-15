<?php

require_once 'Manager.php';
class CommentsManager extends Manager
{
    /**
     * @throws Exception
     */
    public function getComments(): PDOStatement
    {
        $db = $this->getDb();
        return $db->query('SELECT * FROM comments ORDER BY id DESC LIMIT 0, 5');
    }

    /**
     * @throws Exception
     */
    public function getUserComment($id): PDOStatement
    {
        $db = $this->getDb();
        $req = $db->prepare('SELECT * FROM comments WHERE id = ?');
        $req->execute([$id]);

        if ($req->rowCount() > 0) {

            return $req;
        } else {
            throw new Exception('Aucun commentaire trouvé !');
        }
    }

    /**
     * @throws Exception
     */

    public function postComment($message): bool
    {
        $db = $this->getDb();
        $req = $db->prepare('INSERT INTO comments(content) VALUES (?)');
        return $req->execute([$message]);
    }
}