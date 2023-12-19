<?php

namespace App\UserManager;

use Exception;
use App\Manager;
use PDOStatement;

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
