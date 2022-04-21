<?php

	require_once("modele/partie.php");
	class controleurPartie {

		public static function getPartieByIdPartie(){
            echo("3");
            if (!Util::verifGetArgs("idPartie")){
                echo(json_encode(Util::reponseMauvaiseRqt()));
                return;
            }
            echo("mmm");
            $idPartie = $_GET["idPartie"];
            if ($rep = Partie::getPartieByIdPartie($idPartie)) {
                $reponse = Util::reponseOk("Voici la partie qui a pour id $idPartie ",$rep);
                echo(json_encode($reponse));
            } else {
                echo(json_encode(Util::reponseNonTrouver()));
            }
        }

		public static function getAllParties(){

			if ($lesParties = Partie::getAllParties()){
				$reponse = Util::reponseOk("Voici toutes les partie",Util::formateTabJson($lesParties));
                echo(json_encode($reponse));
			} else {
                echo(json_encode(Util::reponseNonTrouver()));
			}

		}

		public static function insertPartie(){

            if (!Util::verifGetArgs("idPartie", "nbMaxJoueur", "tempsLimite")){
                echo(json_encode(Util::reponseMauvaiseRqt()));
                return;
            }

            $idPartie = $_GET["idPartie"];
            $nbMaxJoueur = $_GET["nbMaxJoueur"];
            $tempsLimite = $_GET["tempsLimite"];

			Partie::insertPartie($idPartie,$nbMaxJoueur,$tempsLimite,1,0);
            $reponse = Util::reponseOk("partie insérée");
            echo(json_encode($reponse));
		}

		public static function deletePartie(){
            if (!Util::verifGetArgs("idPartie")){
                echo(json_encode(Util::reponseMauvaiseRqt()));
                return;
            }

            $idPartie = $_GET["idPartie"];
			Partie::deletePartie($idPartie);
            $reponse = Util::reponseOk("partie deleted");
            echo(json_encode($reponse));

		}

		public static function updatePartie(){

            if (!Util::verifGetArgs("idPartie", "nbMaxJoueur", "tempsLimite", "enCours", "estFinie")){
                echo(json_encode(Util::reponseMauvaiseRqt()));
                return;
            }


            $idPartie = $_GET["idPartie"];
            $nbMaxJoueur = $_GET["nbMaxJoueur"];
            $tempsLimite = $_GET["tempsLimite"];
            $enCours = $_GET["enCours"];
            $estFinie = $_GET["estFinie"];

            Partie::insertPartie($idPartie,$nbMaxJoueur,$tempsLimite,$enCours,$estFinie);
            $reponse = Util::reponseOk("Partie mise à jour");
            echo(json_encode($reponse));

		}
	}
?>