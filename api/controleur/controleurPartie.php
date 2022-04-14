<?php

	require_once("modele/partie.php");
	class controleurPartie {

		public static function getPartieByIdPartie(){

            if (!Util::verifPostArgs("idPartie")){
                echo(json_encode(Util::reponseMauvaiseRqt()));
                return;
            }

            $idPartie = $_POST["idPartie"];
            if ($rep = Partie::getPartieByIdPartie($idPartie)) {
                $reponse = Util::reponseOk("Voici la partie qui a pour id $idPartie ",$rep);
                echo(json_encode($reponse));
            } else {
                echo(json_encode(Util::reponseNonTrouver()));
            }
        }

		public static function getAllParties(){

			if ($rep = Partie::getAllParties()){
				$reponse = Util::reponseOk("Voici toutes les partie",$rep);
                echo(json_encode($reponse));

			} else {
                echo(json_encode(Util::reponseNonTrouver()));
			}

		}

		public static function insertPartie(){

            if (!Util::verifPostArgs("idPartie", "nbMaxJoueur", "tempsLimite")){
                echo(json_encode(Util::reponseMauvaiseRqt()));
                return;
            }

            $idPartie = $_POST["idPartie"];
            $nbMaxJoueur = $_POST["nbMaxJoueur"];
            $tempsLimite = $_POST["tempsLimite"];

			Partie::insertPartie($idPartie,$nbMaxJoueur,$tempsLimite,1,0);
            $reponse = Util::reponseOk("partie insérée");
            echo(json_encode($reponse));
		}

		public static function deletePartie(){
            if (!Util::verifPostArgs("idPartie")){
                echo(json_encode(Util::reponseMauvaiseRqt()));
                return;
            }

            $idPartie = $_POST["idPartie"];
			Partie::deletePartie($idPartie);
            $reponse = Util::reponseOk("partie deleted");
            echo(json_encode($reponse));

		}

		public static function updatePartie(){

            if (!Util::verifPostArgs("idPartie", "nbMaxJoueur", "tempsLimite", "enCours", "estFinie")){
                echo(json_encode(Util::reponseMauvaiseRqt()));
                return;
            }


            $idPartie = $_POST["idPartie"];
            $nbMaxJoueur = $_POST["nbMaxJoueur"];
            $tempsLimite = $_POST["tempsLimite"];
            $enCours = $_POST["enCours"];
            $estFinie = $_POST["estFinie"];

            Partie::insertPartie($idPartie,$nbMaxJoueur,$tempsLimite,$enCours,$estFinie);
            $reponse = Util::reponseOk("Partie mise à jour");
            echo(json_encode($reponse));

		}
	}
?>