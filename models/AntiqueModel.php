<?php
    namespace App\Models;
    use App\Core\Model; //pronalazimo lokaciju koriscenih klasa - 'use' za slozenije putanje
    use App\Core\Field;
    use App\Validators\NumberValidator;
    use App\Validators\DateTimeValidator;
    use App\Validators\StringValidator;
    use App\Validators\BitValidator;

    //Klasa interfejs ka tabeli antique u BP
    class AntiqueModel extends Model {

        public function getCategoriesByAntiqueId($id): array {
            return $this-> getAllByFieldNameMtoN('antique_id', $id); 
        }

        protected function getFields(): array { //U AntiqueController.php pravimo AntiqueModel.php -> add i navodimo specificna polja
            return [
                'antique_id' => new Field((new NumberValidator())->setIntegerLength(10), false),
                'created_at' => new Field((new DateTimeValidator())->allowDate()->allowTime(), false),
                'title' => new Field((new StringValidator())->setMaxLength(255)),
                'image_path' =>  new Field((new StringValidator())->setMaxLength(255)),
                'detailed_look_description' =>  new Field((new StringValidator())->setMaxLength(64*1024)),
                'detailed_material_description' => new Field((new StringValidator())->setMaxLength(64*1024)),
                'brief_description' => new Field((new StringValidator())->setMaxLength(64*1024)),
                'historical_context' => new Field((new StringValidator())->setMaxLength(64*1024)),
                'country_of_origin_id' =>new Field((new NumberValidator())->setIntegerLength(10)),
                'period_of_origin' => new Field((new StringValidator())->setMaxLength(64*1024)),
                'year_of_origin' => new Field((new NumberValidator())->setIntegerLength(4)),
                'price' => new Field((new NumberValidator())->setDecimal()
                                                            ->setUnsigned()
                                                            ->setIntegerLength(10)
                                                            ->setMaxDecimalDigits(2)),
                'adress' => new Field((new StringValidator())->setMaxLength(64*1024)),
                'is_deleted' => new Field( new BitValidator() ),
                'administrator_id' => new Field((new NumberValidator())->setIntegerLength(10))//administrator_id ce kasnije biti automatski (iz trenutne sesije!)
            ];
        }

        public function getAllVisibleBySearch(string $keywords) {
            $sql = 'SELECT * FROM `antique` WHERE `is_deleted` = ? AND (`title` LIKE ? OR `brief_description` LIKE ? OR `detailed_look_description` LIKE ? OR `detailed_material_description` LIKE ?)';

            $keywords = '%' . $keywords . '%';

            $prep = $this->getConnection()->prepare($sql);
            if(!$prep) {
                return [];
            }

            $res = $prep->execute([0, $keywords, $keywords, $keywords, $keywords]);
            if(!$res) {
                return [];
            }

            return $prep->fetchAll(\PDO::FETCH_OBJ);
        }
        //metod koji vraca spisak svih antikviteta koji pripadaju odredjenoj kategoriji
        //NAPOMENA: vezna tabela, INNER JOIN!
        //Ovde ne moze getAllByFieldName() iz core/Model.php, jer je upit drugaciji i relacija je M:N !!!
        //Mozda treba napraviti specijalnu f-ju za ovo u core/Model.php
        //NAMPOMENA: INICIJALNO, ANTIKVITETI TREBA DA BUDU POREDJANI PO STAROSTI - sa usort() uradjeno
        /*public function getAllByCategoryId(int $categoryId): array {
            $sql = 'SELECT antique.*
                    FROM antique_category 
                    INNER JOIN antique 
                    ON antique.antique_id = antique_category.antique_id
                    WHERE category_id = ?;';
            $db = $this->getConnection(); //vraca PDO objekat, ako je konekcija vec napravljena koristi staru
            $prep = $db->prepare($sql);
            $res = $prep->execute([ $categoryId ]);
            $antiques = [];
            if($res) {
                $antiques = $prep->fetchAll(\PDO::FETCH_OBJ);
            }
            usort($antiques, function($a1, $a2){ //RADI ZA SADA ! Prvi su oni sa tacnom godinom, sortirani od najskorijeg do nastarijeg
                return strcmp($a2->year_of_origin, $a1->year_of_origin);
            });
            usort($antiques, function($a1, $a2){ //RADI ZA SADA ! Drugi su oni sa periodom, sortirani po abecedi
               return strcmp($a1->period_of_origin, $a2->period_of_origin); //ABECEDA
            });
            return $antiques;
        }*/


    } 