<?php

use src\Controller;
use src\Validator;
use src\validationRules\ValidateMinimum;
use src\validationRules\ValidateMaximum;
use src\Auth;

class DashboardController extends Controller
{
    function runBeforeAction()
    {
        if ($_SESSION['is_admin'] ?? false == true) {
            return true;
        }

        $action = $_GET['action'] ?? $_POST['action'] ?? 'default';
        if ($action != 'login') {
            header('Location: /admin/index.php?module=dashboard&action=login');
        } else {
            return true;
        }
    }

    function defaultAction()
    {
        $variables = [];
        header('Location: /admin/index.php?module=page');
        exit();
    }

    function loginAction()
    {
        if ($_POST['postAction'] ?? 0 == 1) {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';

            $validator = new Validator();

            // password validation
            if (!$validator
                ->addRule(new ValidateMinimum(3))
                ->addRule(new ValidateMaximum(20))
//                ->addRule(new ValidateNoEmptySpaces())
//                ->addRule(new ValidateCpecialCharacter())
                ->validate($password)) {
                $_SESSION['validationRules']['errors'] = $validator->getAllErrorMessages();
            }

            // username validation
            if (!$validator
                ->addRule(new ValidateMinimum(3))
//                ->addRule(new ValidateEmail())
                ->validate($username)) {
                $_SESSION['validationRules']['errors'] = $validator->getAllErrorMessages();
            }

            // authentication
            if (($_SESSION['validationRules']['error'] ?? '') == '') {
                $auth = new Auth();
                if ($auth->checkLogin($username, $password)) {
                    $_SESSION['is_admin'] = 1;
                    header('Location: /admin/');
                    exit();
                }

                $_SESSION['validationRules']['errors'] = $validator->getAllErrorMessages();
            }
        }

        include VIEW_PATH . 'admin/login.html';
        unset($_SESSION['validationRules']['error']);
    }
}
