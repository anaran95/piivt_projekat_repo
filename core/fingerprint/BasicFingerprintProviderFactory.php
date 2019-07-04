<?php
    namespace App\Core\Fingerprint;

    class BasicFingerprintProviderFactory {
        public function getInstance(string $arraySource): BasicFingerprintProvider {
            switch($arraySource){
                case 'SERVER':
                    return new BasicFingerprintProvider($_SERVER); //$_SERVER je sistemska promenljiva
            }

            return new BasicFingerprintProvider($_SERVER); //kada je korisnik odabrao pogresan izvor ili takav ne postoji, vracamo podrazumevani
        } 
    }