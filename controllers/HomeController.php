<?php
require 'models/Home.php';

class HomeController
{
    private $home;

    public function __construct(){
        $this->home = new Home();
        $this->function = new Functions();
    }

    //select last walk

    public function homePageItems():void{
        $actualYear = Date('Y');
        
        $latestWalk         = $this->home->getLastWalk();
        
        //Transformation pour affichage au format d'heure 'xx h xx'
        //suppression des secondes et rempacement des : par h
        $durationWalk = substr($latestWalk['duree'],0,5);
        $durationWalk = str_replace(":"," h ",$durationWalk);
        
        $cumulStatByYear    = $this->home->getStatByYear($actualYear);

        //Calcul de la durée en hh:mm:SS a partir de secondes
        $secondes = $cumulStatByYear['totalDuration'];
        //appel a la fonction pour transformer les secondes en valeur heures/minutes/secondes
        $durationTotal = $this->function->secondsToTime($secondes);
        $duration = $durationTotal[0].' h '.$durationTotal[1];

        $historicWalk = $this->home->getHistoricWalk();

        $template='www/home';
        require 'www/layout.phtml';
    }

}