<?php

require 'app/models/Tehtava.php';

class HelloWorldController extends BaseController {

    public static function index() {
        // make-metodi renderÃ¶i app/views-kansiossa sijaitsevia tiedostoja
        echo 'Tämä on etusivu';
    }

    public static function sandbox() {
        // Testaa koodiasi tÃ¤Ã¤llÃ¤

        $ponileikki = new Tehtava(array(
            'nimi' => 'd',
            'kuvaus' => 'vedä ponileikki tsohan assarin edessä',
            'suoritettu' => 'kyllä'
        ));
        $errors = $ponileikki->errors();

        Kint::dump($errors);
    }

    public static function etusivu() {
        View::make('suunnitelmat/etusivu.html');
    }

    public static function tehtavat() {
        View::make('suunnitelmat/tehtavat.html');
    }

    public static function tehtavan_muokkaus() {
        View::make('suunnitelmat/tehtavan_muokkaus.html');
    }

    public static function kirjautuminen() {
        View::make('suunnitelmat/kirjautuminen.html');
    }

}
