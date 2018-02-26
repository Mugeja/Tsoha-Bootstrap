INSERT INTO Käyttäjä (nimi, salasana, status) VALUES ('Arttu', 'huonosalasana', 'vastaava');
INSERT INTO Käyttäjä (nimi, salasana, status) VALUES ('Typerä fuksi', 'suolasana', 'fuksi');
INSERT INTO Käyttäjä (nimi, salasana, status) VALUES ('SuuriJaMahtavaTuutori', 'MATRIX', 'tuutori');

INSERT INTO Tehtävä (nimi, status, tila) VALUES ('Hyppää kaivoon', 'fuksi',
'aktiivinen');
INSERT INTO Tehtävä (nimi, status, tila) VALUES ('Osta tuutorivastaavalle kalja',
'tuutori', 'ei');

INSERT INTO Käyttäjän_tehtävät (käyttäjä_id, tehtävä_id, kuvaus, suoritettu, hyväksyjä) VALUES (1, 1, 'yksi', 'kyllä', 'vastaava');
INSERT INTO Käyttäjän_tehtävät (käyttäjä_id, tehtävä_id, kuvaus, suoritettu) VALUES (2, 2, 'kaksi', 'ei');
INSERT INTO Käyttäjän_tehtävät (käyttäjä_id, tehtävä_id, kuvaus, suoritettu) VALUES (3, 3, 'kolme', 'ei');
INSERT INTO Käyttäjän_tehtävät (käyttäjä_id, tehtävä_id, kuvaus, suoritettu) VALUES (4, 4, 'neljä', 'ei');