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

                    $error = false;
                    $add = false;
                    // controles des données
                    if(is_numeric($massifName) || is_numeric($massifDescription)){
                        $error = true;
                        $this->message->messageInfo('les champs doivent contenir du texte','create_massif','error-message');
                    }
                    // si error est false alors on execute la requete d'insertion
                    if(!$error){
                        $add = $this->walk->addMassif($massifName,$massifDescription);
                    }

                    // Si add renvoie true, alors la requete a été exécutée.
                    if($add === true){
                        $this->message->messageInfo('le massif a été ajouté avec succès','create_massif','success-message');
                    }
                }
                else{
                    $this->message->messageInfo('Veuillez remplir tous les champs','create_massif','error-message');
                }
            }
            else{
                $this->message->messageInfo('Une erreur est survenu lors du traitement','create_massif','error-message');
            }
        }
        else{
            $template = 'www/admin/create_massif';
            require 'www/layout.phtml';
        }
    }

    public function manageMassif():void{
        if(!$this->connect->isAdmin() === true){
            header('location:index.php');
            exit();
        }

        $massifList = $this->walk->getMassifList();

        $template = 'www/admin/massif_manager';
        require 'www/layout.phtml';
    }

    public function updateMassif():void{
        if(!$this->connect->isAdmin() === true){
            header('location:index.php');
            exit();
        }

        if(!empty($_POST)){
            if(isset($_POST['id_massif'], $_POST['massif_name'], $_POST['massif_description'])){
                if(!empty($_POST['id_massif']) && !empty($_POST['massif_name']) && !empty($_POST['massif_description'])){
                    $massifId           = $_POST['id_massif'];
                    $massifName         = $_POST['massif_name'];
                    $massifDescription  = $_POST['massif_description'];

                    $error = false;
                    $update = false;

                    if(is_numeric($massifName) && is_numeric($massifDescription)){
                        $error = true;
                        $this->message->messageInfo('Les champs doivent contenir du texte', 'update_massif', 'error-message');
                    }
                    if($error === false){
                        $update = $this->walk->updateMassif($massifId,$massifName,$massifDescription);
                    }

                    if($update ===true){
                        $this->message->messageInfo('les modifications ont été prises en compte', 'manage_massif', 'success-message');
                    }
                }
                else{
                    $this->message->messageInfo('Tous les champs doivent être completer', 'update_massif', 'error-message');
                }
            }
            else{
                $this->message->messageInfo('Une erreur est survenue lors du traitement du formulaire', 'update_massif', 'error-message');
            }
        }
        else{
            //si le formulaire n'est pas soumis, affichage de form prérempli
            if(array_key_exists('id_massif',$_GET) && is_numeric($_GET['id_massif'])){
                
                $idMassif = htmlspecialchars($_GET['id_massif']);

                $oneMassif = $this->walk->getMassifById($idMassif);
                $template = 'www/admin/update_massif';
                require 'www/layout.phtml';
            }
        }
    }


}