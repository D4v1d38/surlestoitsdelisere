<?php

class Home{

    private $database;
    private $bdd;

    public function __construct(){
        $this->database = new Database();
        $this->bdd = $this->database->getConnectBdd();

    }

    public function getLastWalk():array{
        $query = $this->bdd->prepare('SELECT id_rando, DATE_FORMAT(date,"%d/%m/%Y"), nom_rando, massif, ville_depart, longi, lat, duree, distance, denivele, calories, resume, lien,nom_massif,introduction,photo
        FROM randos
        INNER JOIN massifs ON randos.massif = massifs.id_massif
        ORDER BY date DESC
        LIMIT 1');

        $query->execute();

        $lastWalk = $query->fetch();
        return $lastWalk;
    }

    // public function getStatByYear(){

    //     $query=$this->bdd->prepare('SELECT SUM(distance), SUM(duree), SUM(calories)
    //     FROM randos
    //     WHERE DATE_FORMAT(date,"%Y") = DATE_FORMAT(NOW(), "%Y")');
    //     $query->execute();

    //     $statActualYear = $query->fetch();
    //     return $statActualYear;
    // }
    public function getStatByYear(int $year):array{

        $query=$this->bdd->prepare('SELECT SUM(distance) AS totalDist,TIME_TO_SEC(SUM(duree)) AS totalDuration, SUM(calories) As totalCalories
        FROM randos
        WHERE DATE_FORMAT(date,"%Y") = ?');
        $query->execute([$year]);

        $statActualYear = $query->fetch();
        return $statActualYear;
    }

    public function getHistoricWalk():array{
        $query = $this->bdd->prepare('SELECT id_rando,date,nom_rando,ville_depart,photo 
        FROM randos
        ORDER BY date DESC');

        $query->execute();
        $historicWalks = $query->fetchAll();
        return $historicWalks;
    }


}