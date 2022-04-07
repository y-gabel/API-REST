<?php

	require_once("modele/competence.php");
	class controleurCompetence {
		public static function getCompetenceByID(){
			
			if (isset($_POST["idCompetence"])){
				$id = $_POST["idCompetence"];
			} else {
			    echo(json_encode(Util::reponseMauvaiseRqt()));
                return;
			}

				if ($rep = Competence::getCompetencByID($id)) {
					$reponse = Util::reponseOk("Voici la compétence qui a pour id $id ",$rep);
					echo(json_encode($reponse));
				} else {
				    echo(json_encode(Util::reponseNonTrouver()));
				}

            return;
		}

		public static function getAllCompetences(){
			
				if ($rep = Competence::getAllCompetences()) {
					$reponse = Util::reponseOk("Voici les compétences",$rep);
					echo(json_encode($reponse));
				} else {
				    echo(json_encode(Util::reponseNonTrouver()));
				}

				return;
		}
	}
?>