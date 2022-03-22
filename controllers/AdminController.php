<?php
require 'models/Admin.php';

class AdminController{

    private $admin;
    private $function;

    public function __construct(){
        $this->admin = new Admin();
        $this->message = new Functions();
    }

    public function admin():void{
        if(isset($_POST['admin-mail'], $_POST['admin-password'])){
            if(!empty($_POST['admin-mail']) && !empty($_POST['admin-password'])){
                $adminMail = trim($_POST['admin-mail']);
                $adminPwd = trim($_POST['admin-password']);

                //Contrôle si adresse mail existe
                $administrator = $this->admin->getAdminByMail($adminMail);

                if(!$administrator){

                    // le compte n'existe pas, affichage du message d'erreur
                    $this->message->messageInfo("l'adresse mail indiquée n'existe pas",'admin','error-message');
                }else{
                    if(password_verify($adminPwd,$administrator['password'])){
                        // le compte existe et le pwd est correcte: $_SESSION
                        $_SESSION = [
                            'idAdmin' => htmlspecialchars($administrator['id_admin']),
                            'nomAdmin' => htmlspecialchars($administrator['nom']),
                            'prenomAdmin' => htmlspecialchars($administrator['prenom']),
                            'mailAdmin' => htmlspecialchars($administrator['mail'])
                        ];
                    }else{
                        // le pwd est incorrect : message d'erreur
                        $this->message->messageInfo("le mot de passe est incorrect",'admin','error-message');
                    }
                    
                }

            }else{
                $this->message->messageInfo("Veuillez remplir tous les champs",'admin','error-message');
            }
        }

        $template='www/admin/homeAdmin';
        require 'www/layout.phtml';
    }

    public function isAdmin():bool{
        if(isset($_SESSION['mailAdmin'])){
            return true;
        }else{
            return false;
        }
    }

    public function deconnect():void{
        $_SESSION =[];
        session_destroy();
        header("location:index.php");
        exit();
    }
}