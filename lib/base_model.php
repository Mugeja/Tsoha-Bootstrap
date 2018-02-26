<?php

class BaseModel {

    // "protected"-attribuutti on käytössä vain luokan ja sen perivien luokkien sisällä
    protected $validators = array();

    public function __construct($attributes = null) {

        foreach ($attributes as $attribute => $value) {
            // Jos avaimen niminen attribuutti on olemassa...
            if (property_exists($this, $attribute)) {
                // ... lisätään avaimen nimiseen attribuuttin siihen liittyvä arvo
                $this->{$attribute} = $value;
            }
        }
    }

   
    public function errors(){
      $errors = array();
      foreach($this->validators as $validator){
        $errors = array_merge($errors, $this->{$validator}());
      }

      return $errors;
    }

    public function validoi_string($string, $length) {
        $errors = array();
        if ($string == '' || $string == NULL) {
            $errors[] = 'Tyhjä';
        }
        if (strlen($string) < $length) {
            $errors[] = 'Liian lyhyt';
        }
        return $errors;
    }

    public function validoi_boolean($string){
        $errors = array();
        $string = strtolower($string);
        if (!($string == 'kyllä' || $string == 'ei')) {
            $errors[] = 'vastaa kyllä tai ei';
        }
        return $errors;
    }

    
}
