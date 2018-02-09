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
        $tehtava = Tehtava::etsi($id);
        View::make('suunnitelmat/esittely.html', array('tehtava' => $tehtava));
    }

    public static function store() {
        $params = $_POST;
        $attributes = array(
            'nimi' => $params['nimi'],
            'kuvaus' => $params['kuvaus'],
            'suoritettu' => $params['suoritettu']
        );

        $tehtava = new Tehtava($attributes);
        $errors = $tehtava->errors();

        if (count($errors) == 0) {
            $tehtava->save();
            Redirect::to('/tehtavat/' . $tehtava->id);
        } else {
            View::make('suunnitelmat/new.html');
        }
    }

    public static function create() {
        View::make('suunnitelmat/new.html');
    }

    public static function edit($id) {
        $tehtava = Tehtava::etsi($id);
        View::make('suunnitelmat/muokkaa.html', array('attributes' => $tehtava));
    }
    public static function varmistaPoisto($id){
        $tehtava = Tehtava::etsi($id);
        View::make('suunnitelmat/poista.html');
    }

    public static function update($id) {
        $params = $_POST;
        $attributes = array(
            'id' => $id,
            'nimi' => $params['nimi'],
            'kuvaus' => $params['kuvaus'],
            'suoritettu' => $params['suoritettu']
        );

        $tehtava = new Tehtava($attributes);
        $errors = $tehtava->errors();

        if (count($errors) > 0) {

            View::make('suunnitelmat/muokkaa.html', array('errors' => $errors, 'attributes' => $attributes));
        } else {
            $tehtava->update($id);


            Redirect::to('/tehtavat/' . $tehtava->id, array('message' => 'Tehtava on muokattu onnistuneesti'));
        }
    }

    public static function destroy($id) {

        $tehtava = new Tehtava(array('id' => $id));
        $tehtava->destroy($id);

        Redirect::to('/tehtava', array('message' => 'Tehtava poistettu'));
    }
    
    public static function poistaVarmistus() {
        View::make('suunnitelmat/new.html');
    }

}
