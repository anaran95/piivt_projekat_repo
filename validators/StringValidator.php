<?php
    namespace App\Validators;

    use \App\Core\Validator;

    //klasa koja proverava da li je podakat string koji je ispravan, po interno propisanoj konvenciji (pravila validatora)
    class StringValidator implements Validator {
        private $minLength;
        private $maxLength;

        public function __construct() { //konstruktor validatora za stringove setuje podrazumevane vrednosti
            $this->minLength = 0;
            $this->maxLength = 255;
        }
        
        public function &setMinLength(int $length): StringValidator {
            $this->minLength = max(0, $length); //ne moze biti < 0
            return $this;
        }

        public function &setMaxLength(int $length): StringValidator {
            $this->maxLength = max(1, $length); //ne moze biti < 1
            return $this;
        }

        public function isValid(string $value): bool {
            $len = strlen($value);
            return $this->minLength <= $len && $len <= $this->maxLength;

            /*$pattern .= '/^.{'. $this->minLength . ',' . $this->maxLength .'}$/';

            return \boolval(\preg_match($pattern, $value));*/
        }
    }