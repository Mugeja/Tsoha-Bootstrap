<?php

require 'app/models/Tehtava.php';

class TehtavaController extends BaseController{
  public static function index(){
    // Haetaan kaikki pelit tietokannasta
    $tehtavat = Tehtava::tulostaTehtavat();
    // Renderöidään views/game kansiossa sijaitseva tiedosto index.html muuttujan $games datalla
    View::make('suunnitelmat/tehtavat.html', array('tehtavat' => $tehtavat));
  }
}