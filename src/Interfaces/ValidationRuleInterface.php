<?php

namespace src\Interfaces;

interface ValidationRuleInterface
{
    public function validateRule($value);

    public function getErrorMessage();
}