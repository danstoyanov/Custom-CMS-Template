<?php

namespace modules\page\models;

class Page extends \src\Entity
{
    public $id;
    public $title;
    public $content;

    public function __construct($dbc)
    {
        parent::__construct($dbc, 'pages');
    }

    public function initFields()
    {
        $this->fields = ['id', 'title', 'content'];
    }
}
