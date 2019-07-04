<?php
    namespace App\Core\Session;

    class FileSessionStorage implements SessionStorage {
        private $sessionPath;

        public function __construct(string $sessionPath) {
            $this->sessionPath = $sessionPath;
        }

        //sacuvati odredjeni string (podatke o sesiji) pod odredjenim sessionId-jem u odredjeni fajl na odredjenoj putanji
        public function save(string $sessionId, string $sessionData) {
            $sessionFileName = $this->sessionPath . $sessionId . '.json';
            file_put_contents($sessionFileName, $sessionData);
        }
        //ucitati podatke o konkretnoj sesiji
        public function load(string $sessionId): string {
            $sessionFileName = $this->sessionPath . $sessionId . '.json';

            if (!file_exists($sessionFileName)) {
                return '{}'; //string koji vracamo je prazan json objekat, ako takav fajl ne postoji
            }

            return file_get_contents($sessionFileName);
        }

        public function delete(string $sessionId) {
            $sessionFileName = $this->sessionPath . $sessionId . '.json';
            
            if(file_exists($sessionFileName)) {
                unlink($sessionFileName); //f-ja za brisanje fajla
            }
        }

        public function cleanUp(int $sessionAge) {
            // (TODO: IMPLEMENTIRATI)
        }
    }