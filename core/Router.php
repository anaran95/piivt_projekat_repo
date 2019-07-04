<?php
    namespace App\Core;

    //klasa koja sadrzi spisak svih ruta u aplikaciji
    //ni njeno ponasanje spolja ne moze da se menja
    final class Router {
        private $routes = [];

        public function __construct() { }

        //metod za dodavanje nove rute u aplikaciju
        public function add(Route $route) {
            $this->routes[] = $route;
        }

        //ideja je da Router prodje kroz sve postojece rute u aplikaciji 
        //i da vrati prvu postojecu rutu koja se slaze sa spolja zahtevanom rutom
        public function &find(string $method, $url): Route {
            //PITATI ZA OVAJ DEO
            //if($url === null) { //dodala ja, i obrisala sam typehint za $url, jer inace se buni ako u url-u u browseru ne navedem nista posle 'PIiVT_Projekat/'
               //$url = '';
            //}
            foreach($this->routes as $route) {
                if($route->matches($method, $url)) {
                    return $route;
                }
            }
            //ako nismo pronasli zahtevanu rutu medju postojecim rutama u aplikaciji
            return null;
        }

    }