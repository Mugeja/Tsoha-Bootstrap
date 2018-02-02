<?php

require 'app/models/Tehtava.php';

class TehtavaController extends BaseModel {

    public static function index() {
        $tehtavat = Tehtava::tulostaTehtavat();
        View::make('suunnitelmat/tehtavat.html', array('tehtavat' => $tehtavat));
    }

}
