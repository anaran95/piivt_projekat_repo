<?php
    namespace App\Core\Role;

    class AdministratorRoleController extends \App\Core\Controller {
        //da li postoji ulogovani korisnik sa rolom administrator
        public function __pre() {
            //ako ne postoji ovo polje u TRENUTNOJ sesiji (sesiju imaju i obicni posetioci i admini), get vraca null sve do $userId
            $userId = $this->getSession()->get('administrator_id');

            if($userId === null) {
                $this->redirect(\Configuration::BASE . 'admin/login');
            }
        }
    }