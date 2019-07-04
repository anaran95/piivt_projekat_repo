<?php
    //falj koji (izmedju ostalog) sadrzi parametre za pristup BP u obliku konstanti, ucitava se rucno
    //ne pripada psr-4 namespace-u, globalno je dostupan u aplikaciji
    //finalna klasa Configuration - ne mozemo je naslediti i napraviti drugu konfiguraciju iz nje
    class Configuration {
        const BASE = 'http://localhost/PIiVT_Projekat/';

        const DATABASE_HOST = 'localhost';
        const DATABASE_USER = 'root';
        const DATABASE_PASS = '';
        const DATABASE_NAME = 'antiques';

        const SESSION_STORAGE = '\\App\\Core\\Session\\FileSessionStorage'; //koji session storage mehanizam se koristi
        const SESSION_STORAGE_DATA = ['./sessions/']; //spisak argumenata za konstruktor klase pod SESSION_STORAGE - samo jedan argument
        const SESSION_LIFETIME = 3600; //drugacije od 1800 inicijalnih sekundi

        const FINGERPRINT_PROVIDER_FACORY = '\\App\\Core\\Fingerprint\\BasicFingerprintProviderFactory';
        const FINGERPRINT_PROVIDER_METHOD = 'getInstance';
        const FINGERPRINT_PROVIDER_ARGS = ['SERVER'];

        const UPLOAD_DIR = 'assets/uploads/';
    }