<?php 
	class Zone {
		private $idZone;
		private $latitude;
		private $longitude;
		private $rayon;
		private $margeRayon;
		private $nom;
		
		public function __construct($tab){
				$this->idZone = $tab["idZone"];
				$this->latitude = $tab["latitude"];
				$this->longitude = $tab["longitude"];
				$this->rayon = $tab["rayon"];
				$this->margeRayon = $tab["margeRayon"];
				$this->nom = $tab["nom"];
		}
		
		public function getIdZone(){		return $this->idZone; 		}
		public function getLatitude(){		return $this->latitude; 	}
		public function getLongitude(){		return $this->longitude; 	}
		public function getRayon(){			return $this->rayon; 		}
		public function getMargeRayon(){	return $this->margeRayon; 	}
		public function getNom(){			return $this->nom; 			}
		
		public function setIdZone($idZone){		 $this->idZone = $idZone; 		}
		public function setLatitude($latitude){	 $this->latitude = $latitude;		}
		public function setLongitude($longitude){ $this->longitude = $longitude; 	}
		public function setRayon($rayon){		 $this->rayon = $rayon; 			}
		public function setMargeRayon($margeRayon){	 $this->margeRayon = $margeRayon; }
		public function setNom($nom){			 $this->nom = $nom; 				}


		
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
			$requetePreparee = "SELECT latitude, longitude, SQRT(POW(69.1 * (latitude - :la_tag), 2) + POW(69.1 * (:lo_tag - longitude) * COS(latitude / 57.3), 2)) AS distance
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