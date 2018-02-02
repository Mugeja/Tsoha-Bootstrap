<?php

require 'app/models/Tehtava.php';

class TehtavaController extends BaseController {

    public static function index() {
        // Haetaan kaikki pelit tietokannasta
        $tehtavat = Tehtava::tulostaTehtavat();
        // Renderöidään views/game kansiossa sijaitseva tiedosto index.html muuttujan $games datalla
        View::make('suunnitelmat/tehtavat.html', array('tehtavat' => $tehtavat));
    }

    public static function show($id) {
        echo $id;
    }

    public static function store() {
        $params = $_POST;
        $tehtava = new Tehtava(array(
            'nimi' => $params['nimi'],
            'kuvaus' => $params['kuvaus'],
            'suoritettu' => $params['suoritettu']
        ));

        Kint::dump($params);

        $tehtava->save();

        //Redirect::to('/tehtavat/' . $tehtava->id, array('message' => 'Tehtävä lisätty!'));
    }

}
