<?php
    namespace App\Core;

    //osvovna klasa model koju ce ostali modeli naslediti - ona se ne instancira direktno
    //SVE METODE SU FINAL - ne dozvoljavamo menjanje ponasanja ovih metoda van ove klase
    abstract class Model {
        //svi modeli rade sa konekcijom ka BP, jer postavljaju upite nad BP u svojim specijalizovanim funkcijama
        private $dbc;

        //da li se preko modela za kategorije modifikuje vezna tabela
        private $bindingTableFlag;

        //objekat konekcije se prosledjuje modelima po referenci, jer bi u suprotnom svi pravili novu konekciju (kopiju)
        //final - ne dozvoljavamo promenu ponasanja konstruktora u (buducim) modelima
        final public function __construct(DatabaseConnection &$dbc, $bindingTableFlag = false) {
            $this->dbc = $dbc;
            $this->bindingTableFlag = $bindingTableFlag;
        }

        //funkcija koja u konkretnom modelu vraca niz objekata koji predstavljaju nazive polja u konkretnoj tabeli
        //i informaciju da li je dozvoljeno da se u ta polja upisuju vrednosti (ili je read-only)
        //nju override-ujemo u svakom onom modelu koji predstavlja tabelu u koju imamo potrebu da dodajemo zapise
        protected function getFields(): array {
            return [];
        }

        //funkcija interfejs ka privatnom clanu podatku dbc (koji sadrzi objekat konekcije ka BP), 
        //da bi klase koje nasledjuju ovu mogle da ga "dohvate"
        //sme da se zove isto kao i funkcija u core/DatabaseConnection.php
        final protected function getConnection() {
            return $this->dbc->getConnection(); //u core/DatabaseConnection.php
        }

        //SLEDI FUNKCIJA KOJA SE KORISTI PRI FORMIRANJU GENERALIZOVANIH UPITA NAD BP
        //funkcija koja, na osnovu punog imena konkretne klase-modela koja nasledi ovu, 
        //formira ime tabele za koju je ta klasa-model specijalizovana
        final private function getTableName(): string {
            $fullName = static::class; //na osnovu konkretnog klase-modela (koji god bio - nasledjivanje!), dohvata se puno ime tog modela
            //npr. $fullName = 'App/Models/CountryOfOriginModel'
            $matches = []; //u njemu treba da se nalazi deo posle App\Models, a pre reci Model
            //npr. $matches = ['CountryOfOrigin'];
            \preg_match('|^.*\\\((?:[A-Z][a-z]+)+)Model$|', $fullName, $matches); //izvlaci ono sto je u () iz $fullName i ubacuje ga u $matches
            // treba nam $matches[1], jer se za $matches[0] uvek vraca ceo string a ne to sto nam treba
            //NAJPRE SPRECAVAMO EVENTUALNI SQL INJECTION
            $className = $matches[1] ?? ''; //ako je ime klase bilo sta osim ocekivakog, setovace '' za $matches[1]
            //npr. sada je $className = 'CountryOfOrigin'
            //pretvaramo svako (veliko) slovo u $className u "_slovo"
            $underscoredClassName = \preg_replace('|[A-Z]|', '_$0', $className);
            //$underscoredClassName = '_Country_Of_Origin'
            //ceo string lowercase-ujemo
            $lowerCaseUnderscoredClassName = \strtolower($underscoredClassName);
            //$lowerCaseUnderscoredClassName = '_country_of_origin'
            //"izbacimo" prvu _ iz stringa i uzimamo sve posle nje
            return substr($lowerCaseUnderscoredClassName, 1);
        }

        //metod koji vraca podatke o administratoru/kategoriji/antikvitetu/drzavi ciji id je zahtevan spolja
        final public function getById(int $id) {
            $tableName = $this->getTableName();
            $sql = 'SELECT * FROM '. $tableName .' WHERE '. $tableName .'_id = ?;';
            $db = $this->dbc->getConnection(); //vraca PDO objekat, ako je konekcija vec napravljena koristi staru
            $prep = $db->prepare($sql);
            $res = $prep->execute([ $id ]);
            $item = NULL; //jedan red/objekat - $antique, $category, $countryOfOrigin... (generalno ime za podatke koji se izvlace)
            if($res) {
                $item = $prep->fetch(\PDO::FETCH_OBJ);
            }
            return $item;
        }

        //metod koji vraca podatke o svim administratorima/kategorijama/antikvitetima/drzavama koji postoje
        //(iako se mozda zapravo nikad nece zahtevati podaci o svim drzavama ili administratorima, ali metod moze da stoji)
        final public function getAll(): array {
            $tableName = $this->getTableName();
            $sql = 'SELECT * FROM '. $tableName .';';
            $db = $this->dbc->getConnection(); //vraca PDO objekat, ako je konekcija vec napravljena koristi staru
            $prep = $db->prepare($sql);
            $res = $prep->execute();
            $items = []; //vise redova/objekata - $antiques, $categories, $countriesOfOrigin... (generalno ime za podatke koji se izvlace)
            if($res) {
                $items = $prep->fetchAll(\PDO::FETCH_OBJ);
            }
            return $items;
        }

        //metod koji vraca podatke o svim VIDLJIVIM(NESAKRIVENIM) kategorijama/antikvitetima koji postoje
        final public function getAllVisible(): array {
            $tableName = $this->getTableName();
            $sql = 'SELECT * FROM '. $tableName .' WHERE is_deleted = ?;';
            $db = $this->dbc->getConnection(); //vraca PDO objekat, ako je konekcija vec napravljena koristi staru
            $prep = $db->prepare($sql);
            $res = $prep->execute([0]);
            $items = []; //vise redova/objekata - $antiques, $categories, $countriesOfOrigin... (generalno ime za podatke koji se izvlace)
            if($res) {
                $items = $prep->fetchAll(\PDO::FETCH_OBJ);
            }
            return $items;
        }

        //da li je (neki) dati record u BP oznacen sa is_deleted = 1 (sakriven)
        /*final public function isVisible(int $id): bool {
            $record = $this->getById($id);
            if($record['is_deleted'] === 1){
                return false;
            }
            return true;
        }*/

        //metod koji vraca podatke o svim TRENUTNO AKTIVNIM administratorima
        final public function getAllActive(): array {
            $tableName = $this->getTableName();
            $sql = 'SELECT * FROM '. $tableName .' WHERE is_active = ?;';
            $db = $this->dbc->getConnection(); //vraca PDO objekat, ako je konekcija vec napravljena koristi staru
            $prep = $db->prepare($sql);
            $res = $prep->execute([1]);
            $items = []; //vise redova/objekata - $antiques, $categories, $countriesOfOrigin... (generalno ime za podatke koji se izvlace)
            if($res) {
                $items = $prep->fetchAll(\PDO::FETCH_OBJ);
            }
            return $items;
        }



        //funkcija koja proverava da li je validno (po konvenciji) ime polja koje se zahteva
        //category_id, price, created_at, price2... ali ne sme npr. price_ ili _price ili 9price
        final public function isFieldNameValid($fieldName): bool {
            return boolval(\preg_match('|^[a-z][a-z_0-9]+[a-z0-9]$|', $fieldName));
        }

        //ime polja - category_id npr.
        //funkcija za upite tipa: SELECT * FROM tabela WHERE polje_tabele = nesto, sta god je polje_tabele
        //i koja se poziva kada se ocekuje samo jedan red/objekat kao vracen ($fieldName = 'administrator_id npr')
        final public function getByFieldName(string $fieldName, $value) {
            if(!$this->isFieldNameValid($fieldName)){
                throw new Exception('Ime polja nije validno. Polje: '. $fieldName);
            }
            $tableName = $this->getTableName();
            $sql = 'SELECT * FROM '. $tableName .' WHERE '. $fieldName .' = ?;';
            $db = $this->dbc->getConnection(); //vraca PDO objekat, ako je konekcija vec napravljena koristi staru
            $prep = $db->prepare($sql);
            $res = $prep->execute([ $value ]); //izvrsava se za BILO KOJU vrednost, ne mora samo za broj kao sto je za id-jeve
            $item = NULL; //jedan red/objekat - (generalno ime za podatke koji se izvlace)
            if($res) {
                $item = $prep->fetch(\PDO::FETCH_OBJ);
            }
            return $item;
        }

        //ime polja - price npr.
        //funkcija za upite tipa: SELECT * FROM tabela WHERE polje_tabele = nesto, sta god je polje_tabele
        //i koja se poziva kada se ocekuje vise redova/objekata kao vraceni ($fieldName = 'is_deleted npr')
        final public function getAllByFieldName(string $fieldName, $value): array {
            if(!$this->isFieldNameValid($fieldName)){
                throw new Exception('Ime polja nije validno. Polje: '. $fieldName);
            }
            $tableName = $this->getTableName();
            $sql = 'SELECT * FROM '. $tableName .' WHERE '. $fieldName .' = ?;'; //ZA RELACIJE 1:N !!!
            $db = $this->dbc->getConnection(); //vraca PDO objekat, ako je konekcija vec napravljena koristi staru
            $prep = $db->prepare($sql);
            $res = $prep->execute([ $value ]); //izvrsava se za BILO KOJU vrednost, ne mora samo za broj kao sto je za id-jeve
            $items = []; //vise redova/objekata - (generalno ime za podatke koji se izvlace)
            if($res) {
                $items = $prep->fetchAll(\PDO::FETCH_OBJ);
            }
            return $items;
        }

        # Proba: f-ja koja pravi upit za veznu tabelu
        final public function getAllByFieldNameMtoN(string $fieldName, $value): array {
            if(!$this->isFieldNameValid($fieldName)){
                throw new Exception('Ime polja nije validno. Polje: '. $fieldName);
            }
            $tableName = $this->getTableName();
            if($tableName == 'antique') {
                $mToNTableName = $tableName . '_category';
            }
            if($tableName == 'category') {
                $mToNTableName = 'antique_' . $tableName;        
            }
            $sql = 'SELECT * FROM '. $mToNTableName .' WHERE '. $fieldName .' = ?;'; //ZA RELACIJE 1:N !!!
            $db = $this->dbc->getConnection(); //vraca PDO objekat, ako je konekcija vec napravljena koristi staru
            $prep = $db->prepare($sql);
            $res = $prep->execute([ $value ]); //izvrsava se za BILO KOJU vrednost, ne mora samo za broj kao sto je za id-jeve
            $items = []; //vise redova/objekata - (generalno ime za podatke koji se izvlace)
            if($res) {
                $items = $prep->fetchAll(\PDO::FETCH_OBJ);
            }
            return $items;
        }

        final public function add(array $data) {
            $fields = $this->getFields();
            
            
            $supportedFieldNames = \array_keys($fields);  //podrzavani kljucevi (imena polja)
            $requestedFieldNames = \array_keys($data);    //trazeni kljucevi (imena polja) preko ove funkcije


            $tableName = $this->getTableName();
            if($this->bindingTableFlag === true) {
                $tableName = 'antique_category'; //za unos u veznu tabelu
                $supportedFieldNames[] = 'antique_id'; //dodati i ovo polje kao podrzano od strane modela za kategorije
            }
            //print_r($supportedFieldNames);
            //print_r($requestedFieldNames);
            //echo "\n";
            //die();
            foreach( $requestedFieldNames as $requestedFieldName ) {
                # da li se u kljucevima niza $data nalaze iskljucivo ona polja koja postoje u spisku polja modela
                if( !in_array($requestedFieldName, $supportedFieldNames)){
                    throw new \Exception('Polje '. $requestedFieldName .' nije podržano!');
                }
                # da li je polje moguce rucno definisati
                if($tableName !== 'antique_category'){
                    if( !$fields[$requestedFieldName]->isEditable() ){
                        throw new \Exception('Vrednost polja '. $requestedFieldName .' ne sme da se menja!');
                    }
                    # da li je vrednost za dati kljuc odgovarajuca prema reg. izrazu tog polja
                    if( !$fields[$requestedFieldName]->isValid($data[$requestedFieldName]) ){
                        throw new \Exception('Vrednost polja '. $requestedFieldName .' nije u ispravnom formatu!');
                    }
                }
                
                
            }

            # primprema INSERT...INTO...
            
            $sqlFieldNames = implode('', $requestedFieldNames);
            $questionMarks = '?';
            if(count($data) > 1){
                $sqlFieldNames = implode(', ', $requestedFieldNames);
                $questionMarks = str_repeat('?,', count($data));
                $questionMarks = substr($questionMarks, 0, -1);
            }
            
            $sql = "INSERT INTO {$tableName} ({$sqlFieldNames}) VALUES ({$questionMarks});";
            $db = $this->dbc->getConnection(); //vraca PDO objekat, ako je konekcija vec napravljena koristi staru
            $prep = $db->prepare($sql);
            # izvrsavanje insert-a
            $res = $prep->execute(\array_values($data)); //izvrsava se za BILO KOJU vrednost, ne mora samo za broj kao sto je za id-jeve
            if(!$res) {
                return false;
            }
            return $db->lastInsertId(); //ugradjena funkcija koja vraca id dodatog zapisa izvrsavanjem poslednjeg upita
        }

        final public function editById($id, array $data) {
            $fields = $this->getFields();

            $supportedFieldNames = \array_keys($fields);  //podrzavani kljucevi (imena polja)
            $requestedFieldNames = \array_keys($data);    //trazeni kljucevi (imena polja) preko ove funkcije

            $tableName = $this->getTableName();

            if($this->bindingTableFlag === true) {
                $tableName = 'antique_category'; //za unos u veznu tabelu
            }

            foreach( $requestedFieldNames as $requestedFieldName ) {
                # da li se u kljucevima niza $data nalaze iskljucivo ona polja koja postoje u spisku polja modela
                if( !in_array($requestedFieldName, $supportedFieldNames) ){
                    throw new Exception('Polje '. $requestedFieldName .' nije podržano!');
                }
                if($tableName != 'antique_category') {
                    # da li je polje moguce rucno definisati
                    if( !$fields[$requestedFieldName]->isEditable() ){
                        throw new Exception('Vrednost polja '. $requestedFieldName .' ne sme da se menja!');
                    }
                }
                # da li je vrednost za dati kljuc odgovarajuca prema reg. izrazu tog polja
                if( !$fields[$requestedFieldName]->isValid($data[$requestedFieldName]) ){
                    throw new Exception('Vrednost polja '. $requestedFieldName .' nije u ispravnom formatu!');
                }
            }

            # primprema UPDATE...
            
            $nizParova = [];
            foreach ($requestedFieldNames as $requestedFieldName) {
                $nizParova[] = "`{$requestedFieldName}` = ?";
            }
            $sqlPartNames = implode(', ', $nizParova);
            $sql = "UPDATE `{$tableName}` SET {$sqlPartNames} WHERE `{$tableName}_id` = ?;";
            //die($sql);

            if($tableName == 'antique_category') {
                $sql = "UPDATE `{$tableName}` SET {$sqlPartNames} WHERE antique_id = ?;";
            }

            $db = $this->dbc->getConnection(); //vraca PDO objekat, ako je konekcija vec napravljena koristi staru
            $prep = $db->prepare($sql);
            if (!$prep) {
                return false;
            }
            $vrednostZaUpitnike = array_values($data);
            $vrednostZaUpitnike[] = $id;

            return $prep->execute( $vrednostZaUpitnike );

        }

    }