<?php

	require_once("modele/souszone.php");
	class controleurSousZone {

		public static function getSousZoneById(){

			if (isset($_POST["id"])){
				$id = $_POST["id"];
			} else {
				return echo(json_encode(reponseMauvaiseRqt());
			}
			
			if ($rep = getSousZoneById($id)) {
				$reponse = reponseOk('Voici la sous-zone correspondante à l id : $id',$rep);
				return echo(json_encode($reponse)));
			} else {
				return echo(json_encode(reponseNonTrouver());
			}
			
		}
		
		public static function getNearestSousZonesByZoneID(){

			if (isset($_POST["idZone"]) && isset($_POST["latitude"]) && isset($_POST["longitude"])){
				$latitude = $_POST["latitude"];
				$longitude = $_POST["longitude"];
				$idZone = $_POST["idZone"];
			}else {
				return echo(json_encode(reponseMauvaiseRqt());
			}
			
			if ($rep = getNearestSousZonesByZoneID($idZone,$latitude,$longitude)) {
				$reponse = reponseOk("Voici toutes les sous-zones proches de la position actuelle",$rep);
				return echo(json_encode($reponse)));
			} else {
				return echo(json_encode(reponseNonTrouver());
			}
		}
		
	}
?>