<?php 
	class Participe {
		private $idJoueur;
		private $idPartie;
		private $duree;
		private $score;
		private $role;
		private $estMort;
		private $longitude;
		private $latitude;
		
		public function __construct($tab){
				$this->idJoueur = $tab["idJoueur"];
				$this->idPartie = $tab["idPartie"];
				$this->duree = $tab["duree"];
				$this->score = $tab["score"];
				$this->role = $tab["role"];
				$this->estMort = $tab["estMort"];
				$this->longitude = $tab["longitude"];
				$this->latitude = $tab["latitude"];
		}
		
		public function getIdJoueur(){		return $this->idJoueur; 		}
		public function getIdPartie(){		return $this->idPartie; 		}
		public function getDuree(){		return $this->duree; 		}
		public function getScore(){		return $this->score; 		}
		public function getRole(){		return $this->role; 		}
		public function getEstMort(){		return $this->estMort; 		}
		public function getLongitude(){		return $this->longitude; 		}
		public function getLatitude(){		return $this->latitude; 		}
		
		public function setIdJoueur($idJoueur){	 $this->idJoueur; 		}
		public function setIdPartie($idPartie){	 $this->idPartie; 		}
		public function setDuree($duree){	     $this->duree; 		}
		public function setScore($score){		 $this->score; 		}
		public function setRole($role){		 $this->role; 		}
		public function setEstMort($estMort){	 $this->estMort; 		}
		public function setLongitude($longitude){	 $this->longitude; 		}
		public function setLatitude($latitude){	 $this->latitude; 		}

	}
?>