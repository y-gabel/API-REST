<?php

	require_once("modele/joueur.php");
        class controleurJoueur {

            public static function getJoueurByMail(){
                if (!Util::verifGetArgs("mail")){
                    echo(json_encode(Util::reponseMauvaiseRqt()));
                    return;
                }

                $mail = $_GET["mail"];

                if ( $rep =	Joueur::getJoueurByMail($mail) ){
                    $reponse = Util::reponseOk("voici le joueur ayant pour mail $mail ",$rep);
                     echo(json_encode($reponse));
                } else {
                     echo(json_encode(Util::reponseNonTrouver()));
                }

            }

            public static function getJoueurById(){
                if (!Util::verifGetArgs("idJoueur")){
                    echo(json_encode(Util::reponseMauvaiseRqt()));
                    return;
                }
                $id = $_GET["idJoueur"];

                if ( $unJoueur = Joueur::getJoueurById($id) ){
                    echo(json_encode(Util::reponseOk("voici le joueur ayant pour idJoueur $id ",get_object_vars($unJoueur))));
                } else {
                    echo(json_encode(Util::reponseNonTrouver()));
                }
            }

            public static function getLesParties(){
                if (!Util::verifGetArgs("idJoueur")){
                    echo(json_encode(Util::reponseMauvaiseRqt()));
                    return;
                }

                $idJoueur = $_GET["idJoueur"];

                if ( $rep = Joueur::getLesParties($idJoueur) ){
                    $reponse = Util::reponseOk("Voici les parties du joueur ayant pour id $idJoueur ",Util::formateTabJson($rep));
                    echo(json_encode($reponse));
                } else {
                     echo(json_encode(Util::reponseNonTrouver()));
                }

            }

            public static function getPartieActuel(){
                if (!Util::verifGetArgs("idJoueur")){
                    echo(json_encode(Util::reponseMauvaiseRqt()));
                    return;
                }
                $idJoueur = $_GET["idJoueur"];

                if ( $rep = Joueur::getPartieActuel($idJoueur) ){
                    $reponse = Util::reponseOk("Voici la partie actuelle du joueur ayant pour id $idJoueur ",$rep);
                     echo(json_encode($reponse));
                } else {
                    echo(json_encode(Util::reponseNonTrouver()));
                }
            }


            public static function getLesCompetencesDebloques(){
                if (!Util::verifGetArgs("idJoueur")){
                    echo(json_encode(Util::reponseMauvaiseRqt()));
                    return;
                }
                $id = $_GET["idJoueur"];

                if ( $rep = Joueur::getLesCompetencesDebloques($id) ){
                    $reponse = Util::reponseOk("voici les compétences debloqués pour le joueur ayant pour idJoueur $id ",Util::formateTabJson($rep));
                     echo(json_encode($reponse));

                } else {
                     echo(json_encode(Util::reponseNonTrouver()));
                }

            }
            public static function getLesCompetencesNonDebloques(){
                if (!Util::verifGetArgs("idJoueur")){
                    echo(json_encode(Util::reponseMauvaiseRqt()));
                    return;
                }
                $id = $_GET["idJoueur"];

                if ( $rep = Joueur::getLesCompetencesNonDebloques($id) ){
                    $reponse = Util::reponseOk("voici les compétences non debloqués pour le joueur ayant pour idJoueur $id ",Util::formateTabJson($rep));
                     echo(json_encode($reponse));

                } else {
                     echo(json_encode(Util::reponseNonTrouver()));
                }

            }
           /* public static function getLesCompetencesUtilise(){
                if (!Util::verifGetArgs("idJoueur")){
                    echo(json_encode(Util::reponseMauvaiseRqt()));
                    return;
                }
                $id = $_GET["idJoueur"];

                if ( $rep = Joueur::getLesCompetencesUtilise($id) ){
                    $reponse = Util::reponseOk("voici les compétences utilisé par le joueur ayant pour idJoueur $id ",Util::formateTabJson($rep));
                     echo(json_encode($reponse));

                } else {
                     echo(json_encode(Util::reponseNonTrouver()));
                }
            }*/


            public static function updateSolde(){
                if (!Util::verifGetArgs("idGoogle","solde" )){
                    echo(json_encode(Util::reponseMauvaiseRqt()));
                    return;
                }

                $idGoogle = $_GET["idGoogle"];
                $solde = $_GET["solde"];
                $leJoueur = Joueur::getJoueurByIdGoogle($idGoogle);

                if ( $leJoueur && $rep = Joueur::updateSolde($leJoueur->getIdJoueur(),$solde)){
                    $reponse = Util::reponseOk("Joueur $idGoogle updated",$rep);
                     echo(json_encode($reponse));
                } else {
                     echo(json_encode(Util::reponseMauvaiseRqt()));
                }

            }

            public static function insertJoueur(){
                if (!Util::verifGetArgs("idGoogle")){
                    echo(json_encode(Util::reponseMauvaiseRqt()));
                    return;
                }

                $idGoogle = $_GET["idGoogle"];
                if ( $rep = Joueur::insertJoueur($idGoogle)){
                    $reponse = Util::reponseOk("Joueur $idGoogle inséré",$rep);
                     echo(json_encode($reponse));

                } else {
                     echo(json_encode(Util::reponseMauvaiseRqt()));
                }
            }

            public static function ping(){
                echo(json_encode(Util::reponseOk("Ping Ok")));
            }
			
			public function lancerPartie(){
                if (!Util::verifGetArgs("idPartie")){
                    echo(json_encode(Util::reponseMauvaiseRqt()));
                    return;
                }

                $idPartie = $_GET["idPartie"];

                if (Joueur::lancerPartie($idPartie)){
                    $reponse = Util::reponseOk("Partie $id lancée");
                    echo(json_encode($reponse));

                } else {
                    echo(json_encode(Util::reponseMauvaiseRqt()));
                }
            }
        }


?>