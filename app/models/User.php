<?php

class User extends BaseModel {

    public $validators, $salasana, $nimi, $id, $status;

    public function __construct($attributes = null) {

        foreach ($attributes as $attribute => $value) {
            // Jos avaimen niminen attribuutti on olemassa...
            if (property_exists($this, $attribute)) {
                // ... lisätään avaimen nimiseen attribuuttin siihen liittyvä arvo
                $this->{$attribute} = $value;
            }
        }
        $this->validators = array('validoi_nimi', 'validoi_salasana');
    }
    public static function tulostaKayttajat() {
        $query = DB::connection()->prepare('SELECT * FROM Käyttäjä');
        $query->execute();
        $rivit = $query->fetchAll();
        $kayttajat = array();
        foreach ($rivit as $rivi) {
            $kayttajat[] = new User(['id' => $rivi['id'],
                'nimi' => $rivi['nimi'],
                'status' => $rivi['status'],
                'salasana' => $rivi['salasana']]);
        }
        return $kayttajat;
    }
    public function save() {
        $query = DB::connection()->prepare('INSERT INTO Käyttäjä (nimi, salasana, status) VALUES (:nimi, :salasana, :status)');
        $query->execute(array('nimi' => $this->nimi, 'salasana' => $this->salasana, 'status' => $this->status));
    }
    

    public static function etsi($id) {
        $query = DB::connection()->prepare('SELECT * FROM Käyttäjä WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $rivi = $query->fetch();
        if ($rivi) {
            $User = new User(array('id' => $rivi['id'],
                'nimi' => $rivi['nimi'],
                'salasana' => $rivi['salasana'],
            ));
            return $User;
        }
    }

    public function validoi_salasana() {
        $errors = array();
        $errors = $this->validoi_string($this->salasana, 5);
        return $errors;
    }

    public function validoi_nimi() {
        $errors = array();
        $errors = $this->validoi_string($this->nimi, 2);
        return $errors;
    }

    public static function authenticate($username, $password) {
        $query = DB::connection()->prepare('SELECT * FROM Käyttäjä WHERE nimi = :username AND salasana = :password LIMIT 1');
        $query->execute(array('username' => $username, 'password' => $password));
        $rivi = $query->fetch();

        $user = Self::etsi($rivi['id']);
        return $user;
    }

}
