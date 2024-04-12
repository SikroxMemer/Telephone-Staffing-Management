CREATE DATABASE IF NOT EXISTS GDT;
USE GDT;
CREATE TABLE IF NOT EXISTS Utilisateur (
    ID INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    Username VARCHAR(75),
    Password VARCHAR(100),
    Nom VARCHAR(100),
    Prenom VARCHAR(100),
    Profile ENUM('Admin', 'Oberateur', 'Observateur')
);
CREATE TABLE IF NOT EXISTS Puce (
    ID INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    Type VARCHAR(25),
    Fourniseur VARCHAR(25),
    Tel VARCHAR(25),
    isActive BOOLEAN
);
CREATE TABLE IF NOT EXISTS Entity (
    ID INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    Nom VARCHAR(25)
);
CREATE TABLE IF NOT EXISTS Personnel (
    ID INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    Matricule VARCHAR(75),
    Nom VARCHAR(75),
    Prenom VARCHAR(75),
    Entity INT,
    FOREIGN KEY (Entity) REFERENCES Entity(id)
);
CREATE TABLE IF NOT EXISTS Dotation (
    ID INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    Type VARCHAR(50),
    isActive BOOLEAN,
    Puce INT,
    FOREIGN KEY (Puce) REFERENCES Puce(id)
);
CREATE TABLE IF NOT EXISTS Affectation (
    ID INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    Observation VARCHAR(100),
    Puce INT,
    FOREIGN KEY (Puce) REFERENCES Puce(id),
    Personnel INT,
    FOREIGN KEY (Personnel) REFERENCES Personnel(id)
);