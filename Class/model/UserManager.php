<?php

use App\Manager\Manager;

require_once 'Manager.php';

class UserManager extends Manager
{
    /**
     * @throws Exception
     */
    public function getUser(): false|PDOStatement
    {
        $db = $this->connection();
        return $db->query('SELECT * FROM users');
    }
}
