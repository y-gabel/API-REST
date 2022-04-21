<?php 
	class Zone {
        public $idZone;
        public $latitudeZone;
        public $longitudeZone;
        public $rayonZone;
        public $margeRayonZone;
        public $nomZone;
		
		public function __construct($tab){
				$this->idZone = $tab["idZone"];
				$this->latitudeZone = $tab["latitudeZone"];
				$this->longitudeZone = $tab["longitudeZone"];
				$this->margeRayonZone = $tab["rayonZone"];
				$this->margeRayonZone = $tab["margeRayonZone"];
				$this->nomZone = $tab["nomZone"];
		}
		
		public function getIdZone(){		return $this->idZone; 		}
		public function getLatitudeZone(){		return $this->latitudeZone; 	}
		public function getLongitudeZone(){		return $this->longitudeZone; 	}
		public function getRayonZone(){			return $this->rayonZone; 		}
		public function getMargeRayonZone(){	return $this->margeRayonZone; 	}
		public function getNomZone(){			return $this->nomZone; 			}
		
		public function setIdZone($idZone){		 $this->idZone = $idZone; 		}
		public function setLatitudeZone($latitudeZone){	 $this->latitudeZone = $latitudeZone;		}
		public function setLongitudeZone($longitudeZone){ $this->longitudeZone = $longitudeZone; 	}
		public function setRayonZone($rayonZone){		 $this->rayonZone = $rayonZone; 			}
		public function setMargeRayonZone($margeRayonZone){	 $this->margeRayonZone = $margeRayonZone; }
		public function setNomZone($nomZone){			 $this->nomZone = $nomZone; 				}


		
		static function getZoneById($id){
			$requetePreparee = "SELECT * FROM ZONE WHERE idZone = :i_tag";
			$req_prep = Connexion::pdo()->prepare($requetePreparee);
			$valeurs = array(
				"i_tag" => $id
			);
			$req_prep->execute($valeurs);
			$resultat = $req_prep->fetch(PDO::FETCH_ASSOC);
			
			if ($req_prep->rowCount() == 0){
				return false;
			} else {
				return new Zone($resultat);
			}
		}
		
		static function getNearestZones($latitude,$longitude){
			$requetePreparee = "SELECT latitudeZone, longitudeZone, SQRT(POW(69.1 * (latitudeZone - :la_tag), 2) + POW(69.1 * (:lo_tag - longitudeZone) * COS(latitudeZone / 57.3), 2)) AS distance
								FROM ZONE ORDER BY distance";
			$req_prep = Connexion::pdo()->prepare($requetePreparee);
			$valeurs = array(
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
					$tab[] = new Zone($val);
				}
				return $tab;
			}
		}
	}
?>