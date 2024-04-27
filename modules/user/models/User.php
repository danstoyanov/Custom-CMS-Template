<?php

namespace modules\user\models;

class User extends \src\Entity
{
    public function __construct($dbc)
    {
        parent::__construct($dbc, 'users');
    }

    protected function initFields()
    {
        $this->fields = ['id', 'name', 'username', 'password', 'password_hash'];
    }
}