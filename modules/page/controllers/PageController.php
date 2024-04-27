<?php

namespace modules\page\controllers;
use src\DatabaseConnection;
use modules\page\models\Page;

class PageController extends \src\Controller
{
    function defaultAction()
    {
        // Database instance
        $dbi = DatabaseConnection::getInstance();
        $dbc = $dbi->getConnection();

        $pageObj = new Page($dbc);
        $pageObj->findBy('id', $this->entityId);
        $variables['pageObj'] = $pageObj;

        $this->template->view('page/views/static-page', $variables);
    }
}
