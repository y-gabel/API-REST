<?php

	require_once("modele/zone.php");
	class controleurZone {

		public static function getNearestZones(){
            if (!Util::verifPostArgs("latitude","longitude" )){
                echo(json_encode(Util::reponseMauvaiseRqt()));
                return;
            }
            $latitude = $_POST["latitude"];
            $longitude = $_POST["longitude"];

			if ($rep = Zone::getNearestZones($latitude,$longitude)) {
			    $reponse = Util::reponseOk("Voici toutes les zones proches de la position actuelle",$rep);
			    echo(json_encode($reponse));
			} else {
			    echo(json_encode(Util::reponseNonTrouver()));
			}
		}

		public static function getZoneById(){
            if (!Util::verifPostArgs("id")){
                echo(json_encode(Util::reponseMauvaiseRqt()));
                return;
            }
            $id = $_POST["id"];

			if ($rep = Zone::getZoneById($id)) {
				$reponse =Util::reponseOk('Voici la zone correspondante à l id : $id',$rep);
				echo(json_encode($reponse));
			} else {
				echo(json_encode(Util::reponseNonTrouver()));
			}
		}
		
}
?>