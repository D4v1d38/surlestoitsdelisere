<?php

class Database{
    //variables globales
    private $bdd;

    public function __construct(){
        try{
            $this->bdd = new PDO('mysql:host=db.3wa.io;dbname=davidrotolo_randonnees;charset=utf8','davidrotolo','1dab2f9c1a3dc3f96a1229b7f7684115');
            
        }
        catch(Exception $e){
            die("message d'erreur : " .$e->getMessage() );
        }
    }

    public function getConnectBdd(){
        return $this->bdd;
    }
}