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
        return $db->query('SELECT * FROM comments ORDER BY id DESC');
    }

    /**
     * @throws Exception
     */
    public function getUserComments($id): bool
    {
        $db = $this->getDb();
        $req = $db->prepare('SELECT id FROM comments WHERE id = ? AND comment_pseudo = ?');
        $req->execute([$id, $_SESSION['pseudo']]);
        return $req->rowCount() == 1;
    }

    /**
     * @throws Exception
     */

    public function postComment($comment_pseudo, $message): bool
    {
        $db = $this->getDb();
        $req = $db->prepare('INSERT INTO comments(comment_pseudo, content) VALUES (?,?)');
        return $req->execute([$comment_pseudo, $message]);
    }

    /**
     * @throws Exception
     */
    public function modifyComment($id, $content_modify): bool
    {
        $db = $this->getDb();
        $req = $db->prepare('UPDATE comments SET content = :contentModify WHERE id = :id');
        return $req->execute([
            'contentModify' => $content_modify,
            'id' => $id
        ]);
    }

    /**
     * @throws Exception
     */
    public function deleteComment($id): bool
    {
        $db = $this->getDb();
        $req = $db->prepare('DELETE FROM comments WHERE id = ?');
        return $req->execute([$id]);
    }
}