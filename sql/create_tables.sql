CREATE TABLE Käyttäjä(
id SERIAL PRIMARY KEY,
nimi varchar(100) NOT NULL,
salasana varchar(30) NOT NULL,
status varchar(30) NOT NULL
);

CREATE TABLE Tehtävä(
id SERIAL PRIMARY KEY,
nimi varchar(100) NOT NULL,
kuvaus varchar(250) NOT NULL,
hyväksyjä varchar(100),
suoritettu varchar(10)NOT NULL
);