<?php

  class BaseModel{
    // "protected"-attribuutti on käytössä vain luokan ja sen perivien luokkien sisällä
    protected $validators;

    public function __construct($attributes = null){
        parent::construct($attributes);
      $this->validators = array('validate_name', 'validate_kuvaus');
      foreach($attributes as $attribute => $value){
        // Jos avaimen niminen attribuutti on olemassa...
        if(property_exists($this, $attribute)){
          // ... lisätään avaimen nimiseen attribuuttin siihen liittyvä arvo
          $this->{$attribute} = $value;
        }
      }
    }

    public function errors(){
      // Lisätään $errors muuttujaan kaikki virheilmoitukset taulukkona
      $errors = array();

      foreach($this->validators as $validator){
        // Kutsu validointimetodia tässä ja lisää sen palauttamat virheet errors-taulukkoon
      }

      return $errors;
    }public function validitate_string_length($string, $length){
        $errors = array();
        if ($string == '' || $string == NULL){
            $errors[] = 'Tyhjä vastaus';
        }
        if (strlen($string) < $length) {
            $errors[] = 'Liian lyhyt vastaus';
        }
    }
  }
