CREATE TABLE Käyttäjä(
id SERIAL PRIMARY KEY,
nimi varchar(255) NOT NULL,
salasana varchar(255) NOT NULL,
status varchar(255) NOT NULL
);

CREATE TABLE Tehtävä(
id SERIAL PRIMARY KEY,
nimi varchar(255) NOT NULL,
status varchar(255),
tila varchar(255)
);

CREATE TABLE Käyttäjän_tehtävät(
id SERIAL PRIMARY KEY,
käyttäjä_id INTEGER,
tehtävä_id INTEGER,
kuvaus varchar(255),
hyväksyjä varchar(255),
suoritettu varchar(255) NOT NULL
);