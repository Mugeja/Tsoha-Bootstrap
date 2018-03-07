<?php

require 'app/models/User.php';

class UserController extends BaseController {

    public static function login() {
        View::make('suunnitelmat/kirjaudu.html');
    }

    public static function kayttajat() {
        self::check_logged_in();
        $kayttajat = User::tulostaKayttajat();
        $count = array();
      //  foreach ($kayttajat as $kayttaja) {
      //      $count = Tehtava::laske_tehtavat($kayttaja->id);
      // }

        View::make('suunnitelmat/kayttajat.html', array('kayttajat' => $kayttajat));
    }

    public static function store() {
        $params = $_POST;
        if ($params['salasana'] != $params['salasanan_varmistus']) {
            View::make('suunnitelmat/kirjaudu.html', array('password_error' => 'Salasanat eivät ole samat'));
        }
        $attributes = array(
            'nimi' => $params['nimi'],
            'salasana' => $params['salasana'],
            'status' => 'vastaava'
        );
        $kayttaja = new User($attributes);
        $errors = $kayttaja->errors();
        if (count($errors) == 0) {
            $kayttaja->save();
            Redirect::to('/');
        } else {
            View::make('suunnitelmat/kirjaudu.html', array('error' => $errors, 'message' => 'Virhe lisätessä'));
        }
    }

    public static function handle_login() {
        $params = $_POST;

        $user = User::authenticate($params['username'], $params['password']);

        if (!$user) {
            View::make('/suunnitelmat/kirjaudu.html', array('error' => 'Väärä käyttäjätunnus tai salasana!', 'username' => $params['username']));
        } else {
            $_SESSION['user'] = $user->id;

            Redirect::to('/tehtavat', array('message' => 'Tervetuloa takaisin ' . $user->nimi . '!'));
        }
    }

    public static function logout() {
        $_SESSION['user'] = null;
        Redirect::to('/kirjaudu', array('message' => 'Uloskirjautuminen onnistui'));
    }

    public static function edit($id) {
        self::check_logged_in();
        $user = User::etsi($id);
        View::make('suunnitelmat/kayttaja_muokkaus.html', array('attributes' => $user));
    }

    public static function update($id) {
        $params = $_POST;
        $attributes = array(
            'id' => $id,
            'nimi' => $params['nimi'],
            'salasana' => $params['salasana'],
            'status' => $params['status']
        );

        $user = new User($attributes);
        $errors = $user->errors();

        if (count($errors) > 0) {

            View::make('suunnitelmat/kayttaja_muokkaus.html', array('errors' => $errors, 'attributes' => $attributes));
        } else {
            $user->update($id);
            Redirect::to('/tehtavat', array('message' => 'Tehtava on muokattu onnistuneesti'));
        }
    }

}
