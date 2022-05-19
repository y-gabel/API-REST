<?php

	require_once("modele/partie.php");
	class controleurPartie {

		public static function getPartieByIdPartie(){
            if (!Util::verifGetArgs("idPartie")){
                echo(json_encode(Util::reponseMauvaiseRqt()));
                return;
            }

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

            if (!Util::verifGetArgs("idPartie", "enCours", "datePartie", "estFinie", "nbMaxJoueur","tempsLimite")){
                echo(json_encode(Util::reponseMauvaiseRqt()));
                return;
            }

            $idPartie = $_GET["idPartie"];
            $enCours = $_GET["enCours"];
            $datePartie = $_GET["datePartie"];
            $estFinie = $_GET["estFinie"];
            $nbMaxJoueur = $_GET["nbMaxJoueur"];
            $tempsLimite = $_GET["tempsLimite"];


			Partie::insertPartie($idPartie,$enCours,$datePartie,$estFinie,$nbMaxJoueur,$tempsLimite);
            $reponse = Util::reponseOk("Partie insérée");
            echo(json_encode($reponse));
		}

		public static function deletePartie(){
            if (!Util::verifGetArgs("idPartie")){
                echo(json_encode(Util::reponseMauvaiseRqt()));
                return;
            }

            $idPartie = $_GET["idPartie"];
			Partie::deletePartie($idPartie);
            $reponse = Util::reponseOk("Partie supprimer");
            echo(json_encode($reponse));

		}

		public static function updatePartie(){

            if (!Util::verifGetArgs("idPartie", "enCours", "datePartie", "estFinie", "nbMaxJoueur","tempsLimite")){
                echo(json_encode(Util::reponseMauvaiseRqt()));
                return;
            }


            $idPartie = $_GET["idPartie"];
            $enCours = $_GET["enCours"];
            $datePartie = $_GET["datePartie"];
            $estFinie = $_GET["estFinie"];
            $nbMaxJoueur = $_GET["nbMaxJoueur"];
            $tempsLimite = $_GET["tempsLimite"];

            Partie::updatePartie($idPartie,$enCours,$datePartie,$estFinie,$nbMaxJoueur,$tempsLimite);
            $reponse = Util::reponseOk("Partie mise à jour");
            echo(json_encode($reponse));

		}


        public function lancerPartie(){
            if (!Util::verifGetArgs("idPartie")){
                echo(json_encode(Util::reponseMauvaiseRqt()));
                return;
            }

            $idPartie = $_GET["idPartie"];

            if (Partie::lancerPartie($idPartie)){
                $reponse = Util::reponseOk("Partie $idPartie lancée");
                echo(json_encode($reponse));

            } else {
                echo(json_encode(Util::reponseMauvaiseRqt()));
            }
        }
	}
?>