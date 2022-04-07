<?php

	require_once("modele/joueur.php");
        class controleurJoueur {

            public static function getJoueurByMail(){

                if (isset($_POST["mail"])){
                    $mail = $_POST["mail"];
                } else {
                     echo(json_encode(Util::reponseMauvaiseRqt()));
                     return;
                }

                if ( $rep =	controleurJoueur::getJoueurByMail($mail) ){
                    $reponse = Util::reponseOk("voici le joueur ayant pour mail $mail ",$rep);
                     echo(json_encode($reponse));
                    return;
                } else {
                     echo(json_encode(Util::reponseNonTrouver()));
                    return;
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
                    return;
                } else {
                    echo(json_encode(Util::reponseNonTrouver()));
                    return;
                }
            }

            public static function getLesParties(){
                $idJoueur = -1;
                if (isset($_POST["idJoueur"])){
                    $idJoueur = $_POST["idJoueur"];
                } else {
                     echo(json_encode(Util::reponseMauvaiseRqt()));
                    return;
                }

                if ( $rep = getLesParties($idJoueur) ){
                    $reponse = Util::reponseOk("Voici les parties du joueur ayant pour id $idJoueur ",$rep);
                    echo(json_encode($reponse));
                    return;
                } else {
                     echo(json_encode(reponseNonTrouver()));
                    return;
                }

            }

            public static function getPartieActuel(){
                $idJoueur = -1;
                if (isset($_POST["idJoueur"])){
                    $idJoueur = $_POST["idJoueur"];
                } else {
                     echo(json_encode(Util::reponseMauvaiseRqt()));
                    return;
                }

                if ( $rep = getPartieActuel($idJoueur) ){
                    $reponse = Util::reponseOk("Voici la partie actuelle du joueur ayant pour id $idJoueur ",$rep);
                     echo(json_encode($reponse));
                    return;
                } else {
                     reponseNonTrouver();
                    return;
                }
            }

            public static function checkMDP(){

                if (isset($_POST["idJoueur"]) && isset($_POST["password"])){
                    $id = $_POST["idJoueur"];
                    $pass = $_POST["password"];
                } else {
                     echo(json_encode(Util::reponseMauvaiseRqt()));
                }

                if ( $rep = checkMDP($id,$pass) ){
                    $reponse = Util::reponseOk("mdp ok",$rep);
                     echo(json_encode($reponse));

                } else {
                     echo(json_encode(reponseNonTrouver()));
                }

            }

            public static function getLesCompetencesDebloques(){

                if (isset($_POST["idJoueur"])){
                    $id = $_POST["idJoueur"];
                } else {
                     echo(json_encode(Util::reponseMauvaiseRqt()));
                }

                if ( $rep = getLesCompetencesDebloques($id) ){
                    $reponse = Util::reponseOk("voici les compétences debloqués pour le joueur ayant pour idJoueur $id ",$rep);
                     echo(json_encode($reponse));

                } else {
                     echo(json_encode(reponseNonTrouver()));
                }

            }
            public static function getLesCompetencesNonDebloques(){

                if (isset($_POST["idJoueur"])){
                    $id = $_POST["idJoueur"];
                } else {
                     echo(json_encode(Util::reponseMauvaiseRqt()));
                }

                if ( $rep = getLesCompetencesNonDebloques($id) ){
                    $reponse = Util::reponseOk("voici les compétences non debloqués pour le joueur ayant pour idJoueur $id ",$rep);
                     echo(json_encode($reponse));

                } else {
                     echo(json_encode(reponseNonTrouver()));
                }

            }
            public static function getLesCompetencesUtilise(){

                if (isset($_POST["idJoueur"])){
                    $id = $_POST["idJoueur"];
                } else {
                     echo(json_encode(Util::reponseMauvaiseRqt()));
                }

                if ( $rep = getLesCompetencesUtilise($id) ){
                    $reponse = Util::reponseOk("voici les compétences utilisé par le joueur ayant pour idJoueur $id ",$rep);
                     echo(json_encode($reponse));

                } else {
                     echo(json_encode(reponseNonTrouver()));
                }
            }

            public static function deleteJoueurByMail(){

                if (isset($_POST["mail"])){
                    $mail = $_POST["mail"];
                } else {
                     echo(json_encode(Util::reponseMauvaiseRqt()));
                }

                if ( $rep = deleteJoueurByMail($mail) ){
                    $reponse = Util::reponseOk("Joueur XXXXX A REFAIRE!!! deleted",$rep);
                     echo(json_encode($reponse));

                } else {
                     echo(json_encode(reponseNonTrouver()));
                }

            }

            public static function deleteJoueurByMail2(){

                if (isset($_POST["mail"])){
                    $mail = $_POST["mail"];
                } else {
                     echo(json_encode(Util::reponseMauvaiseRqt()));
                }

                if ( $rep = deleteJoueurByMail($mail) ){
                    $reponse = Util::reponseOk("Joueur AAAA REFFAIIRRRRRREEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEE deleted",$rep);
                     echo(json_encode($reponse));

                } else {
                     echo(json_encode(reponseNonTrouver()));
                }

            }

            public static function updateJoueur(){

                if (isset($_POST["idJoueur"]) && isset($_POST["mail"]) && isset($_POST["password"]) &&
                isset($_POST["nom"]) && isset($_POST["prenom"])  && isset($_POST["thunasse"])  && isset($_POST["niveau"]) ){

                    $id = $_POST["idJoueur"];
                    $mail = $_POST["mail"];
                    $pass = $_POST["password"];
                    $nom = $_POST["nom"];
                    $pre = $_POST["prenom"];
                    $thune = $_POST["thunasse"];
                    $niv = $_POST["niveau"];
                } else {
                     echo(json_encode(Util::reponseMauvaiseRqt()));
                }

                if ( $rep = updateJoueur($id, $mail, $pass, $nom, $pre, $thune, $niv)){
                    $reponse = Util::reponseOk("Joueur $id updated",$rep);
                     echo(json_encode($reponse));
                } else {
                     echo(json_encode(Util::reponseMauvaiseRqt()));
                }

            }

            public static function insertJoueur(){

                if (isset($_POST["idJoueur"]) && isset($_POST["mail"]) && isset($_POST["password"]) && isset($_POST["dateInscription"])
                     &&  isset($_POST["nom"]) && isset($_POST["prenom"])  && isset($_POST["thunasse"])  && isset($_POST["niveau"]) ){

                    $id = $_POST["idJoueur"];
                    $mail = $_POST["mail"];
                    $pass = $_POST["password"];
                    $dateInsc = $_POST["dateInscription"];
                    $nom = $_POST["nom"];
                    $pre = $_POST["prenom"];
                    $thune = $_POST["thunasse"];
                    $niv = $_POST["niveau"];
                } else {
                     echo(json_encode(Util::reponseMauvaiseRqt()));
                }

                if ( $rep = insertJoueur($id, $mail, $pass, $dateInsc, $nom, $pre, $thune, $niv)){
                    $reponse = Util::reponseOk("Joueur $id inséré",$rep);
                     echo(json_encode($reponse));

                } else {
                     echo(json_encode(Util::reponseMauvaiseRqt()));
                }


            }
        }


?>