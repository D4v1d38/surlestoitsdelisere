<?php

class Walks
{
    private $database;
    private $bdd;

    public function __construct(){
        $this->database = new Database();
        $this->bdd = $this->database->getConnectBdd();
    }

    // SELECT QUERIES
    public function getMassifList():array{
        $query = $this->bdd->prepare('SELECT id_massif, nom_massif, introduction 
        FROM massifs 
        ');

        $query->execute();
        $listOfMassifs = $query->fetchAll();
        return $listOfMassifs;
    }

    public function getWalksList():array{
        $query = $this->bdd->prepare('SELECT id_rando,DATE_FORMAT(date,"%d/%m/%y")As dateformat,nom_rando,massif,ville_depart,photo, nom_massif
        FROM randos
        INNER JOIN massifs ON randos.massif = massifs.id_massif');

        $query->execute();
        $walksList = $query->fetchAll();
        return $walksList;
    }

    public function getWalkById(int $idWalk):array{
        $query = $this->bdd->prepare('SELECT id_rando, DATE_FORMAT(date,"%d/%m/%Y") AS dateformat, nom_rando, massif, ville_depart, longi, lat, duree, distance, denivele, calories, resume, lien, photo,massifs.nom_massif,massifs.introduction
        FROM randos 
        INNER JOIN massifs ON massifs.id_massif =randos.massif
        WHERE id_rando = ?');

        $query->execute([$idWalk]);
        $oneWalk = $query->fetch();
        return $oneWalk;
    }

    public function getMassifById(int $idMAssif):array{
        $query = $this->bdd->prepare('SELECT id_massif, nom_massif, introduction 
        FROM massifs 
        WHERE id_massif=?
        ');

        $query->execute([$idMAssif]);
        $massifById = $query->fetch();
        return $massifById;
    }

    public function historicWalkByName(string $name):array{
        $query = $this->bdd->prepare('SELECT id_rando,DATE_FORMAT(date,"%d/%m/%Y")AS dateformat ,ville_depart,duree,distance,denivele
        FROM `randos` 
        WHERE `nom_rando` = ?
        ORDER BY date DESC');

        $query->execute([$name]);
        $histoByName = $query->fetchAll();
        return $histoByName;
    }

    // INSERT INTO QUERIES
    public function addMassif(string $massifName, string $massifDescription):bool{
        $query = $this->bdd->prepare('INSERT INTO massifs( nom_massif, introduction) 
        VALUES (?,?)');
        
        $test = $query->execute([$massifName,$massifDescription]);
        return $test;
    }

    // UPDATE QUERIES
    

}