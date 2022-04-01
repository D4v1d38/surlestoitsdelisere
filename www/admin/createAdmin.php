<?php

$bdd = new PDO('');

$email='';
$mdp=password_hash('',PASSWORD_DEFAULT);
$prenom='';
$nom='';

$query=$bdd->prepare('INSERT INTO admin(nom, prenom, mail, password) VALUES(?,?,?,?)');
$query->execute([$nom,$prenom,$email,$mdp]);