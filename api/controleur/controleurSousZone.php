<?php

	require_once("modele/souszone.php");
	class controleurSousZone {

		public static function getSousZoneById(){
            if (!Util::verifPostArgs("id")){
                echo(json_encode(Util::reponseMauvaiseRqt()));
                return;
            }
            $id = $_POST["id"];

			if ($rep = SousZone::getSousZoneById($id)) {
				$reponse = Util::reponseOk('Voici la sous-zone correspondante à l id : $id',$rep);
				echo(json_encode($reponse));
			} else {
				echo(json_encode(Util::reponseNonTrouver()));
			}
			
		}
		
		public static function getNearestSousZonesByZoneID(){
            if (!Util::verifPostArgs("idZone","latitude","longitude")){
                echo(json_encode(Util::reponseMauvaiseRqt()));
                return;
            }
            $latitude = $_POST["latitude"];
            $longitude = $_POST["longitude"];
            $idZone = $_POST["idZone"];

			if ($rep = SousZone::getNearestSousZonesByZoneID($idZone,$latitude,$longitude)) {
				$reponse = Util::reponseOk("Voici toutes les sous-zones proches de la position actuelle",$rep);
				echo(json_encode($reponse));
			} else {
				echo(json_encode(Util::reponseNonTrouver()));
			}
		}
		
	}
?>