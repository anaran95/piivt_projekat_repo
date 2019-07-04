<?php
    namespace App\Core;

    //klasa specijalizovana za pravljenje ruta u aplikaciji
    //ne moze da se instancira van nje same, pristup rutama (njihovo kreiranje) omogucen je kroz javne (staticke) metode
    //ne moze ni da se nasledi, ponasanje rute je zatvoreno prema spoljasnjem okruzenju i ne moze se menjati
    final class Route {
        private $requestMethod; //koji request metod (GET, POST, ANY,...) je potreban za izvrsenje zahtevane rute
        private $pattern;       //po kom sablonu (regularnom izrazu) se match-uje zahtevana ruta
        private $controller;    //koji kontroler treba pozvati u trenutku kada se zahteva ruta
        private $method;        //koji metod unutar pozvanog kontrolera treba izvrsiti u trenutku kada se zahteva ruta

        //privatni konstruktor - omogucava se da se spolja ne brine o navodjenju request metoda od strane korisnika i eventualnoj gresci
        private function __construct(string $requestMethod, string $pattern, string $controller, string $method) {
            $this->requestMethod = $requestMethod;
            $this->pattern = $pattern;
            $this->controller = $controller;
            $this->method = $method;
        }

        //staticke metode za formiranje razlicitih tipova ruta na osnovu njihovog imena
        //metod za slucaj kada je GET request metod potreban za izvrsenje - npr. ruta ukucana kroz link u browseru
        public static function get(string $pattern, string $controller, string $method): Route {
            return new Route('GET', $pattern, $controller, $method);
        }
        //metod za slucaj kada je POST request metod potreban za izvrsenje - npr. ruta koja vodi na odredjenu stranicu nakon sto se popuni formular
        public static function post(string $pattern, string $controller, string $method): Route {
            return new Route('POST', $pattern, $controller, $method);
        }
        //metod za slucaj kada je ili GET ili POST request metod potreban za izvrsenje
        public static function any(string $pattern, string $controller, string $method): Route {
            return new Route('GET|POST', $pattern, $controller, $method);
        }

        //metod koji proverava da li zahtevana ruta od strane korisnika ili iz spoljasnjeg okruzenja odgovara nekoj od definisanih ruta u aplikaciji
        //ruta mora da odgovara ne samo po imenu rute (url naveden u linku kroz browser), vec i po request metodu!
        public function matches(string $method, string $url): bool {
            // ! VAZNO: ne sme | kao pocetak i kraj regexa jer to ima u GET|POST stringu
            if(!preg_match('/^'. $this->requestMethod .'$/', $method)) {
                return false;
            }
            return \boolval(preg_match($this->pattern, $url));
        }

        //ako se ispostavi da je ruta validna, getterima dopremamo ime kontrolera koji treba napraviti i ime metoda koji u kontroleru treba izvrsiti
        public function getControllerName(): string {
            return $this->controller;
        }

        public function getMethodName(): string {
            return $this->method;
        }

        //metod koji izvlaci uparene grupe argumenata iz url-a (npr. za potrebe brisanja kategorija)
        //radjeno po preporuci sa casa, samo malo izmenjeno
        public function &extractArguments($url): array {
            //polazna pretpostavka je da nema uparenih grupa iz url-a
            $matches = [];
            //u pocetku nema extract-ovanih argumenata iz linka
            $arguments = [];
            //metod koji po reg. izrazu iz url-a uzima uparene grupe (po pravilu uokvirene zagradama)
            preg_match_all($this->pattern, $url, $matches);
            //ako je deo linka nakon 'PIiVT_Projekat/' prazan vraca se prazan niz argumenata
            if(empty($matches[0][0])) { return $arguments; }
            //deo linka nakon 'PIiVT_Projekat/' explode-ujemo oko '/'
            $args[] = explode('/', $matches[0][0]);
            //$args[0] je niz explode-ovanih argumenata, medju kojima ne moraju biti samo integer-i
            //ako medju argumentima postoji nesto sto nije int, to se izbacuje iz niza
            foreach($args[0] as $key => $value) {
                if(!preg_match('|^[0-9]+$|', $value)) {
                    unset($args[0][$key]);
                }
            }
            $arguments = $args[0];
            //resetujemo kljuceve niza 
            //ovde extract-ovani argumenti mogu imati proizvoljno numerisane kljuceve, koji mozda ne krecu od 0
            $argumentsInOrder = [];
            foreach($arguments as $key => $value) {
                $argumentsInOrder[] = $value;
            }
            $arguments = $argumentsInOrder;
            //vracamo uredjen niz argumenata (sada pocinju od 0 i idu redom)
            return $arguments;
        }

    }