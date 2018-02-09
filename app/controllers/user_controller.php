<?php

require 'app/models/User.php';

class UserController extends BaseController {

    public static function login() {
        View::make('user/kirjaudu.html');
    }

    public static function handle_login() {
        $params = $_POST;

        $user = User::authenticate($params['username'], $params['password']);
        
        if (!$user) {
            View::make('/', array('error' => 'Väärä käyttäjätunnus tai salasana!', 'username' => $params['username']));
        } else {
            $_SESSION['user'] = $user->id;

            Redirect::to('/tehtavat', array('message' => 'Tervetuloa takaisin ' . $user->nimi . '!'));
        }
    }

}
