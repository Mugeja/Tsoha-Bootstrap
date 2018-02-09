<?php

class Tehtava extends BaseModel {

    public $id, $nimi, $suoritettu, $hyväksyjä, $kuvaus, $validators;

    public function __construct($attributes = null) {

        foreach ($attributes as $attribute => $value) {
            // Jos avaimen niminen attribuutti on olemassa...
            if (property_exists($this, $attribute)) {
                // ... lisätään avaimen nimiseen attribuuttin siihen liittyvä arvo
                $this->{$attribute} = $value;
            }
        }
        //parent::construct($attributes);
        $this->validators = array('validoi_nimi', 'validoi_kuvaus', 'validoi_suoritus');
    }

    public function validoi_nimi() {
        $errors = array();
        $errors = $this->validoi_string($this->nimi, 5);
        return $errors;
    }

    public function validoi_kuvaus() {
        $errors = array();
        $errors = $this->validoi_string($this->kuvaus, 5);
        return $errors;
    }

    public function validoi_suoritus() {
        $errors = array();
        $errors = $this->validoi_boolean($this->suoritettu);
        return $errors;
    }

    public static function tulostaTehtavat() {
        $query = DB::connection()->prepare('SELECT * FROM Tehtävä');
        $query->execute();
        $rivit = $query->fetchAll();
        $tehtavat = array();
        foreach ($rivit as $rivi) {
            $tehtavat[] = new Tehtava(['id' => $rivi['id'],
                'nimi' => $rivi['nimi'],
                'hyväksyjä' => $rivi['hyväksyjä'],
                'suoritettu' => $rivi['suoritettu'],
                'kuvaus' => $rivi['kuvaus'],]);
        }
        return $tehtavat;
    }

    public static function etsi($id) {
        $query = DB::connection()->prepare('SELECT * FROM Tehtävä WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $rivi = $query->fetch();
        if ($rivi) {
            $tehtava = new Tehtava(array(
                'id' => $rivi['id'],
                'nimi' => $rivi['nimi'],
                'suoritettu' => $rivi['suoritettu'],
                'hyväksyjä' => $rivi['hyväksyjä'],
                'kuvaus' => $rivi['kuvaus'],
            ));
            return $tehtava;
        }
    }

    public function save() {
        $query = DB::connection()->prepare('INSERT INTO Tehtävä (nimi, kuvaus, suoritettu) VALUES (:nimi, :kuvaus, :suoritettu) RETURNING id');
        $query->execute(array('nimi' => $this->nimi, 'kuvaus' => $this->kuvaus, 'suoritettu' => $this->suoritettu));
        $rivi = $query->fetch();
        $this->id = $rivi['id'];
    }

    public function update($id) {
        Kint::dump($id);
        $query = DB::connection()->prepare('UPDATE Tehtävä SET (nimi, kuvaus, suoritettu) = (:nimi, :kuvaus, :suoritettu) WHERE id = :id');
        $query->execute(array('nimi' => $this->nimi, 'kuvaus' => $this->kuvaus, 'suoritettu' => $this->suoritettu, 'id' => $id));

    }
    public function delete($id) {
        $query = DB::connection()->prepare('DELETE FROM Tehtävä WHERE id = :id');
        $query->execute(array('id' => $id));
        $rivi = $query->fetch();
        $this->id = $rivi['id'];
    }

}
