<?php
    //ucitavanje globalnog konfiguracionog .php fajla
    require_once 'Configuration.php';
    //Ucitavanje potrebnih koriscenih klasa (kao .php fajlova) koriscenjem autoloading mehanizma
    require_once 'vendor/autoload.php';

    ob_start();

    //trazenje koriscenih klasa u imenskim prostorima
    use App\Core\DatabaseConfiguration;
    use App\Core\DatabaseConnection;
    use App\Core\Router;
    use App\Models\AdministratorModel;
    use App\Models\CategoryModel;
    use App\Controllers\MainController;

    //Povezivanje na BP
    $databaseConfiguration = new DatabaseConfiguration(
        Configuration::DATABASE_HOST,
        Configuration::DATABASE_USER,
        Configuration::DATABASE_PASS,
        Configuration::DATABASE_NAME
    );
    $databaseConnection = new DatabaseConnection($databaseConfiguration);

    //koriscenje rewriting mehanizma - parametri potrebni za rutiranje u aplikaciji
    $url = strval(filter_input(INPUT_GET, 'URL')); //da ne bi izbacio gresku ako je $url === null !
    $httpMethod = filter_input(INPUT_SERVER, 'REQUEST_METHOD');

    //Izvrsavanje upita nad BP kroz odgovarajuce modele posredstvom kontrolera - dopremanje podataka za odgovarajuci view

    //Rutiranje
    $router = new Router();
    //dodavanje ruta - indirektno preko fajla Routes.php
    $routes = require_once 'Routes.php';
    foreach($routes as $route) {
        $router->add($route);
    }
    //pronalazenje zahtevane rute medju dodatim
    $route = $router->find($httpMethod, $url);
    $arguments = $route->extractArguments($url);
    //odredjuje se dinamicki koji je kontroler u pitanju i koji metod unutar kontrolera se poziva
    $fullControllerName ='\\App\\Controllers\\' . $route->getControllerName() . 'Controller';
    $controller = new $fullControllerName($databaseConnection);

    //zastita od hijacking napada - fingerprint
    $fingerprintProviderFactoryClass = Configuration::FINGERPRINT_PROVIDER_FACORY;
    $fingerprintProviderFactoryMethod = Configuration::FINGERPRINT_PROVIDER_METHOD;
    $fingerprintProviderFactoryArgs = Configuration::FINGERPRINT_PROVIDER_ARGS;
    $fingerprintProviderFactory = new $fingerprintProviderFactoryClass;
    $fingerprintProvider = $fingerprintProviderFactory->$fingerprintProviderFactoryMethod(...$fingerprintProviderFactoryArgs);  //'...' znace "raspakivanje argumenata": uzeti sve stringove iz niza argumenata koliko god ih ima i proslediti ih kao argumente ovog objekta u njegov konstruktor

    //pre nego sto izvrsimo metod odgovarajuceg konrolera, proveravamo ima li potrebe da se od ovog trenutka radi sa sesijama(sesijom)
    $sessionStorageClassName = Configuration::SESSION_STORAGE;
    $sessionStorageConstructorArguments = Configuration::SESSION_STORAGE_DATA;
    $sessionStorage = new $sessionStorageClassName(...$sessionStorageConstructorArguments); //'...' znace "raspakivanje argumenata": uzeti sve stringove iz niza argumenata (SESSION_STORAGE_DATA) koliko god ih ima i proslediti ih kao argumente ovog objekta u njegov konstruktor
    $session = new \App\Core\Session\Session($sessionStorage, Configuration::SESSION_LIFETIME);
    $session->setFingerprintProvider($fingerprintProvider);

    //$session->reload();

    $controller->setSession($session);
    $controller->getSession()->reload();

    //pre izvrsavanja odgovarajuceg metoda, proveravamo da li onaj ko pokusava da dodje rucno do admin panela ima ulogu administratora
    //tj da li je to njegova sesija
    $controller->__pre();
    call_user_func_array([$controller, $route->getMethodName()], $arguments);
    //cuvamo sesiju -TEST:
    $controller->getSession()->save(); //trenutno SVI kontroleri u aplikaciji koriste sesiju
    
    //instanca $controller ima pristup sada popunjenom nizu $data koji se doprema sa getData() - metod koji je $controller nasledio iz Controller.php
    $data = $controller->getData();
    //STARI PRISTUP GENERISANJA ODGOVARAJUCEG VIEW-a - RUCNO
    //foreach($data as $name => $value) { 
        //pravimo novi niz cije ime je kljuc asocijativnog niza $data i cije su vrednosti dodavane kroz foreach petlju, iz vrednosti kljuca niza $data
        // => ustvari izvlacimo vrednosti iz kljuca asoc. niza $data i ubacujemo ih u neki novi niz koji ce odgovarajuci view da iskoristi
        //$$name = $value;
    //}
    //zahtevamo odgovarajuci view koji 'vidi' novoformiran niz - u ovom trenutku svi podaci za view su spremni
    //require_once('views/'. $route->getControllerName() .'/'. $route->getMethodName() .'.php');


    # Zahteve upucene za API, da ne idu na Twig:
    //OVO NIJE DO KRAJA IMPLEMENTIRANO (ASINHRONI POZIVI)
    /*if ($controller instanceof \App\Core\ApiController) {
        ob_clean();
        header('Content-type: application/json; charset=utf-8'); //kog sadrzaja je odgovor servera na zahtev upucen iz browsera
        header('Access-Control-Allow-Origin: *'); //dozvoliti da sa bilo kog izvora stigne zahtev
        echo json_encode($data);
        exit;
    }*/


    //NOVI PRISTUP GENERISANJA ODGOVARAJUCEG VIEW-a - TWIG TEMPLATING ENGINE
    //Twig Filesystem Loader - omogucava da kazemo sa koje putanje treba ucitavati nase view-generatore
    $loader = new Twig_Loader_Filesystem("./views");
    //Twig Renderer koji generise view-ove
    //POSLE RAZVOJA APLIKACIJE SKINUTI auto_reload KOJIM SE ZAOBILAZI twig-cache, ILI GA POSTAVITI NA false
    $twig = new Twig_Environment($loader, [
        "cache" => "./twig-cache",
        "auto_reload" => true
    ]);

    $data['BASE'] = Configuration::BASE; //posebna konstanta dodata u asoc. niz $data (Deo apsolutne putanje projekta)
    //html kod (view) koji se generise uz pomoc $twig objekta
    //prvi argument predstavlja odgovarajuci view sa .html ekstenzijom
    //drugi argument je niz podataka koji treba proslediti za prikaz u odgovorajuci view - view ce prepoznati podatke pod odgovarajucim kljucem
    $html = $twig->render(
        $route->getControllerName() .'/'. $route->getMethodName() . '.html',
        $data
    );
    //prikazujemo generisani html
    echo $html;


