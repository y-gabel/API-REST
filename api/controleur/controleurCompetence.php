<?php

	require_once("modele/competence.php");
	class controleurCompetence {
		public static function getCompetenceByID(){
			
			if (isset($_POST["idCompetence"])){
				$id = $_POST["idCompetence"];
			} else {
				return echo(json_encode(reponseMauvaiseRqt());
			}

				if ($rep = getCompetencByID($id)) {
					$reponse = reponseOk("Voici la compétence qui a pour id $id ",$rep);
					return echo(json_encode($reponse)));
				} else {
					return echo(json_encode(reponseNonTrouver());
				}
		}

		public static function getAllCompetences(){
			
				if ($rep = getCompetencByID($)) {
					$reponse = reponseOk("Voici les compétences",$rep);
					return echo(json_encode($reponse)));
				} else {
					return echo(json_encode(reponseNonTrouver());
				}
		}
	}
?>