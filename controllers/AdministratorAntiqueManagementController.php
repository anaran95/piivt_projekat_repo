<?php
    namespace App\Controllers;

    class AdministratorAntiqueManagementController extends \App\Core\Role\AdministratorRoleController {
        //prikaz (za admina) koji svi antikviteti postoje u sistemu
        public function antiques() {
            $antiqueModel = new \App\Models\AntiqueModel($this->getDatabaseConnection());
            $antiques = $antiqueModel->getAll(); //naznaciti koji su "sakriveni" - dugme za "OMOGUCI"
            //ovaj niz se pod istoimenim kljucem asocijativnog niza prosledjuje adekvatnom view-u -> views/Main/home.php, ali preko dispecera index.php
            $this->set('antiques', $antiques); //metod klase Controller.php koji ima implementiranu proveru ispravnosti kljuca pod kojim se upisuju podaci
        }

        //metode za izmenu postojeceg antikviteta:
        //1. prikaz forme za konkretan antivitet
        public function getEdit($antiqueId) {
            $antiqueModel = new \App\Models\AntiqueModel($this->getDatabaseConnection());
            $antique = $antiqueModel->getById($antiqueId);
            if(!$antique) {
                $this->redirect(\Configuration::BASE . 'admin/antiques');
                return;
            }
            $this->set('antique', $antique);

            $countryOfOriginModel = new \App\Models\CountryOfOriginModel($this->getDatabaseConnection());
            //$countryOfOriginData = $countryOfOriginModel->getById($antique['country_of_origin_id']);
            //$countryOfOriginId = $countryOfOriginData['country_of_origin_id'];
            //if(!$countryOfOriginId) {
                //$this->redirect(\Configuration::BASE . 'admin/antiques');
                //return;
            //}
            //$this->set('country_of_origin_id', $countryOfOriginId);

            $countries = $countryOfOriginModel->getAll();
            if(!$countries) {
                $this->redirect(\Configuration::BASE . 'admin/antiques');
                return;
            }
            $this->set('countries', $countries);

            $antiqueCategories = $antiqueModel->getCategoriesByAntiqueId($antiqueId);
            if(!$antiqueCategories) {
                $this->redirect(\Configuration::BASE . 'admin/antiques');
                return;
            }
            //print_r($antiqueCategories);
            //die();
            $this->set('antiqueCategories', $antiqueCategories);

            $categoryModel = new \App\Models\CategoryModel($this->getDatabaseConnection());
            $categoriesData = $categoryModel->getAll();
            //print_r($categoriesData);
            //die();
            //$categories = $categoriesData['category_id'];
            $this->set('categories', $categoriesData);
        }

        //2.nakon slanja kroz formular
        public function postEdit($antiqueId) {
            $this->getEdit($antiqueId); //sluzi samo da se proveri da li taj antikvitet postoji i vraca model
            
            //$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
            //ovde pokupimo SVE iz forme

            $editDataForAntique = [
                'title'                         => \filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING),
                //'image_path'                    => \filter_input(INPUT_POST, 'image_path', FILTER_SANITIZE_STRING),
                'image_path'                    => 'id'. $antiqueId. '.jpg',
                //'image_path'                    => ''. (\Configuration::BASE) . 'assets/uploads/id'. $antiqueId . '.jpg',
                'detailed_look_description'     => \filter_input(INPUT_POST, 'detailed_look_description', FILTER_SANITIZE_STRING),
                'detailed_material_description' => \filter_input(INPUT_POST, 'detailed_material_description', FILTER_SANITIZE_STRING),
                'brief_description'             => \filter_input(INPUT_POST, 'brief_description', FILTER_SANITIZE_STRING),
                'historical_context'            => \filter_input(INPUT_POST, 'historical_context', FILTER_SANITIZE_STRING),
                'country_of_origin_id'          => \filter_input(INPUT_POST, 'country_of_origin_id', FILTER_SANITIZE_NUMBER_INT),
                'period_of_origin'              => \filter_input(INPUT_POST, 'period_of_origin', FILTER_SANITIZE_STRING),
                'year_of_origin'                => \filter_input(INPUT_POST, 'year_of_origin', FILTER_SANITIZE_NUMBER_INT),
                'price'                         => sprintf("%.2f", \filter_input(INPUT_POST, 'price', FILTER_SANITIZE_STRING)),//, FILTER_FLAG_ALLOW_FRACTION
                'adress'                        => \filter_input(INPUT_POST, 'adress', FILTER_SANITIZE_STRING),
                'administrator_id'              => $this->getSession()->get('administrator_id')
            ];

            $categoryIds = $_POST['kategorije'];
            //print_r($categoryIds);
            //die();

            $antiqueModel = new \App\Models\AntiqueModel($this->getDatabaseConnection());
            $res = $antiqueModel->editById($antiqueId, $editDataForAntique);

            if(!$res) {
                $this->set('message', 'Nije bilo moguće izmeniti dati antikvitet.');
                return;
            }

            $categoryModel = new \App\Models\CategoryModel($this->getDatabaseConnection(), true);
            foreach($categoryIds as $categoryId) {
                $data = ['category_id' => $categoryId];
                $updatedAntiqueCategoryRecord = $categoryModel->editById($antiqueId, $data);
                if(!$updatedAntiqueCategoryRecord) {
                    $this->set('message', 'Došlo je do greške pri izmeni kategorija za antikvitet.');
                    return;
                }
            }
            
            $uploadStatus = $this->doImageUpload('image_path', 'id' . $antiqueId);
            if(!$uploadStatus) {
                //$this->set('message', 'Antikvitet je izmenjen, ali je došlo do greške prilikom dodavanja slike.');
                return;          
            }

            $this->redirect(\Configuration::BASE . 'admin/antiques');
        }

        //metode za dodavanje novog antikviteta
        //1. prikaz forme
        public function getAdd() { 
            //NAPOMENA: treba da dopremi VIDLJIVE(NESAKRIVENE) kategorije, kako bi admin mogao da odabere BAR jednu postojecu
            $categoryModel = new \App\Models\CategoryModel($this->getDatabaseConnection());
            $visibleCategories = $categoryModel->getAllVisible();
            $this->set('categories', $visibleCategories);
            //NAPOMENA: treba da dopremi i sve drzave da bi admin mogao da bira jednu
            $countryOfOriginModel = new \App\Models\CountryOfOriginModel($this->getDatabaseConnection());
            $countries = $countryOfOriginModel->getAll();
            $this->set('countries', $countries);
        }
        //2.nakon slanja kroz formular
        public function postAdd() {
            //$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
            //ovde pokupimo SVE iz forme

            //$price = sprintf("%.2f", \filter_input(INPUT_POST, 'price', FILTER_SANITIZE_STRING));
            //if($price == 0) {
                //$price = null;
            //}

            $addDataForAntique = [
                'title'                         => \filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING),
                //'image_path'                    => \filter_input(INPUT_POST, 'image_path', FILTER_SANITIZE_STRING),
                //'image_path'                    => ''. (\Configuration::BASE) . 'assets/uploads/id'. $antiqueId . '.jpg',
                'image_path'                    => 'id'. $antiqueId. '.jpg',
                'detailed_look_description'     => \filter_input(INPUT_POST, 'detailed_look_description', FILTER_SANITIZE_STRING),
                'detailed_material_description' => \filter_input(INPUT_POST, 'detailed_material_description', FILTER_SANITIZE_STRING),
                'brief_description'             => \filter_input(INPUT_POST, 'brief_description', FILTER_SANITIZE_STRING),
                'historical_context'            => \filter_input(INPUT_POST, 'historical_context', FILTER_SANITIZE_STRING),
                'country_of_origin_id'          => \filter_input(INPUT_POST, 'country_of_origin_id', FILTER_SANITIZE_NUMBER_INT),
                'period_of_origin'              => \filter_input(INPUT_POST, 'period_of_origin', FILTER_SANITIZE_STRING),
                'year_of_origin'                => \filter_input(INPUT_POST, 'year_of_origin', FILTER_SANITIZE_NUMBER_INT),
                'price'                         => sprintf("%.2f", \filter_input(INPUT_POST, 'price', FILTER_SANITIZE_STRING)),//, FILTER_FLAG_ALLOW_FRACTION
                'adress'                        => \filter_input(INPUT_POST, 'adress', FILTER_SANITIZE_STRING),
                'administrator_id'              => $this->getSession()->get('administrator_id')
            ];

            
            $categoryIds = $_POST['kategorije'];
            //print_r($categoryIds);
            //die();

            $antiqueModel = new \App\Models\AntiqueModel($this->getDatabaseConnection());
            $antiqueId = $antiqueModel->add($addDataForAntique);

            if(!$antiqueId || !$categoryIds) {
                $this->set('message', 'Došlo je do greške prilikom dodavanja kategorija.');
            }

            $uploadStatus = $this->doImageUpload('image_path', 'id' . $antiqueId);
            if(!$uploadStatus) {
                //$this->set('message', 'Antikvitet je dodat, ali je došlo do greške prilikom dodavanja slike.');
                return;          
            }
            
            $insertedCategoryIds = [];
            $categoryModel = new \App\Models\CategoryModel($this->getDatabaseConnection(), true);
            foreach($categoryIds as $categoryId){
                $data = [
                    'antique_id' => $antiqueId,
                    'category_id' => $categoryId
                ];
                $insertedCategoryId = $categoryModel->add($data);
                if(!$insertedCategoryId) {
                    $this->set('message', 'Došlo je do greške prilikom dodavanja kategorija.');
                }
                $insertedCategoryIds[] = $insertedCategoryId;
            }
            if(count($insertedCategoryIds) != count($categoryIds)) {
                $this->set('message', 'Došlo je do greške prilikom dodavanja kategorija.');
            }
            
            
            if($antiqueId && $categoryIds) {
                $this->redirect(\Configuration::BASE . 'admin/antiques');
            }
            $this->set('message', 'Došlo je do greške: Nije moguće dodati ovaj antikvitet.');
            
            
        }


        private function doImageUpload(string $fieldName, string $fileName): bool {
            unlink(\Configuration::UPLOAD_DIR . $fileName . '.jpg'); //videti da li radi sa '.jpg'
            $uploadPath = new \Upload\Storage\FileSystem(\Configuration::UPLOAD_DIR);
            $file = new \Upload\File($fieldName, $uploadPath);
            $file->setName($fileName);
            $file->addValidations([
                new \Upload\Validation\Mimetype("image/jpeg"),
                new \Upload\Validation\Size("3M")
                //new \Upload\Validation\Dimentions(320, 240)
            ]);

            try {
                $file->upload();   
                return true;         
            } catch (Exception $e) {
                $this->set('message', 'Greška: ' .  impolde(', ', $file->getErrors()));
                return false;
            }


        }
    }