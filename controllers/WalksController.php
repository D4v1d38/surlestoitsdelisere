<?php
require 'models/Walks.php';

class WalksController
{
    private $walk;

    public function __construct(){
        $this->walk = new Walks();
        $this->connect = new AdminController();
        $this->message = new Functions();

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

    // Admin functions

    public function createMassif():void{
        if(!$this->connect->isAdmin() === true){
            header("location:index.php");
            exit();
        }

        if(!empty($_POST)){
            if(isset($_POST['massif_name'], $_POST['massif_description'])){
                if(!empty($_POST['massif_name']) && !empty($_POST['massif_description'])){
                    $massifName         = $_POST['massif_name'];
                    $massifDescription  = $_POST['massif_description'];

                }
                else{
                    $this->message->messageInfo('Veuillez remplir tous les champs','create_massif','error-message');
                }

            }
        }
        else{
            $template = 'www/admin/create_massif';
            require 'www/layout.phtml';
        }


    }
}