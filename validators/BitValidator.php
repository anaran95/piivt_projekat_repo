<?php
    namespace App\Validators;
    
    use \App\Core\Validator;

    class BitValidator implements Validator {
        //public function __construct() {} //ne mora konstruktor

        public function isValid(string $value): bool {
            return \boolval(\preg_match('/^[01]$/', $value));
        }
    }