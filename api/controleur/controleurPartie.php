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
			
			if (isset($_POST["idZone"]) && isset($_POST["latitude"]) && isset($_POST["longitude"])){
				$latitude = $_POST["latitude"];
				$longitude = $_POST["longitude"];
				$idZone = $_POST["idZone"];
			} else {
                echo(json_encode(Util::reponseMauvaiseRqt()));
			}

			if ($rep = Partie::getAllParties()){
				$reponse = Util::reponseOk("Voici toutes les partie",$rep);
                echo(json_encode($reponse));

			} else {
                echo(json_encode(Util::reponseNonTrouver()));
			}
		}

		public static function insertPartie(){

			if (isset($_POST["idPartie"]) && isset($_POST["datePartie"]) && isset($_POST["nbMaxJoueur"]) && isset($_POST["enCours"]) &&  isset($_POST["finie"]) ){
				$i = $_POST["idPartie"];
				$d = $_POST["datePartie"];
				$n = $_POST["nbMaxJoueur"];
				$e = $_POST["enCours"];
				$f = $_POST["finie"];
			} else {
                echo(json_encode(Util::reponseMauvaiseRqt());
			}

			if ( $rep = insertPartie($i,$d,$n,$t,$e,$f) ){
				$reponse = Util::reponseOk("partie insérée",$rep);
                echo(json_encode($reponse));

			} else {
                echo(json_encode(reponseMauvaiseRqt()));
			}

		}

		public static function deletePartie(){

			if (isset($_POST["idPartie"])){
				$i = $_POST["idPartie"];
			} else {
                echo(json_encode(reponseMauvaiseRqt()));
			}

			if ($rep = deletePartie($i)){
				$reponse = reponseOk("partie deleted",$rep);
                echo(json_encode($reponse));

			} else {
                echo(json_encode(reponseMauvaiseRqt()));
			}
		}

		public static function updatePartie(){

			if (isset($_POST["idPartie"]) && isset($_POST["datePartie"]) && isset($_POST["nbMaxJoueur"]) && isset($_POST["enCours"]) &&  isset($_POST["finie"]) ){
				$i = $_POST["idPartie"];
				$d = $_POST["datePartie"];
				$n = $_POST["nbMaxJoueur"];
				$e = $_POST["enCours"];
				$f = $_POST["finie"];
			} else {
                echo(json_encode(reponseMauvaiseRqt()));
			}

			if ( $rep = updatePartie($i,$d,$n,$t,$e,$f) ){
				$reponse = reponseOk("partie updated",$rep);
                echo(json_encode($reponse));

			} else {
                echo(json_encode(reponseMauvaiseRqt()));
		}
	}
?>