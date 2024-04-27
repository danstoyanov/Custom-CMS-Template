<?php

class ValidateNoEmptySpaces implements ValidationRuleInterface
{
    function validateRule($value)
    {
        if (strpos($value, ' ') === false) {
            return true;
        }

        return false;
    }

    public function getErrorMessage()
    {
        return 'No empty spaces allowed';
    }
}