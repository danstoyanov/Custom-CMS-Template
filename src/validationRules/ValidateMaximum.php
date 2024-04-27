<?php

namespace src\validationRules;
use src\Interfaces\ValidationRuleInterface;

class ValidateMaximum implements ValidationRuleInterface
{
    private $maximum;

    public function __construct($maximum){
        $this->maximum = $maximum;
    }

    function validateRule($value)
    {
        if (strlen($value) > $this->maximum) {
            return false;
        }

        return true;
    }

    public function getErrorMessage()
    {
        return 'Maximum value is over' . $this->maximum;
    }
}