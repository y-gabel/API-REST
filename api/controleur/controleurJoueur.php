<?php

	require_once("modele/joueur.php");
        class controleurJoueur {

            public static function getJoueurByMail(){
                if (!Util::verifPostArgs("mail")){
                    echo(json_encode(Util::reponseMauvaiseRqt()));
                    return;
                }

                $mail = $_POST["mail"];

                if ( $rep =	Joueur::getJoueurByMail($mail) ){
                    $reponse = Util::reponseOk("voici le joueur ayant pour mail $mail ",$rep);
                     echo(json_encode($reponse));
                } else {
                     echo(json_encode(Util::reponseNonTrouver()));
                }

            }

            public static function getJoueurById(){
                if (!Util::verifPostArgs("idJoueur")){
                    echo(json_encode(Util::reponseMauvaiseRqt()));
                    return;
                }
                $id = $_POST["idJoueur"];

                if ( $unJoueur = Joueur::getJoueurById($id) ){
                    echo(json_encode(Util::reponseOk("voici le joueur ayant pour idJoueur $id ",get_object_vars($unJoueur))));
                } else {
                    echo(json_encode(Util::reponseNonTrouver()));
                }
            }

            public static function getLesParties(){
                if (!Util::verifPostArgs("idJoueur")){
                    echo(json_encode(Util::reponseMauvaiseRqt()));
                    return;
                }

                $idJoueur = $_POST["idJoueur"];

                if ( $rep = Joueur::getLesParties($idJoueur) ){
                    $reponse = Util::reponseOk("Voici les parties du joueur ayant pour id $idJoueur ",$rep);
                    echo(json_encode($reponse));
                } else {
                     echo(json_encode(Util::reponseNonTrouver()));
                }

            }

            public static function getPartieActuel(){
                if (!Util::verifPostArgs("idJoueur")){
                    echo(json_encode(Util::reponseMauvaiseRqt()));
                    return;
                }
                $idJoueur = $_POST["idJoueur"];

                if ( $rep = Joueur::getPartieActuel($idJoueur) ){
                    $reponse = Util::reponseOk("Voici la partie actuelle du joueur ayant pour id $idJoueur ",$rep);
                     echo(json_encode($reponse));
                } else {
                    echo(json_encode(Util::reponseNonTrouver()));
                }
            }

            public static function checkMDP(){

                if (!Util::verifPostArgs("idJoueur","password")){
                    echo(json_encode(Util::reponseMauvaiseRqt()));
                    return;
                }

                $id = $_POST["idJoueur"];
                $pass = $_POST["password"];


                if ( $rep = Joueur::checkMDP($id,$pass) ){
                    $reponse = Util::reponseOk("mdp ok",$rep);
                     echo(json_encode($reponse));

                } else {
                     echo(json_encode(Util::reponseNonTrouver()));
                }

            }

            public static function getLesCompetencesDebloques(){
                if (!Util::verifPostArgs("idJoueur")){
                    echo(json_encode(Util::reponseMauvaiseRqt()));
                    return;
                }
                $id = $_POST["idJoueur"];

                if ( $rep = Joueur::getLesCompetencesDebloques($id) ){
                    $reponse = Util::reponseOk("voici les compétences debloqués pour le joueur ayant pour idJoueur $id ",$rep);
                     echo(json_encode($reponse));

                } else {
                     echo(json_encode(Util::reponseNonTrouver()));
                }

            }
            public static function getLesCompetencesNonDebloques(){
                if (!Util::verifPostArgs("idJoueur")){
                    echo(json_encode(Util::reponseMauvaiseRqt()));
                    return;
                }
                $id = $_POST["idJoueur"];

                if ( $rep = Joueur::getLesCompetencesNonDebloques($id) ){
                    $reponse = Util::reponseOk("voici les compétences non debloqués pour le joueur ayant pour idJoueur $id ",$rep);
                     echo(json_encode($reponse));

                } else {
                     echo(json_encode(Util::reponseNonTrouver()));
                }

            }
            public static function getLesCompetencesUtilise(){
                if (!Util::verifPostArgs("idJoueur")){
                    echo(json_encode(Util::reponseMauvaiseRqt()));
                    return;
                }
                $id = $_POST["idJoueur"];

                if ( $rep = Joueur::getLesCompetencesUtilise($id) ){
                    $reponse = Util::reponseOk("voici les compétences utilisé par le joueur ayant pour idJoueur $id ",$rep);
                     echo(json_encode($reponse));

                } else {
                     echo(json_encode(Util::reponseNonTrouver()));
                }
            }

            public static function deleteJoueurByMail(){
                if (!Util::verifPostArgs("mail")){
                    echo(json_encode(Util::reponseMauvaiseRqt()));
                    return;
                }
                $mail = $_POST["mail"];

                if ( $rep = Joueur::deleteJoueurByMail($mail) ){
                    $reponse = Util::reponseOk("Joueur deleted",$rep);
                     echo(json_encode($reponse));

                } else {
                     echo(json_encode(Util::reponseNonTrouver()));
                }

            }

            public static function updateJoueur(){
                if (!Util::verifPostArgs("idJoueur","mail","password", "nom", "prenom", "thunasse" ,"niveau" )){
                    echo(json_encode(Util::reponseMauvaiseRqt()));
                    return;
                }
                    $id = $_POST["idJoueur"];
                    $mail = $_POST["mail"];
                    $pass = $_POST["password"];
                    $nom = $_POST["nom"];
                    $pre = $_POST["prenom"];
                    $thune = $_POST["thunasse"];
                    $niv = $_POST["niveau"];

                if ( $rep = Joueur::updateJoueur($id, $mail, $pass, $nom, $pre, $thune, $niv)){
                    $reponse = Util::reponseOk("Joueur $id updated",$rep);
                     echo(json_encode($reponse));
                } else {
                     echo(json_encode(Util::reponseMauvaiseRqt()));
                }

            }

            public static function insertJoueur(){
                if (!Util::verifPostArgs("idJoueur","mail","password", "nom", "prenom", "thunasse" ,"niveau" ,"dateInscription")){
                    echo(json_encode(Util::reponseMauvaiseRqt()));
                    return;
                }

                $id = $_POST["idJoueur"];
                $mail = $_POST["mail"];
                $pass = $_POST["password"];
                $dateInsc = $_POST["dateInscription"];
                $nom = $_POST["nom"];
                $pre = $_POST["prenom"];
                $thune = $_POST["thunasse"];
                $niv = $_POST["niveau"];

                if ( $rep = Joueur::insertJoueur($id, $mail, $pass, $dateInsc, $nom, $pre, $thune, $niv)){
                    $reponse = Util::reponseOk("Joueur $id inséré",$rep);
                     echo(json_encode($reponse));

                } else {
                     echo(json_encode(Util::reponseMauvaiseRqt()));
                }
            }
        }


?>