<?php
    namespace App\Models;
    use App\Core\Model; //pronalazimo lokaciju koriscenih klasa - 'use' za slozenije putanje

    //Klasa interfejs ka tabeli administrator u BP
    class AdministratorModel extends Model {

        //metod koji vraca podatke o adminu cije je korisnicko ime zahtevano spolja
        //u core/Model.php se saznaje konkretno ime tabele
        public function getByUsername(string $username) {
            return $this->getByFieldName('username', $username); //ime polja u upitu, vrednost polja u execute()
        }
    } 