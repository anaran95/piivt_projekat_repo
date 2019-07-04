<?php
    namespace App\Core;

    //Klasa omotac (dependency injection wrapper) koja omogucava uspostavljanje konekcije ka BP
    class DatabaseConnection {
        private $connection;
        private $configuration;

        public function __construct(DatabaseConfiguration $databaseConfiguration) {
            $this->configuration = $databaseConfiguration;
        }

        //getter za instancu konekcije (PDO objekta); vraca vec postojecu konekciju, ako postoji
        public function getConnection(): \PDO {
            if($this->connection === NULL) {
                $this->connection = new \PDO($this->configuration->getSourceString(),
                                            $this->configuration->getUser(),
                                            $this->configuration->getPass());
            }

            return $this->connection;
        }
    }