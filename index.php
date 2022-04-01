<?php
session_start();
// Controllers 
// BDD
require "config/Database.php";
require "controllers/AdminController.php";

// functions
require 'functions/Functions.php';

// Routing
if(array_key_exists('action',$_GET)){

    switch($_GET['action']){
        case 'walk_resume':
            require "controllers/WalksController.php";
            $walk = new WalksController();
            $walk->walkById();
        break;

        case 'walk_list':
            require "controllers/WalksController.php";
            $walk = new WalksController();
            $walk->walksList(); 
        break;

        case 'admin':
            $administator = new AdminController();
            $administator->admin();
        break;

        case 'deconnect':
            $administrator =  new AdminController();
            $administrator->deconnect();
        break;
        case 'create_massif' :
            require "controllers/WalksController.php";
            $massif = new WalksController();
            $massif->createMassif();
        break;
    }
}else{
    require "controllers/HomeController.php";
    $homeItems = new HomeController();
    $homeItems->homePageItems();
}
