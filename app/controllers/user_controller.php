<?php

require 'app/models/User.php';

class UserController extends BaseController {

    public static function login() {
        View::make('suunnitelmat/kirjaudu.html');
    }
    public static function store() {
        $params = $_POST;
        $attributes = array('nimi' => $params['nimi'],
            'salasana' => $params['salasana']
        );

        $kayttaja = new User($attributes);
        $errors = $kayttaja->errors();

        if (count($errors) == 0) {
            $kayttaja->save();
            Redirect::to('/kirjaudu');
        } else {
            View::make('suunnitelmat/kirjaudu.html', array('errors' => $errors, 'message' => 'Virhe lisätessä'));
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
    

}
