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
        // Lisätään $errors muuttujaan kaikki virheilmoitukset taulukkona
        $validator_errors = array();
        $errors = array();
        $validators[] = validator_nimi;
        $validators[] = validator_kuvaus;
        $validators[] = validator_suoritus;

        foreach ($this->validators as $validator) {
            // Kutsu validointimetodia tässä ja lisää sen palauttamat virheet errors-taulukkoon
            $validator_errors[] = $this->{$validator};
            $errors = array_merge($validator_errors, $errors);
        }

        return $errors;
    }

    public function validitate_nimi($string) {
        $errors = array();
        if ($string == '' || $string == NULL) {
            $errors[] = 'Tyhjä nimi';
        }
        if (strlen($string) < 5) {
            $errors[] = 'Liian lyhyt nimi';
        }
        return $errors;
    }

    public function validitate_description($string) {
        $errors = array();
        if ($string == '' || $string == NULL) {
            $errors[] = 'Tyhjä kuvaus';
        }
        if (strlen($string) < 10) {
            $errors[] = 'Liian lyhyt kuvaus';
        }
        return $errors;
    }

    public function validitate_suoritus($string) {
        $errors = array();
        if (!($string == 'kyllä' || $string == 'ei')) {
            $errors[] = 'vastaa joko kyllä tai ei';
        }
        return $errors;
    }

}
