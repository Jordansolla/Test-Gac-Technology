<?php

class Connexion{

    public function connect(){
        try {
            $db = new PDO('mysql:host=localhost;dbname=tickets_appel', 'root', '');
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage() . "<br/>";
            die();
        }
    }

}