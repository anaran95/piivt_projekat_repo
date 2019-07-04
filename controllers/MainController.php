<?php
    namespace App\Controllers;

    //klasa za osnovnu (glavnu) programsku logiku aplikacije
    class MainController extends \App\Core\Controller {
        //funkcija za prikaz homepage <=> views/Main/home.php
        //home (uz pomoc set() metoda) formira asocijativni niz u kome su pod odgovarajucim kljucem kategorije
        public function home() {
            //lista svih kategorija
            $categoryModel = new \App\Models\CategoryModel($this->getDatabaseConnection());
            $categories = $categoryModel->getAllVisible(); //samo one koje NISU sakrivene!
            //ovaj niz se pod istoimenim kljucem asocijativnog niza prosledjuje adekvatnom view-u -> views/Main/home.php, ali preko dispecera index.php
            $this->set('categories', $categories); //metod klase Controller.php koji ima implementiranu proveru ispravnosti kljuca pod kojim se upisuju podaci
            //if(!$categories) {
                //echo "Nema kategorija";
                //exit;
            //}
            
            //TEST ZA VALIDATORE
            /*$antiqueModel = new \App\Models\AntiqueModel($this->getDatabaseConnection());
            $antiqueModel->add([
                'title' => 'Test antikvitet',
                'image_path' =>  'test/putanja/do/slike',
                'detailed_look_description' =>  'Test detaljnog opisa',
                'detailed_material_description' => 'Test opisa materijala',
                'brief_description' => 'Test kratkog opisa',
                'historical_context' => 'Test - istorijski kontekst',
                'country_of_origin_id' => '256',
                'year_of_origin' => '1995',
                'price' => '345.23',
                'adress' => 'Test adresa',
                'administrator_id' => '2'
            ]);*/
            //TEST
            //$staraVrednost = $this->getSession()->get('brojac', 0);
            //$novaVrednost = $staraVrednost + 1;
            //$this->getSession()->put('brojac', $novaVrednost);
            //$this->set('podatak', $novaVrednost);

        }

        public function getLogin() { //samo da bi se napravio view generator

        }

        public function postLogin() { //za obradu podataka iz formulara
            $username = filter_input(INPUT_POST, 'login_username', FILTER_SANITIZE_STRING);
            $password = filter_input(INPUT_POST, 'login_password', FILTER_SANITIZE_STRING);

            //NA OVOM MESTU TREBA KORISTITI STRING VALIDATOR
            $validPassword = true;
            if(strlen($password)<7 || strlen($password)>120) {
                $validPassword = false;
            }

            if(!$validPassword) {
                $this->set('message', 'Došlo je do greške: lozinka nije ispravnog formata.');
                return;
            }

            $administratorModel = new \App\Models\AdministratorModel($this->getDatabaseConnection());
            $admin = $administratorModel->getByFieldName('username', $username);
            if(!$admin) {
                $this->set('message', 'Došlo je do greške: ne postoji korisnik sa tim korisničkim imenom.');
                return;
            }

            if(!password_verify($password, $admin->password_hash)) {
                sleep(1); //da bismo ogranicili potencijalni napad na 1 pokusaj u sekundi - skripta koja proverava sve moguce kombinacije lozinki
                $this->set('message', 'Došlo je do greške: lozinka nije ispravna.');
                return;
            }

            $this->getSession()->put('administrator_id', $admin->administrator_id); //administrator je uspesno ulogovan i ovo je njegov id
            $this->getSession()->save();

            $this->redirect(\Configuration::BASE . 'admin/profile');
        }

        public function getLogout() {
            $this->getSession()->remove('administrator_id'); //administrator je uspesno ulogovan i ovo je njegov id
            $this->getSession()->save();

            $this->redirect(\Configuration::BASE);
        }



    }