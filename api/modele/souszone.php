<?php 
	class SousZone {
        public $idSousZone;
        public $nomSousZone;
        public $positionSousZone;
		
		public function __construct($tab){
				$this->idSousZone = $tab["idSousZone"];
				$this->nomSousZone = $tab["nomSousZone"];
				$this->positionSousZone = $tab["positionSousZone"];
		}
		
		public function getIdSousZone(){		return $this->idSousZone; 		}
		public function getNomSousZone(){		return $this->nomSousZone; 	}
		public function getPositionSousZone(){		return $this->positionSousZone; 	}
		
		public function setIdSousZone($idSousZone){		 $this->idSousZone = $idSousZone; 		}
		public function setNomSousZone($nomSousZone){	 $this->nomSousZone = $nomSousZone;		}
		public function setPositionSousZone($positionSousZone){ $this->positionSousZone = $positionSousZone; 	}


		
		static function getSousZoneById($id){
			$requetePreparee = "SELECT * FROM SOUSZONE WHERE idSousZone = :i_tag";
			$req_prep = Connexion::pdo()->prepare($requetePreparee);
			$valeurs = array(
				"i_tag" => $id
			);
			$req_prep->execute($valeurs);
			$resultat = $req_prep->fetch(PDO::FETCH_ASSOC);
			
			if ($req_prep->rowCount() == 0){
				return false;
			} else {
				return new SousZone($resultat);
			}
		}
		
		static function getNearestSousZonesByZoneID($idZone,$latitude,$longitude){
			$requetePreparee = "SELECT latitude, longitude, SQRT(POW(69.1 * (latitude - :la_tag), 2) + POW(69.1 * (:lo_tag - longitude) * COS(latitude / 57.3), 2)) AS distance
								FROM SOUSZONE JOIN Zone ON Zone.idZone = SousZone.idSousZone 
								WHERE idZone = :i_tag
								ORDER BY distance";
			$req_prep = Connexion::pdo()->prepare($requetePreparee);
			$valeurs = array(
				"i_tag" => $idZone,
				"la_tag" => $latitude,
				"lo_tag" => $longitude
			);
			$req_prep->execute($valeurs);
			$resultat = $req_prep->fetchAll(PDO::FETCH_ASSOC);
			
			if ($req_prep->rowCount() == 0){
				return false;
			} else {
				$tab = array();
				foreach($resultat as $key => $val){
					$tab[] = new SousZone($val);
				}
				return $tab;
			}
		}
	}
?>