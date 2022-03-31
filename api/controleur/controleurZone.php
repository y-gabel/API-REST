<?php

	require_once("modele/zone.php");
	class controleurZone {

		public static function getNearestZones(){

			if (isset($_POST["latitude"]) && isset($_POST["longitude"])){
				$latitude = $_POST["latitude"];
				$longitude = $_POST["longitude"];
			} else {
				return reponseMauvaiseRqt()
			}

			if ($rep = getNearestZones($latitude,$longitude)) {
				$reponse = reponseOk("Voici toutes les zones proches de la position actuelle",$rep);
				return echo(json_encode($reponse)));
			} else {
				return echo(json_encode(reponseNonTrouver());
			}
		}

		public static function getZoneById(){

			if (isset($_POST["id"])){
				$id = $_POST["id"];

			} else {
				return reponseMauvaiseRqt()
			}
			if ($rep = getZoneById($id)) {
				$reponse = reponseOk('Voici la zone correspondante à l id : $id',$rep);
				return echo(json_encode($reponse)));
			} else {
				return echo(json_encode(reponseNonTrouver());
			}
		}
		
}
?>