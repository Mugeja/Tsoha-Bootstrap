CREATE TABLE Käyttäjä(
id SERIAL PRIMARY KEY,
nimi varchar(30) NOT NULL,
salasana varchar(30) NOT NULL
);

CREATE TABLE Tehtävä(
id SERIAL PRIMARY KEY,
nimi varchar(100) NOT NULL,
suoritettu BOOLEAN DEFAULT FALSE
);