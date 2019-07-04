<?php
    namespace App\Core;

    //Klasa koja cuva inf. o konfiguraciji BP (readonly - spolja ne moze niko menjati parametre)
    class DatabaseConfiguration {
        private $host;
        private $user;
        private $pass;
        private $name; //ime BP

        public function __construct(string $host, string $user, string $pass, string $name) {
            $this->host = $host;
            $this->user = $user;
            $this->pass = $pass;
            $this->name = $name;
        }

        //getter za source parametar PDO objekta
        public function getSourceString(): string {
            return "mysql:host={$this->host};dbname={$this->name};charset=utf8";
        }

        public function getUser(): string {
            return $this->user;
        }

        public function getPass(): string {
            return $this->pass;
        }
    }