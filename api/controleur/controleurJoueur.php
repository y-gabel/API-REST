<?php

	require_once("modele/joueur.php");
        class controleurJoueur {

           /* public static function getJoueurByMail(){
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

            }*/

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

            public static function getJoueurByIdGoogle(){
                if (!Util::verifGetArgs("idGoogle")){
                    echo(json_encode(Util::reponseMauvaiseRqt()));
                    return;
                }
                $id = $_GET["idGoogle"];

                if ( $unJoueur = Joueur::getJoueurByIdGoogle($id) ){
                    echo(json_encode(Util::reponseOk("voici le joueur ayant pour idGoogle $id ",get_object_vars($unJoueur))));
                } else {
                    echo(json_encode(Util::reponseNonTrouver()));
                }
            }

            public static function insertJoueur(){
                if (!Util::verifGetArgs("idGoogle")){
                    echo(json_encode(Util::reponseMauvaiseRqt()));
                    return;
                }

                $idGoogle = $_GET["idGoogle"];

                if ( $rep = Joueur::insertJoueur($idGoogle)){
                    $reponse = Util::reponseOk("Joueur $idGoogle ins??r??",$rep);
                    echo(json_encode($reponse));

                } else {
                    echo(json_encode(Util::reponseMauvaiseRqt()));
                }
            }

            public static function leavePartie(){
                if (!Util::verifGetArgs("idGoogle")){
                    echo(json_encode(Util::reponseMauvaiseRqt()));
                    return;
                }
                $id = $_GET["idGoogle"];
                if ( $Joueur = Joueur::getJoueurByIdGoogle($id)){
                    $idJoueur = $Joueur->getIdJoueur();
                }
                if ( $unJoueur = Joueur::leavePartie($idJoueur)){
                    echo(json_encode(Util::reponseOk("le joueur ayant pour idJoueur $idJoueur ?? bien quitt?? la partie",get_object_vars($unJoueur))));
                } else {
                    echo(json_encode(Util::reponseNonTrouver()));

                }
            }

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

            public static function deleteJoueurByGoogleID(){
                if (!Util::verifGetArgs("idGoogle")){
                    echo(json_encode(Util::reponseMauvaiseRqt()));
                    return;
                }
                $id = $_GET["idGoogle"];

                if ( $unJoueur = Joueur::deleteJoueurByGoogleID($id) ){
                    echo(json_encode(Util::reponseOk("le joueur ayant pour idGoogle $id a bien ??t?? supprim?? ",get_object_vars($unJoueur))));
                } else {
                    echo(json_encode(Util::reponseNonTrouver()));
                }
            }

            public static function deleteJoueurByID(){
                if (!Util::verifGetArgs("idJoueur")){
                    echo(json_encode(Util::reponseMauvaiseRqt()));
                    return;
                }
                $id = $_GET["idJoueur"];

                if ( $unJoueur = Joueur::deleteJoueurByID($id) ){
                    echo(json_encode(Util::reponseOk("Le joueur ayant pour idGoogle $id a bien ??t?? supprim??",get_object_vars($unJoueur))));
                } else {
                    echo(json_encode(Util::reponseNonTrouver()));
                }
            }

            public static function getLesParties(){
                if (!Util::verifGetArgs("idGoogle")){
                    echo(json_encode(Util::reponseMauvaiseRqt()));
                    return;
                }
                $id = $_GET["idGoogle"];
                if ( $Joueur = Joueur::getJoueurByIdGoogle($id)){
                    $idJoueur = $Joueur->getIdJoueur();
                }
;
                if ( $rep = Joueur::getLesParties($idJoueur) ){
                    $reponse = Util::reponseOk("Voici les parties du joueur ayant pour id $idJoueur ",Util::formateTabJson($rep));
                    echo(json_encode($reponse));
                } else {
                     echo(json_encode(Util::reponseNonTrouver()));
                }

            }

            public static function getPartieActuel(){
                if (!Util::verifGetArgs("idGoogle")){
                    echo(json_encode(Util::reponseMauvaiseRqt()));
                    return;
                }
                $id = $_GET["idGoogle"];
                if ( $Joueur = Joueur::getJoueurByIdGoogle($id)){
                    $idJoueur = $Joueur->getIdJoueur();
                }

                if ( $rep = Joueur::getPartieActuel($idJoueur) ){
                    $reponse = Util::reponseOk("Voici la partie actuelle du joueur ayant pour id $idJoueur ",$rep);
                     echo(json_encode($reponse));
                } else {
                    echo(json_encode(Util::reponseNonTrouver()));
                }
            }

            public static function getLesCompetencesDebloques(){
                if (!Util::verifGetArgs("idGoogle")){
                    echo(json_encode(Util::reponseMauvaiseRqt()));
                    return;
                }
                $id = $_GET["idGoogle"];
                if ( $Joueur = Joueur::getJoueurByIdGoogle($id)){
                    $idJoueur = $Joueur->getIdJoueur();
                }

                if ( $rep = Joueur::getLesCompetencesDebloques($idJoueur) ){
                    $reponse = Util::reponseOk("voici les comp??tences debloqu??s pour le joueur ayant pour idJoueur $idJoueur ",Util::formateTabJson($rep));
                     echo(json_encode($reponse));

                } else {
                     echo(json_encode(Util::reponseNonTrouver()));
                }

            }

            public static function getLesCompetencesNonDebloques(){
                if (!Util::verifGetArgs("idGoogle")){
                    echo(json_encode(Util::reponseMauvaiseRqt()));
                    return;
                }
                $id = $_GET["idGoogle"];
                if ( $Joueur = Joueur::getJoueurByIdGoogle($id)){
                    $idJoueur = $Joueur->getIdJoueur();
                }


                if ( $rep = Joueur::getLesCompetencesNonDebloques($idJoueur) ){
                    $reponse = Util::reponseOk("voici les comp??tences non debloqu??s pour le joueur ayant pour idJoueur $idJoueur ",Util::formateTabJson($rep));
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
                    $reponse = Util::reponseOk("voici les comp??tences utilis?? par le joueur ayant pour idJoueur $id ",Util::formateTabJson($rep));
                     echo(json_encode($reponse));

                } else {
                     echo(json_encode(Util::reponseNonTrouver()));
                }
            }*/

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
                    $reponse = Util::reponseOk("Partie $idPartie lanc??e");
                    echo(json_encode($reponse));

                } else {
                    echo(json_encode(Util::reponseMauvaiseRqt()));
                }
            }
        }


?>