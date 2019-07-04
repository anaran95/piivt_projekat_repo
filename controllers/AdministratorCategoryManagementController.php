<?php
    namespace App\Controllers;

    class AdministratorCategoryManagementController extends \App\Core\Role\AdministratorRoleController {
        //prikaz (za admina) koje sve kategorije postoje u sistemu
        public function categories() {
            $categoryModel = new \App\Models\CategoryModel($this->getDatabaseConnection());
            $categories = $categoryModel->getAll(); //naznaciti koje su "sakrivene" - dugme za "OMOGUCI"
            //ovaj niz se pod istoimenim kljucem asocijativnog niza prosledjuje adekvatnom view-u -> views/Main/home.php, ali preko dispecera index.php
            $this->set('categories', $categories); //metod klase Controller.php koji ima implementiranu proveru ispravnosti kljuca pod kojim se upisuju podaci
        }

        //metode za izmenu postojece kategorije:
        //1. prikaz forme za konkretnu kategoriju
        public function getEdit($categoryId) {
            $categoryModel = new \App\Models\CategoryModel($this->getDatabaseConnection());
            $category = $categoryModel->getById($categoryId);

            if(!$category) {
                $this->redirect(\Configuration::BASE . 'admin/categories');
            }

            $this->set('category', $category);
            return $categoryModel; //treba nam za postEdit()
        }
        //2.nakon slanja kroz formular
        public function postEdit($categoryId) {
            $categoryModel = $this->getEdit($categoryId); //sluzi samo da se proveri da li ta kategorija postoji i vraca model
            
            $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);

            $categoryModel->editById($categoryId, [
                'name' => $name,
                'administrator_id' => (int)$this->getSession()->get('administrator_id')
            ]);
            
            $this->redirect(\Configuration::BASE . 'admin/categories');
        }

        //metode za dodavanje nove kategorije
        //1. prikaz forme
        public function getAdd() {

        }
        //2.nakon slanja kroz formular
        public function postAdd() {
            $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
            $categoryModel = new \App\Models\CategoryModel($this->getDatabaseConnection());
            $categoryId = $categoryModel->add([
                'name' => $name,
                'administrator_id' => (int)$this->getSession()->get('administrator_id')
            ]);
            if($categoryId) {
                $this->redirect(\Configuration::BASE . 'admin/categories');
            }
            //ako ne redirect-uje
            $this->set('message', 'Došlo je do greške: Nije moguće dodati ovu kategoriju.');
        }

    }