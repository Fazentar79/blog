<?php

require_once 'Manager.php';
class ArticlesManager extends Manager
{
    /**
     * @throws Exception
     */
    public function getArticles(): PDOStatement
    {
        $db = $this->getDb();
        return $db->query('SELECT * FROM articles ORDER BY id DESC LIMIT 0, 5');
    }

    /**
     * @throws Exception
     */
    public function getNewsArticles($id): bool
    {
        $db = $this->getDb();
        $req = $db->prepare('SELECT id FROM articles WHERE id = ?');
        $req->execute([$id]);
        return $req->rowCount() == 1;
    }

    /**
     * @throws Exception
     */
    public function addArticle($news): bool
    {
        $db = $this->getDb();
        $req = $db->prepare('INSERT INTO articles(content) VALUES (?)');
        return $req->execute([$news]);
    }

    /**
     * @throws Exception
     */
    public function deleteArticle($id): bool
    {
        $db = $this->getDb();
        $req = $db->prepare('DELETE FROM articles WHERE id = ?');
        return $req->execute([$id]);
    }
}