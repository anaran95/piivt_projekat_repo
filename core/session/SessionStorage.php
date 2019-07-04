<?php
    namespace App\Core\Session;
    //interfejs koji propisuje metode koje svaki tip session storage-a mora implementirati (database, file, ...)
    //realizuje kreiranje sesije ulogovanog korisnika (administrator)
    interface SessionStorage {
        public function save(string $sessionId, string $sessionData); //cuvanje sesije
        public function load(string $sessionId): string;              //ucitavanje sesije; vraca podatke o sesiji u obliku stringa
        public function delete(string $sessionId);                    //brisanje sesije
        public function cleanUp(int $sessionAge);                     //periodicno brisanje sesija starijih od nekog datuma ($sessionAge je broj sekundi protekao od pocetka kreiranja/koriscenja sesije)
    }