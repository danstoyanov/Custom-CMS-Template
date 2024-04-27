<?php

namespace modules\page\admin\controllers;
use modules\page\models\Page;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class  PageController extends \src\Controller
{
    function runBeforeAction()
    {
        if ($_SESSION['is_admin'] ?? false == true) {
            return true;
        }

        $action = $_GET['action'] ?? $_POST['action'] ?? 'default';
        if ($action != 'login') {
            header('Location: /admin/index.php?module=dashboard&action=login');
            exit();
        } else {
            return true;
        }
    }

    function defaultAction()
    {
        $variables = [];

        $pageHandler = new \modules\page\models\Page($this->dbc);
        $pages = $pageHandler->findAll() ;
        $variables['pages'] = $pages;
        $this->template->view('page/admin/views/page-list', $variables);
    }

    function editPageAction()
    {
        $pageId = $_GET['id'];
        $variables = [];

        $page = new Page($this->dbc);
        $page->findBy('id', $pageId);

        if ($_POST['action'] ?? false) {
            $page->setValues($_POST);
            $page->save();

            // create a log channel
            $log = new Logger('name');
            $log->pushHandler(new StreamHandler('pages.log', Logger::WARNING));

            // add records to the log
            $this->log->warning('Admin has changed the page with id:' . $pageId);
        }

        $variables['page'] = $page;
        $this->template->view('page/admin/views/page-edit', $variables);
    }
}
