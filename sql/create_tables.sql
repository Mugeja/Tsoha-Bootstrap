CREATE TABLE Käyttäjä(
id SERIAL PRIMARY KEY,
nimi varchar(100) NOT NULL,
salasana varchar(30) NOT NULL,
status varchar(30) NOT NULL
);

CREATE TABLE Tehtävä(
id SERIAL PRIMARY KEY,
nimi varchar(100) NOT NULL,
status varchar(100),
tila varchar(10)
);

CREATE TABLE Käyttäjän_tehtävät(
id SERIAL PRIMARY KEY,
käyttäjä_id INTEGER,
tehtävä_id INTEGER,
kuvaus varchar(250),
hyväksyjä varchar(100),
suoritettu varchar(100) NOT NULL
);