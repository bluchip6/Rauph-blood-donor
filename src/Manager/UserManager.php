<?php

namespace App\Manager;

use App\Core\Manager;
use \PDO;

class UserManager extends Manager
{
    /**
     * @param string $email
     * @return mixed
     */
    public function getUser(string $email)
    {
        $stmt = $this->pdo->prepare("
            SELECT *
            FROM user AS u
            WHERE u.email = :email
        ");

        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetch();
    }
}
