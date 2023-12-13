<?php

require_once 'Manager.php';

class UserManager extends Manager
{
    public function getUser()
    {
        $db = $this->connection();
        return $db->query('SELECT * FROM users');
    }
}
