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

    public function errors() {
        $validator_errors = array();
        $errors = array();

        foreach ($this->validators as $validator) {
            
            $validator_errors[] = $this->{$validator}($this->kuvaus);
            
        }
        $errors = array_merge($validator_errors, $errors);
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
        if (!($string == 'kyllä' || $string == 'ei')) {
            $errors[] = 'vastaa kyllä tai ei';
        }
    }

    
}
