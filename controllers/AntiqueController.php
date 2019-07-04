<?php
    namespace App\Controllers;

    //klasa za programsku logiku aplikacije koja se tice antikviteta u BP
    class AntiqueController extends \App\Core\Controller {
        //funkcija za prikaz (za sada) osnovnih informacija o kategoriji <=> views/Category/show.php
        public function show($id) {
            //da bi kada kliknemo na kategoriju bili prikazani svi antikviteti koji joj pripadaju:
            $antiqueModel = new \App\Models\AntiqueModel($this->getDatabaseConnection());
            $antique = $antiqueModel->getById($id);

            //ako dati id ne postoji u bazi pa prema tome ni podaci o tom antikvitetu:
            //(ovo se moze desiti samo ako se rucno ukuca nepostojeci id)
            if(!$antique) {
                header('Location: /PIiVT_Projekat'); //za sada samo redirekcija na homepage
                exit;
            }

            //ime zemlje ciji id je u tabeli antique
            $countryOfOriginModel = new \App\Models\CountryOfOriginModel($this->getDatabaseConnection());
            $country = $countryOfOriginModel->getById($antique->country_of_origin_id);
            
            $this->set('antique', $antique);
            $this->set('country', $country); //string koji predstavlja ime zemlje i koji se kao takav vidi u view-u
        }

        public function normalizeKeywords(string $keywords): string {
            $keywords = trim($keywords);
            $keywords = \preg_replace('/ +/', ' ', $keywords);
            return $keywords;
        }

        public function postSearch() {
            $antiqueModel = new \App\Models\AntiqueModel($this->getDatabaseConnection());

            $q = filter_input(INPUT_POST, 'q', FILTER_SANITIZE_STRING);

            $keywords = $this->normalizeKeywords($q);

            $antiques = $antiqueModel->getAllVisibleBySearch($keywords);

            $this->set('antiques', $antiques);
        }

        //public function delete($ids) { //zbog rute, drugaciji ce biti nego na video snimcima
            //print_r($ids); // ?
            //die('Nije zavrsena implementacija brisanja. '. gettype($ids) .'');
            //PROVERITI: javlja je gresku da je $ids prosledjen kao string, iako sam bila stavila array kao tip 
        //}
    }