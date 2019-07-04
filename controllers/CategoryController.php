<?php
    namespace App\Controllers;

    //klasa za programsku logiku aplikacije koja se tice kategorija u BP
    class CategoryController extends \App\Core\Controller {
        //funkcija za prikaz (za sada) osnovnih informacija o kategoriji <=> views/Category/show.php
        public function show($id) {
            //lista svih kategorija
            $categoryModel = new \App\Models\CategoryModel($this->getDatabaseConnection());
            $category = $categoryModel->getById($id);
            
            //ako dati id ne postoji u bazi pa prema tome ni podaci o toj kategoriji:
            if(!$category) {
                header('Location: /PIiVT_Projekat'); //za sada samo redirekcija na homepage
                exit;
            }

            //ovaj podatak se pod istoimenim kljucem asocijativnog niza prosledjuje adekvatnom view-u -> views/Main/home.php, ali preko dispecera index.php
            $this->set('category', $category); //metod klase Controller.php koji ima implementiranu proveru ispravnosti kljuca pod kojim se upisuju podaci

            //da bi kada kliknemo na kategoriju bili prikazani svi antikviteti koji joj pripadaju:
            //$antiqueModel = new \App\Models\AntiqueModel($this->getDatabaseConnection());
            //$antiquesInCategory = $antiqueModel->getAllByCategoryId($id);
            //$this->set('antiquesInCategory', $antiquesInCategory);

            //$antiqueCategoryModel = new \App\Models\AntiqueCategoryModel($this->getDatabaseConnection());
            //$records = $antiqueCategoryModel->getAllByFieldName('category_id', $id);
            //$antiqueModel = new \App\Models\AntiqueModel($this->getDatabaseConnection());
            
            //$antiquesInCategory = [];
            //foreach($records as $record) {
                //$keys = array_keys($record);
                //$fieldName = $keys[1]; #antique_id
                //$values = array_values($record);
                //$fieldValue = $values[1]; #7 pa 15 pa 9
                //$antiquesInCategory[] = $antiqueModel->getAllByFieldName($fieldName, $fieldValue);
            //}
		
            //$this->set('antiquesInCategory', $antiquesInCategory);

            $antiquesInCategory = []; #sve o datim antikvitetima
            $antiqueIds = [];
            $antiquesInCategoryKeys = $categoryModel->getAntiquesByCategoryId($category->category_id); #antiquesInCategoryKeys
            foreach($antiquesInCategoryKeys as $antiquesInCategoryKey) {
                $antiqueIds[] = $antiquesInCategoryKey->antique_id;
            }
            //$antiqueIds = $antiquesInCategoryKeys->antique_id;
            $antiqueModel = new \App\Models\AntiqueModel($this->getDatabaseConnection());
            //samo oni antikviteti koji NISU sakriveni
            $visibleAntiques = $antiqueModel->getAllVisible(); //svi vidljivi iz svih kategorija
            $visibleAntiquesInCategory = [];
            foreach($antiqueIds as $antiqueId) {
                $antiquesInCategory[] = $antiqueModel->getById($antiqueId);  
            }
            foreach($antiquesInCategory as $antiqueInCategory) {
                if(\in_array($antiqueInCategory, $visibleAntiques)) {
                    $visibleAntiquesInCategory[] = $antiqueInCategory;
                }
            }
            
            usort($visibleAntiquesInCategory, function($a1, $a2){ //RADI ZA SADA ! Prvi su oni sa tacnom godinom, sortirani od najskorijeg do nastarijeg
                return strcmp($a2->year_of_origin, $a1->year_of_origin);
            });
            usort($visibleAntiquesInCategory, function($a1, $a2){ //RADI ZA SADA ! Drugi su oni sa periodom, sortirani po abecedi
               return strcmp($a1->period_of_origin, $a2->period_of_origin); //ABECEDA
            });
            $this->set('antiquesInCategory', $visibleAntiquesInCategory);
            
        }

        public function postAdd() {
            $categoryName = filter_input(INPUT_POST, 'categoryName', FILTER_SANITIZE_STRING); //atribut name="categoryName"
            $data = array("name" => $categoryName);
            $categoryModel = new \App\Models\CategoryModel($this->getDatabaseConnection());
            $categoryModel->add($data);
        }

        public function delete($ids) { //zbog rute, drugaciji ce biti nego na video snimcima
            //print_r($ids); // ?
            die('Nije zavrsena implementacija brisanja. '. gettype($ids) .'');
            //PROVERITI: javlja je gresku da je $ids prosledjen kao string, iako sam bila stavila array kao tip 
        }
    }