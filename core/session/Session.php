<?php
    namespace App\Core\Session;
    //klasa za upravljanje trenutnom sesijom
    final class Session {
        private $sessionStorage; //koji sessionStorage koristimo
        private $sessionData;    //asoc. niz - privremeni podaci sesije (parovi key-value)
        private $sessionId;
        private $sessionLife;    //kada sesija istice
        private $fingerprintProvider; //fingerprint za zastitu od session hijacking napada

        public function __construct(SessionStorage &$sessionStorage, int $sessionLife = 1800) { //podrazumevano vreme trajanja sesije je 1800 sekundi
            $this->sessionStorage = $sessionStorage;
            $this->sessionData = (object) [];
            $this->sessionLife = $sessionLife;
            $this->fingerprintProvider = null;

            $this->sessionId = filter_input(INPUT_COOKIE, 'APPSESSION', FILTER_SANITIZE_STRING);
            $this->sessionId = \preg_replace('|[^A-Za-z0-9]|', '', $this->sessionId);

            if (strlen($this->sessionId) !== 32) {
                $this->sessionId = $this->generateSessionId();
                \setcookie('APPSESSION', $this->sessionId, time() + $this->sessionLife);
            }
        }

        public function setFingerprintProvider(\App\Core\Fingerprint\FingerprintProvider $fp) {
            $this->fingerprintProvider = $fp;
        }

        private function generateSessionId(): string {
            $supported = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            
            $id = '';
            for ($i=0; $i<32; $i++) {
                $id .= $supported[rand(0, strlen($supported)-1)]; //-1 jer rand uzima i max (inclusive)
            }
    
            return $id;
        }
    
        public function put(string $key, $value) {
            $this->sessionData->$key = $value;
        }

        public function get(string $key, $defaultValue = null) { //dopremamo podatke pod nekim parametrom (kljucem) trenutne sesije
            return $this->sessionData->$key ?? $defaultValue; //ako pod tim kljucem ne postoje podaci vratiti null
        }

        //logout - ne brisemo celu sesiju, vec unutar nje samo id administratora 
        public function remove(string $key) {
            if($this->exists($key)) {
                unset($this->sessionData->$key);
            }
        }

        public function clear() {
            $this->sessionData = (object) [];
        }

        public function exists(string $key): bool { //ako kljuc postoji i ako postoji bilo sta (cak i null) pod tim kljucem sesije
            return isset($this->sessionData->$key);
        }

        public function has(string $key): bool { //ako postoji nesto pod kljucem sesije, a da nije null
            if(!exixts($key)) { //koristimo postojecu f-ju da proverimo da li postoji kljuc ili bilo sta pod tim kljucem
                return false;
            }

            return boolval($this->sessionData->$key); //vraca true ako je pod kljucem bilo sta osim null, tj. ako je kljuc setovan sa put()
        }

        public function save() {
            $fingerprint = $this->fingerprintProvider->provideFingerprint();
            $this->sessionData->__fingerprint = $fingerprint; //pod specijalnim kljucem __fingerprint u asoc. niz sessionData upisujemo fingerprint
            $jsonData = \json_encode($this->sessionData);
            $this->sessionStorage->save($this->sessionId, $jsonData);
            \setcookie('APPSESSION', $this->sessionId, time() + $this->sessionLife); //produzavamo vreme trajanja sesije
        }

        public function reload() {
            $jsonData = $this->sessionStorage->load($this->sessionId);
            $restoredData = \json_decode($jsonData);

            if(!$restoredData) {
                $this->sessionData = (object) [];
                return;
            }

            $this->sessionData = $restoredData;

            if($this->fingerprintProvider === null) {
                return;
            }

            $savedFingerprint = $this->sessionData->__fingerprint ?? null; //ukoliko nemamo fingerprint, podrazumevano je null
            if($savedFingerprint === null) {
                return;
            }

            $currentFingerprint = $this->fingerprintProvider->provideFingerprint();

            if($currentFingerprint !== $savedFingerprint) {
                $this->clear(); //ako je korisniku hijackovana sesija, treba i korisniku i napadacu prekinuti sesiju
                $this->sessionStorage->delete($this->sessionId);
                $this->sessionId = $this->generateSessionId();
                $this->save();
                \setcookie('APPSESSION', $this->sessionId, time() + $this->sessionLife);
            }
        }

        //regenerisanje id-ja sesije - situacija: sadrzaj fajla je premesten u novi fajl, pod novim id-jem, a stari fajl je obrisan
        public function regenerate() {
            $this->reload();
            $this->sessionStorage->delete($this->sessionId);
            $this->sessionId = $this->generateSessionId();
            $this->save();
            \setcookie('APPSESSION', $this->sessionId, time() + $this->sessionLife);
        }
    }