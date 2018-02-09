<?php

require 'app/models/User.php';

class UserController extends BaseController {

    public static function login() {
        View::make('user/kirjaudu.html');
    }

    public static function handle_login() {
        $params = $_POST;

        $user = User::authenticate($params['username'], $params['password']);
        Kint::dump($user);
   //     if (!$user) {
//            View::make('suunnitelmat/muokkaa.html', array('error' => 'Väärä käyttäjätunnus tai salasana!', 'username' => $params['username']));
  //      } else {
  //        $_SESSION['user'] = $user->id;
//
 //           Redirect::to('/', array('message' => 'Tervetuloa takaisin ' . $user->name . '!'));
   //     }
    }

}
