<?php

	require_once("modele/zone.php");
	class controleurZone {

		public static function getNearestZones(){
            if (!Util::verifGetArgs("latitudeZone","longitudeZone" )){
                echo(json_encode(Util::reponseMauvaiseRqt()));
                return;
            }
            $latitude = $_GET["latitudeZone"];
            $longitude = $_GET["longitudeZone"];

			if ($rep = Zone::getNearestZones($latitude,$longitude)) {
			    $reponse = Util::reponseOk("Voici toutes les zones proches de la position actuelle",Util::formateTabJson($rep));
			    echo(json_encode($reponse));
			} else {
			    echo(json_encode(Util::reponseNonTrouver()));
			}
		}

        public static function getAllZones(){

            if ($lesZones = Partie::getAllZones()){
                $reponse = Util::reponseOk("Voici toutes les zones",Util::formateTabJson($lesZones));
                echo(json_encode($reponse));
            } else {
                echo(json_encode(Util::reponseNonTrouver()));
            }

        }

		public static function getZoneById(){
            if (!Util::verifGetArgs("idZone")){
                echo(json_encode(Util::reponseMauvaiseRqt()));
                return;
            }
            $id = $_GET["idZone"];

			if ($rep = Zone::getZoneById($id)) {
				$reponse =Util::reponseOk('Voici la zone correspondante à l idZone: $id',$rep);
				echo(json_encode($reponse));
			} else {
				echo(json_encode(Util::reponseNonTrouver()));
			}
		}
		
}
?>