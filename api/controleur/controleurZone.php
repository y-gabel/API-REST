<?php

	require_once("modele/zone.php");
	class controleurZone {

		public static function getNearestZones(){
            if (!Util::verifGetArgs("latitude","longitude" )){
                echo(json_encode(Util::reponseMauvaiseRqt()));
                return;
            }
            $latitude = $_GET["latitude"];
            $longitude = $_GET["longitude"];

			if ($rep = Zone::getNearestZones($latitude,$longitude)) {
			    $reponse = Util::reponseOk("Voici toutes les zones proches de la position actuelle",Util::formateTabJson($rep));
			    echo(json_encode($reponse));
			} else {
			    echo(json_encode(Util::reponseNonTrouver()));
			}
		}

		public static function getZoneById(){
            if (!Util::verifGetArgs("id")){
                echo(json_encode(Util::reponseMauvaiseRqt()));
                return;
            }
            $id = $_GET["id"];

			if ($rep = Zone::getZoneById($id)) {
				$reponse =Util::reponseOk('Voici la zone correspondante à l id : $id',$rep);
				echo(json_encode($reponse));
			} else {
				echo(json_encode(Util::reponseNonTrouver()));
			}
		}
		
}
?>