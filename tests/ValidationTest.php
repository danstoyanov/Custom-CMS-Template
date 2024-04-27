<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

use src\Validator;
use src\validationRules\ValidateEmail;


//require_once('/Users/danielstoyanov/Documents/php-demo/src/Interfaces/ValidationRuleInterface.php');
//require_once('/Users/danielstoyanov/Documents/php-demo/src/Validator.php');
//require_once('/Users/danielstoyanov/Documents/php-demo/src/validationRules/ValidateEmail.php');

final class ValidationTest extends TestCase
{
    public function testValidationEmail(): void
    {
        $validationClass = new Validator();
        $validationClass->addRule(new ValidateEmail());

        $this->assertFalse($validationClass->validate('testcom'));
        $this->assertTrue($validationClass->validate('test@emai.com'));
    }
}
