<?php
    //zadatak fajla je da vrati spisak novih ruta u obliku asocijativnog niza
    return [
        //za sada, registracija se podrazumeva
        App\Core\Route::get('|^admin/login/?$|', 'Main', 'getLogin'),
        App\Core\Route::post('|^admin/login/?$|', 'Main', 'postLogin'),
        App\Core\Route::get('|^admin/logout/?$|', 'Main', 'getLogout'),
        App\Core\Route::post('|^admin/logout/?$|', 'Main', 'postLogout'),

        //Admin role rute za kategorije - nakon logovanja (zabrana pristupa neulogovanom korisniku)
        //prikaz //forma za edit //edit logika
        //prikaz //forma za add //add logika
        App\Core\Route::get('|^admin/profile/?$|', 'AdministratorDashboard', 'index'),
        App\Core\Route::get('|^admin/categories/?$|', 'AdministratorCategoryManagement', 'categories'),
        App\Core\Route::get('|^admin/categories/edit/([0-9]+)/?$|', 'AdministratorCategoryManagement', 'getEdit'),
        App\Core\Route::post('|^admin/categories/edit/([0-9]+)/?$|', 'AdministratorCategoryManagement', 'postEdit'),
        App\Core\Route::get('|^admin/categories/add/?$|', 'AdministratorCategoryManagement', 'getAdd'),
        App\Core\Route::post('|^admin/categories/add/?$|', 'AdministratorCategoryManagement', 'postAdd'),
        ////Admin role rute za antikvitete - nakon logovanja (zabrana pristupa neulogovanom korisniku)
        App\Core\Route::get('|^admin/antiques/?$|', 'AdministratorAntiqueManagement', 'antiques'),
        App\Core\Route::get('|^admin/antiques/edit/([0-9]+)/?$|', 'AdministratorAntiqueManagement', 'getEdit'),
        App\Core\Route::post('|^admin/antiques/edit/([0-9]+)/?$|', 'AdministratorAntiqueManagement', 'postEdit'),
        App\Core\Route::get('|^admin/antiques/add/?$|', 'AdministratorAntiqueManagement', 'getAdd'),
        App\Core\Route::post('|^admin/antiques/add/?$|', 'AdministratorAntiqueManagement', 'postAdd'),

        App\Core\Route::get('|^category/([0-9]+)/?$|', 'Category', 'show'), //prikazuje (za sada) podatke o kategoriji i sta sve ima u toj kategoriji od antikviteta
        //vratiti sledecu rutu kada se napravi delete() metod u CategoryController.php
        App\Core\Route::get('|^category/([0-9/]+)/delete$|', 'Category', 'delete'), //ovde je drugaciji regex nego na video snimku (009), ruta podrzava brisanje vise kategorija odjednom, npr cekiranjem kroz interfejs aplikacije

        App\Core\Route::get('|^antique/([0-9]+)/?$|', 'Antique', 'show'), //prikazuje podatke o pojedinacnom antikvitetu
        App\Core\Route::post('|^search/?$|', 'Antique', 'postSearch'),

        #API rute - dinamicko kreiranje stranica
        App\Core\Route::get('|^api/antique/([0-9]+)/?$|', 'ApiAntique', 'show'),

        /*App\Core\Route::get('|^category/add/?$|', 'Category', 'getAdd'),
        App\Core\Route::post('|^category/add/?$|', 'Category', 'postAdd'), //za dodavanje nove kategorije
        App\Core\Route::get('|^antique/add/?$|', 'Antique', 'getAdd'),
        App\Core\Route::post('|^antique/add/?$|', 'Antique', 'postAdd'), //za dodavanje novog antikviteta*/

        //fallback ruta - ona koja se izvrsi ako ni jedna druga ne postoji
        App\Core\Route::any('|^.*$|', 'Main', 'home') //na ovo mesto vraca new Route(...)
    ];