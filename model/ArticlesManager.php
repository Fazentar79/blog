<?php

require_once 'Manager.php';
class ArticlesManager extends Manager
{
    /**
     * @throws Exception
     */
    public function getArticles(): PDOStatement
    {
        return $this->getDb()->query('SELECT * FROM articles ORDER BY id DESC LIMIT 0, 5');
    }

    /**
     * @throws Exception
     */
    public function getNewsArticles($id): bool
    {
        $db = $this->getDb();
        $req = $db->prepare('SELECT id FROM articles WHERE id = ?');
        $req->execute([$id]);
        return $req->rowCount() === 1;
    }

    /**
     * @throws Exception
     */
    public function addArticle($news): bool
    {
        $db = $this->getDb();
        return $db->prepare('INSERT INTO articles(content) VALUES (?)')->execute([$news]);
    }

    /**
     * @throws Exception
     */
    public function modifyArticle($id, $content_modify): bool
    {
        $db = $this->getDb();
        $req = $db->prepare('UPDATE articles SET content = :contentModify WHERE id = :id');
        return $req->execute([
            'contentModify' => $content_modify,
            'id' => $id
        ]);
    }

    /**
     * @throws Exception
     */
    public function deleteArticle($id): bool
    {
        $db = $this->getDb();
        return $db->prepare('DELETE FROM articles WHERE id = ?')->execute([$id]);
    }
}
