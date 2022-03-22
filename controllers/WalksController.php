<?php
require 'models/Walks.php';

class WalksController
{
    private $walk;

    public function __construct(){
        $this->walk = new Walks();

    }

    public function walkById():void{
        if(array_key_exists('id_walk',$_GET) && is_numeric( $_GET['id_walk'])){
            $idWalk = $_GET['id_walk'];

            $detailsWalk = $this->walk->getWalkById($idWalk);

            $walkName = strtolower($detailsWalk['nom_rando']);
            $historicWalk = $this->walk->historicWalkByName($walkName);

            $template= 'www/walksPage/walk';
            require 'www/layout.phtml';
        }
        else{
            header('location:index.php');
            exit();
        }
    }

    public function walksList():void{
        $ListWalks = $this->walk->getWalksList();

        $template = 'www/walksPage/walkslists';
        require 'www/layout.phtml';
    }
}