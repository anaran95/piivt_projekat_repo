<?php
    namespace App\Core;

    //klasa koja ima ulogu da deo logike koju je obavljao MainController i izmedju ostalog i svi ostali kontroleri prebaci na sebe
    class Controller {
        //objekat konekcije koj se prosledjuje modelima sa kojima kontroleri koji nasledjuju ovaj kontroler 'komuniciraju'
        private $dbc;
        //objekat sesije
        private $session;
        //asocijativni niz podataka koji se dispecerom index.php prosledjuju u odgovarajuci view
        private $data = [];

        //dve donje crte da ne bi mogla da postoji ruta ka njemu, jer su one ogranicene na ispravne nazive metoda, 
        //a ovaj je namerno neispravan - ovde ne radi nista, ali se overrideuje u specijalnim kontrolerima
        public function __pre() {

        }

        //sa 'final' osiguravamo da klase koje nasledjuju ovu klasu (ostali kontroleri) ne mogu da promene ponasanje funkcije
        // tj. funkcija koja se nasledi, a ima rec 'final' u svojoj definiciji, ne moze se override-ovati
        final public function __construct(\App\Core\DatabaseConnection &$dbc) {
            $this->dbc = $dbc;
        }

        //vracanje objekta sesije po referenci - sesija nije neophodna u svakoj aplikaciji
        final public function setSession(\App\Core\Session\Session &$session) {
            $this->session = $session;
        }

        final public function &getSession(): \App\Core\Session\Session {
            return $this->session;
        }

        //vracanje objekta konekcije ka BP, po referenci a ne po kopiji
        //ovaj getter je interfejs ka kontrolerima koji nasledjuju ovaj kontroler i traze objekat konekcije
        final public function &getDatabaseConnection(): \App\Core\DatabaseConnection {
            return $this->dbc;
        }

        //sledecim metodama pokusavamo da sprecimo greske korisnika prilikom formiranja niza podataka za view
        //naredni metod je dostupan samo klasama (kontrolerima) koje nasledjuju ovu klasu
        final protected function set(string $name, $value): bool {
            $result = false;
            //provera da li je regularno (po konvenciji) $name
            if(\preg_match('|^[a-z][a-z0-9]+(?:[A-Z][a-z0-9]+)*$|', $name)) {
                //u slucaju da je $name regularno, pod tim kljucem se u $data upisuje(u) vrednost(i)
                $this->data[$name] = $value;
                $result = true;
            }
            return $result;
        }

        //javni metod za vracanje privatnog niza $data (kroz dispecer index.php koji poziva dati metod) ka odgovarajucem view-u
        final public function getData(): array {
            return $this->data;
        }

        //f-ja za redirekciju nakon logovanja - ako ne radi sa 303 promeniti na 302!
        final protected function redirect(string $path, int $code = 302) { //sa kodom 307 ne radi
            ob_clean();
            header('Location: ' . $path, true, $code); # true, $code
            exit;
        }
    }