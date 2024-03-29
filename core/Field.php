<?php
    namespace App\Core;

    use \App\Core\Validator;

    final class Field {
        private $validator;
        private $editable;

        public function __construct(Validator $validator, bool $editable = true) { //podrazumevano je editable jer takvih polja ima najvise
            $this->validator = $validator;
            $this->editable = $editable;
        }

        public function isValid(string $value) {
            return $this->validator->isValid($value);
        }

        public function isEditable() {
            return $this->editable;
        }
    }