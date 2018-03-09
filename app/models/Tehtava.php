<?php

class Tehtava extends BaseModel {

    public $id, $nimi, $tila, $status, $suoritettu, $kuvaus, $hyväksyjä, $validators;

    public function __construct($attributes = null) {

        foreach ($attributes as $attribute => $value) {
            // Jos avaimen niminen attribuutti on olemassa...
            if (property_exists($this, $attribute)) {
                // ... lisätään avaimen nimiseen attribuuttin siihen liittyvä arvo
                $this->{$attribute} = $value;
            }
        }

        $this->validators = array('validoi_nimi', 'validoi_tila', 'validoi_status');
    }

    public function validoi_nimi() {
        $errors = array();
        $errors = $this->validoi_string($this->nimi, 2);
        return $errors;
    }

    public function validoi_status() {
        $errors = array();
        $errors = $this->validoi_string($this->status, 2);
        return $errors;
    }

    public function validoi_tila() {
        $errors = array();
        $errors = $this->validoi_string($this->tila, 2);
        return $errors;
    }

    public function laske_tehtavat($id) {
        $query = DB::connection()->prepare('SELECT COUNT(*) FROM Tehtävä WHERE tehtävä.suoritettu = :suoriettu ');
        $query->execute(array('id' => $id, 'suoritettu' => 'kyllä'));
        $count = $query->fetch();
        return $count;
    }

    public static function tulostaTehtavat($kayttaja_id) {
        $query = DB::connection()->prepare('SELECT T.*, K.suoritettu, K.kuvaus, K.hyväksyjä FROM Tehtävä T LEFT JOIN Käyttäjän_tehtävät K on T.ID = K.tehtävä_id AND K.käyttäjä_id = :kayttaja_id ORDER BY T.nimi');
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
        $query = DB::connection()->prepare('SELECT K.suoritettu, K.hyväksyjä, K.kuvaus, T.nimi, T.status, T.tila FROM Käyttäjän_tehtävät K INNER JOIN Tehtävä T on K.tehtävä_id = :tehtava_id AND T.id = :tehtava_id AND K.käyttäjä_id = :kayttaja_id LIMIT 1');
        $kayttaja = UserController::get_user_logged_in();
        $kayttaja_id = $kayttaja->id;
        $query->execute(array('tehtava_id' => $id, 'kayttaja_id' => $kayttaja_id));
        $row = $query->fetch();

        if ($row) {
            $tehtava = new Tehtava(array(
                'id' => $id,
                'suoritettu' => $row['suoritettu'],
                'hyväksyjä' => $row['hyväksyjä'],
                'kuvaus' => $row['kuvaus'],
                'tila' => $row['tila'],
                'status' => $row['status'],
                'nimi' => $row['nimi']
            ));
            return $tehtava;
        }
    }

    public function save() {
        $query = DB::connection()->prepare('INSERT INTO Tehtävä (nimi, status, tila) VALUES (:nimi, :status, :tila) RETURNING id');
        $query->execute(array('nimi' => $this->nimi, 'status' => $this->status, 'tila' => $this->tila));
        $row = $query->fetch();
        $this->id = $row['id'];
        $user_id = User::kayttajat();
        foreach ($user_id as $id) {
            $kayttaja_id = $id;
            $query2 = DB::connection()->prepare('INSERT INTO Käyttäjän_tehtävät (käyttäjä_id, tehtävä_id, suoritettu) VALUES (:kayttaja_id, :tehtava_id, :suoritettu)');
            $query2->execute(array('kayttaja_id' => $kayttaja_id, 'tehtava_id' => $this->id, 'suoritettu' => 'ei'));
        }
    }

    public function update($id) {
        $kayttaja = UserController::get_user_logged_in();
        $kayttaja_id = $kayttaja->id;
        $query = DB::connection()->prepare('UPDATE Tehtävä SET (nimi, status, tila) = (:nimi, :status, :tila) WHERE id = :id');
        $query->execute(array('nimi' => $this->nimi, 'status' => $this->status, 'tila' => $this->tila, 'id' => $id));
        $query2 = DB::connection()->prepare('UPDATE Käyttäjän_tehtävät SET (suoritettu, kuvaus, hyväksyjä) =(:suoritettu, :kuvaus, :hyvaksyja) WHERE käyttäjä_id = :kayttaja_id AND tehtävä_id = :tehtava_id');
        $query2->execute((array('kayttaja_id' => $kayttaja_id, 'tehtava_id' => $id, 'suoritettu' => $this->suoritettu, 'kuvaus' => $this->kuvaus, 'hyvaksyja' => $this->hyväksyjä)));
    }

    public function destroy($id) {
        $query = DB::connection()->prepare('DELETE FROM Tehtävä WHERE id = :id');
        $query->execute(array('id' => $id));
    }
    
    public static function tehtava_id(){
        $query = DB::connection()->prepare('SELECT ID FROM Tehtävä');
        $query->execute();
        $tehtavat = $query->fetchAll();
        $return = array();
        foreach ($tehtavat as $tehtava){
            $return[] = $tehtava['id'];
        }
        return $return;
    }

}
