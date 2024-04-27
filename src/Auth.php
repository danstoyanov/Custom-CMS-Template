<?php

namespace src;
use modules\user\models\User;

class Auth
{
    function checkLogin($username, $password)
    {
        $dbh = DatabaseConnection::getInstance();
        $dbc = $dbh->getConnection();

        $userObj = new User($dbc);
        $userObj->findBy('username', $username);

        if (property_exists($userObj, 'id')) {
               if (password_verify($password, $userObj->password)) {
                return true;
            }
        }
    }

    function changeUserPassword($userObj, $newPassword)
    {
        $userObj->password = password_hash($newPassword, PASSWORD_DEFAULT);
        return $userObj;
    }
}