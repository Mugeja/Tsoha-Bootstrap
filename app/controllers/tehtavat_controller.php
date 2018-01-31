<?php
require 'app/models/Tehtava.php';
class TehtavaController extends BaseModel{
    public static function index(){
        $tehtavat = Tehtavat::tulostaTehtavat;
        View::make('tehtava/index.html', array('tehtavat'=>$tehtavat));
        
        
    }
}