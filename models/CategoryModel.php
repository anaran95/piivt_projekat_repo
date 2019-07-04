<?php
    namespace App\Models;
    use App\Core\Model; //pronalazimo lokaciju koriscenih klasa - 'use' za slozenije putanje
    use App\Core\Field;
    use App\Validators\NumberValidator;
    use App\Validators\DateTimeValidator;
    use App\Validators\StringValidator;
    use App\Validators\BitValidator;

    //Klasa interfejs ka tabeli category u BP
    class CategoryModel extends Model {
        //ideja - za potrebe brisanja, napraviti metod koji ce da vraca true ako postoji bilo sta u trazenoj kategoriji
        
        public function getAntiquesByCategoryId($id): array {
            return $this-> getAllByFieldNameMtoN('category_id', $id);
        }
        
        protected function getFields(): array {  //U CategoryController.php pravimo CategoryModel.php -> add i navodimo specificna polja
            return [
                'category_id' => new Field((new NumberValidator())->setIntegerLength(10), false),
                'created_at' => new Field((new DateTimeValidator())->allowDate()->allowTime(), false),
                'name' => new Field((new StringValidator())->setMaxLength(255)),
                'is_deleted' => new Field( new BitValidator() ),
                'administrator_id' => new Field((new NumberValidator())->setIntegerLength(10))//administrator_id ce kasnije biti automatski (iz trenutne sesije!)
            ];
        }
    } 