<?php

namespace src;

class Template
{
    private $layout;

    function __construct($layout)
    {
        $this->layout = $layout;
    }

    function view($template, $variables)
    {
        extract($variables);
        include VIEW_PATH . $this->layout . '.html';
    }
}
