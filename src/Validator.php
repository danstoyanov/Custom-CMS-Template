<?php

namespace src;
use src\Interfaces\ValidationRuleInterface;

class Validator
{
    private $rules;
    private $errorMessages = [];

    public function addRule(ValidationRuleInterface $rule)
    {
        $this->rules[] = $rule;
        return $this;
    }

    public function validate($value)
    {
        foreach ($this->rules as $rule) {
            $ruleValidation = $rule->validateRule($value);
            if (!$ruleValidation) {
                $this->errorMessages[] = $rule->gerErrorMessage();
                return false;
            }
        }

        return true;
    }

    public function getAllErrorMessages()
    {
        return $this->errorMessages;
    }
}