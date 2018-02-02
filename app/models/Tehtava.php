<?php

class Tehtava extends BaseModel {

    public $id, $nimi, $suoritettu, $hyväksyjä, $kuvaus;

    public function __construct($attributes = null) {
        parent::__construct($attributes);
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

}
