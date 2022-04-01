<?php

class Database{
    //variables globales
    private $bdd;

    public function __construct(){
        try{
            $this->bdd = new PDO('mysql:host=***host***;dbname=davidrotolo_randonnees;charset=utf8','***user***','***password***');
            
        }
        catch(Exception $e){
            die("message d'erreur : " .$e->getMessage() );
        }
    }

    public function getConnectBdd(){
        return $this->bdd;
    }
}
