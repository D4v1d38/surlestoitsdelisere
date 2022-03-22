<?php

class Walks
{
    private $database;
    private $bdd;

    public function __construct(){
        $this->database = new Database();
        $this->bdd = $this->database->getConnectBdd();
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

    public function historicWalkByName(string $name):array{
        $query = $this->bdd->prepare('SELECT id_rando,DATE_FORMAT(date,"%d/%m/%Y")AS dateformat ,ville_depart,duree,distance,denivele
        FROM `randos` 
        WHERE `nom_rando` = ?
        ORDER BY date DESC');

        $query->execute([$name]);
        $histoByName = $query->fetchAll();
        return $histoByName;
    }
}