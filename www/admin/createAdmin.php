<?php

$bdd = new PDO('mysql:host=db.3wa.io;dbname=davidrotolo_randonnees;charset=utf8','davidrotolo','1dab2f9c1a3dc3f96a1229b7f7684115');

$email='zedavid@hotmail.fr';
$mdp=password_hash('D@vid1985',PASSWORD_DEFAULT);
$prenom='David';
$nom='Rotolo';

$query=$bdd->prepare('INSERT INTO admin(nom, prenom, mail, password) VALUES(?,?,?,?)');
$query->execute([$nom,$prenom,$email,$mdp]);