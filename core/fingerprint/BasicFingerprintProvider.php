<?php
    namespace App\Core\Fingerprint;

    class BasicFingerprintProvider implements FingerprintProvider {
        private $data; //inf. o serveru

        public function __construct(array $data) {
            $this->data = $data;
        }

        public function provideFingerprint(): string {
            $userAgent = filter_var($this->data['HTTP_USER_AGENT'] ?? '', FILTER_SANITIZE_STRING);
            //ip adresa kao deo fingerprinta moze biti problematicna za prenosive uredjaje i logovanje na 2 razlicite lokacije!
            //u tom slucaju (ovde) za $ipAddress stavimo ''
            $ipAddress = ''; #filter_var($this->data['REMOTE_ADDR'] ?? '', FILTER_SANITIZE_STRING);
            $string = $userAgent . '|' . $ipAddress;
            $hash1 = hash('sha512', $string);
            return hash('sha256', $hash1);  //jedan od nacina kreiranja jedinstvenog fingerprinta - sprecavanje session hijacking napada
        }
    }