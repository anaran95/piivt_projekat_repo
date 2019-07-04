<?php
    namespace App\Controllers;

    class ApiAntiqueController extends \App\Core\ApiController {
        public function show($id) {
            //da bi kada kliknemo na kategoriju bili prikazani svi antikviteti koji joj pripadaju:
            $antiqueModel = new \App\Models\AntiqueModel($this->getDatabaseConnection());
            $antique = $antiqueModel->getById($id);

            //ime zemlje ciji id je u tabeli antique
            $countryOfOriginModel = new \App\Models\CountryOfOriginModel($this->getDatabaseConnection());
            $country = $countryOfOriginModel->getById($antique->country_of_origin_id);
            
            $this->set('antique', $antique);
            $this->set('country', $country); //string koji predstavlja ime zemlje i koji se kao takav vidi u view-u
        }
    }