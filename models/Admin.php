<?php

class Admin{

    private $database;
    private $bdd;
    
    public function __construct(){
        $this->database = new Database();
        $this->bdd = $this->database->getConnectBdd();
    }

    public function getAdminByMail(string $mail): ?array{
        $query = $this->bdd->prepare('SELECT id_admin, nom, prenom, mail, password 
        FROM admin 
        WHERE mail = ?');

        $query->execute([$mail]);

        $admin = $query->fetch();
        return $admin ?: null ; 
    }
}
