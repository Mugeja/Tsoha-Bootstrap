<?php

  class HelloWorldController extends BaseController{

    public static function index(){
      // make-metodi renderÃ¶i app/views-kansiossa sijaitsevia tiedostoja
   	  echo 'Tämä on etusivu';
    }

    public static function sandbox(){
      // Testaa koodiasi tÃ¤Ã¤llÃ¤
      View::make('helloworld.html');
    }
    public static function tehtavat_list(){
    View::make('suunnitelmat/game_list.html');
  }

  public static function tehtavat_show(){
    View::make('suunnitelmat/game_show.html');
  }

  public static function login(){
    View::make('suunnitelmat/login.html');
  }
  }
