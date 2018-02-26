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

    public function laske_tehtavat($id) { 
        $query = DB::connection()->prepare('SELECT COUNT(*) FROM Tehtävä WHERE tehtävä.suoritettu = :suoriettu ');
        $query->execute(array('id' => $id, 'suoritettu' => 'kyllä'));
        $count = $query->fetch();
        return $count;
    }

    public static function tulostaTehtavat() {
        $query = DB::connection()->prepare('SELECT T.*, K.status, K.kuvaus, K.hyväksyjä FROM Tehtävä T left outer join Käyttäjän_tehtävät K on (T.ID = K.tehtävä_id AND K.käyttäjä_id= :kayttaja_id)');
        $kayttaja = UserController::get_user_logged_in();
        $kayttaja_id = $kayttaja->id;
        $query->execute(array('kayttaja_id' => $kayttaja_id));
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
        $query = DB::connection()->prepare('INSERT INTO Tehtävä (nimi, kuvaus, suoritettu) VALUES (:nimi, :kuvaus, :suoritettu)');
        $query->execute(array('nimi' => $this->nimi, 'kuvaus' => $this->kuvaus, 'suoritettu' => 'ei'));
    }

    public function update($id) {
        $query = DB::connection()->prepare('UPDATE Tehtävä SET (nimi, kuvaus, suoritettu, hyväksyjä) = (:nimi, :kuvaus, :suoritettu, :hyvaksyja) WHERE id = :id');
        $query->execute(array('hyvaksyja' => $this->hyväksyjä, 'nimi' => $this->nimi, 'kuvaus' => $this->kuvaus, 'suoritettu' => $this->suoritettu, 'id' => $id));
    }

    public function destroy($id) {
        $query = DB::connection()->prepare('DELETE FROM Tehtävä WHERE id = :id');
        $query->execute(array('id' => $id));
    }

}
