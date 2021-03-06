<?php

require 'app/models/Tehtava.php';

class TehtavaController extends BaseController {

    public static function index() {
        self::check_logged_in();
        $user = UserController::get_user_logged_in();
        $user_id = $user->id;
        $status = $user->status;
        $tehtavat = Tehtava::tulostaTehtavat($user_id, $status);
        View::make('suunnitelmat/tehtavat.html', array('tehtavat' => $tehtavat));
    }

    public static function show($id) {
        self::check_logged_in();
        $tehtava = Tehtava::etsi($id);
        View::make('suunnitelmat/esittely.html', array('tehtava' => $tehtava));
    }

    public static function store() {
        $params = $_POST;
        $attributes = array(
            'nimi' => $params['nimi'],
            'status' => $params['vastaus'],
            'tila' => $params['tila']
        );

        $tehtava = new Tehtava($attributes);
        $errors = $tehtava->errors();

        if (count($errors) == 0) {
            $tehtava->save();
            Redirect::to('/tehtavat');
        } else {
            View::make('suunnitelmat/new.html', array('errors' => $errors, 'message' => 'Virhe lisätessä'));
        }
    }

    public static function create() {
        self::check_logged_in();
        $user_id = User::kayttajat();
        $lista = array();
        $lista[] = 'fuksi';
        $lista[] = 'tuutori';
        $lista[] = 'vastaava';
        View::make('suunnitelmat/new.html', array('lista' => $lista));
    }

    public static function edit($id) {
        self::check_logged_in();
        $attributes= Tehtava::etsiTehtava($id); 
        
        $lista = array();
        $lista[] = 'ei';
        $lista[] = 'kyllä';
        $statuslista = array();
        $statuslista[] = 'fuksi';
        $statuslista[] = 'tuutori';
        $statuslista[] = 'vastaava';
        View::make('suunnitelmat/muokkaa.html', array('attributes' => $attributes,'statuslista' => $statuslista, 'lista' => $lista));
    }

    public static function update($id) {
        $status = Tehtava::etsiTehtava($id)->status;
        $nimi = Tehtava::etsiTehtava($id)->nimi;
        $lista = array();
        $lista[] = 'ei';
        $lista[] = 'kyllä';
        $params = $_POST;
        $attributes = array(
            'id' => $id,
            'nimi' => $nimi,
            'kuvaus' => $params['kuvaus'],
            'suoritettu' => $params['vastaus'],
            'hyväksyjä' => $params['hyväksyjä'],
            'status' => $status
        );

        $tehtava = new Tehtava($attributes);
        $errors = $tehtava->errors();

        if (count($errors) > 0) {

            View::make('suunnitelmat/muokkaa.html', array('lista' => $lista, 'errors' => $errors, 'attributes' => $attributes));
        } else {
            $tehtava->update($id);
            Redirect::to('/tehtavat', array('message' => 'Tehtava on muokattu onnistuneesti'));
        }
    }

    public static function destroy($id) {

        $tehtava = new Tehtava(array('id' => $id));
        $tehtava->destroy($id);

        Redirect::to('/tehtavat', array('message' => 'Tehtava poistettu'));
    }

}
