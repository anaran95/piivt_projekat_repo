<?php
    namespace App\Validators;

    use \App\Core\Validator;

    //klasa koja proverava da li je podakat broj koji je ispravan, po interno propisanoj konvenciji (pravila validatora)
    class NumberValidator implements Validator {
        private $isSigned;                //da li je broj oznacen (signed/unsigned)
        private $integerLength;           //koliko ima cifara u celom delu broja
        private $isReal;                  //da li je u pitanju realan broj
        private $maxDecimalDigits;        //koliko maksimalno decimalnih mesta moze da ima

        public function __construct() { //konstruktor validatora za brojeve setuje podrazumevane vrednosti
            $this->isSigned = false;
            $this->isReal = false;
            $this->integerLength = 10;
            $this->maxDecimalDigits = 0;
        }

        public function &setInteger(): NumberValidator {
            $this->isReal = false;
            return $this;
        }

        public function &setDecimal(): NumberValidator {
            $this->isReal = true;
            return $this;
        }

        public function &setSigned(): NumberValidator {
            $this->isSigned = true;
            return $this;
        }

        public function &setUnsigned(): NumberValidator {
            $this->isSigned = false;
            return $this;
        }

        public function &setIntegerLength(int $length): NumberValidator {
            $this->integerLength = max(1, $length);
            return $this;
        }

        public function &setMaxDecimalDigits(int $maxDigits): NumberValidator {
            $this->maxDecimalDigits = max(0, $maxDigits);
            return $this;
        }


        public function isValid(string $value): bool {
            /*$pattern = '/^';
            if($this->isSigned === true) {
                $pattern .= '\-?';
            }
            $pattern .= '[1-9][0-9]{0,'. ($this->integerLength - 1) .'}';
            if($this->isReal === true) {
                $pattern .= '\.[0-9]{0,'. $this->maxDecimalDigits .'}?';
            }
            $pattern .= '$/';

            return \boolval(\preg_match($pattern, $value));*/

            if ($this->isSigned == false) {
                if ($value < 0) {
                    return false;
                }
            }

            if ($this->isReal == false) {
                $value = floatval($value);
                $ostatak = $value % 1.;
                if ($ostatak != 0) {
                    return false;
                }
            }

            $ceoDeo = strval(intval($value));
            if (strlen($ceoDeo) > $this->integerLength) {
                return false;
            }

            $brojStr = strval(floatval($value));
            $deloviBroja = explode('.', $brojStr);
            if (!isset($deloviBroja[1])) {
                return true;
            }

            $decimalniDeo = $deloviBroja[1];
            if (strlen($decimalniDeo) > $this->maxDecimalDigits) {
                return false;
            }

            return true;
        }
    }