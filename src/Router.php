<?php

namespace src;

// Model class -> type Entity
class Router extends Entity
{
    public $id;
    public $module;
    public $action;
    public $entity_id;
    public $pretty_url;

    public function __construct($dbc)
    {
        parent::__construct($dbc, 'routes');
    }

    protected function initFields()
    {
        $this->fields = ['id', 'module', 'action', 'entity_id', 'pretty_url'];
    }
}
