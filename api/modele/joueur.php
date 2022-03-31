<?php 
	class Joueur {

 		/*------------------------------------------------------------------------------------------------------------------------------
		/////////////////                                         ATTRIBUTS                                            ///////////////// 
		------------------------------------------------------------------------------------------------------------------------------*/       

		private $idJoueur;
		private $mail;
		private $password;
		private $dateInscription;
		private $nom;
		private $prenom;
        private $thunasse;
        private $niveau;

        /*------------------------------------------------------------------------------------------------------------------------------
		/////////////////                                         GETTERS                                              ///////////////// 
		------------------------------------------------------------------------------------------------------------------------------*/

        public function getIdJoueur(){ return $this->idJoueur; }
        public function getMail(){ return $this->mail; }
        public function getPassword(){ return $this->password; }
        public function getDateInscription(){ return $this->dateInscription; }
        public function getNom(){ return $this->nom; }
        public function getPrenom(){ return $this->prenom; }
        public function getThunasse(){ return $this->thunasse; }
        public function getNiveau(){ return $this->niveau; }

        /*------------------------------------------------------------------------------------------------------------------------------
		/////////////////                                         SETTERS                                              ///////////////// 
		------------------------------------------------------------------------------------------------------------------------------*/

        public function setIdJoueur($idJoueur){ $this->idJoueur = $idJoueur;}
        public function setMail($mail){ $this->mail = $mail;}
        public function setPassword($password){ $this->password = $password;}
        public function setDateInscription($dateInscription){ $this->dateInscription = $dateInscription;}
        public function setNom($nom){ $this->nom = $nom;}
        public function setPrenom($prenom){ $this->prenom = $prenom;}
        public function setThunasse($thunasse){ $this->thunasse = $thunasse;}
        public function setNiveau($niveau){ $this->niveau = $niveau;}

        /*------------------------------------------------------------------------------------------------------------------------------
		/////////////////                                         CONSTRUCTORS                                         ///////////////// 
		------------------------------------------------------------------------------------------------------------------------------*/

        public function __construct($id = NULL, $m = NULL, $pass = NULL, $d = NULL, $n = NULL, $pr = NULL, $t = NULL, $niv = NULL)  {
            $this->idJoueur = $id;
            $this->mail = $m;
            $this->password = util::hash($pass);
            $this->dateInscription = $d;
            $this->nom = $n;
            $this->prenom = $pr;
            $this->thunasse = $t;
            $this->niveau = $niv;
        }

        /*------------------------------------------------------------------------------------------------------------------------------
		/////////////////                                         METHODES                                             ///////////////// 
		------------------------------------------------------------------------------------------------------------------------------*/

        /**
		 * Retourne une array contenant les informations passé en parametre
		 *
		 * @param Int $idJoueur id coresspondant au joueur dans la base de donnée
		 * 
		 * @author Gabel Yanis <yanis.gabel@universite-paris-saclay.fr>
		 * @return array contenant toutes les informations du joueur ayant pour id celui passé en paramètre (si joueur trouvé) sinon false.
		 * 					
		 */

        public function getJoueurById($idJoueur){
            $requetePreparee = "SELECT * FROM Joueur WHERE login = :id_tag ;";
            $req_prep = Connexion::pdo()->prepare($requetePreparee);
            $valeurs = array("id_tag" => $idJoueur);

            $req_prep->execute($valeurs);
            if ($req_prep->rowCount() == 0) { return false;}

            $req_prep->setFetchMode(PDO::FETCH_CLASS,"Joueur");
		    $tabJoueur = $req_prep->fetchAll();
		    return $tabJoueur;
        }

        /**
		 * Retourne le joueur ayant pour mail, le mail passé en paramètre
		 *
		 * @param String $mail mail d'un joueur passé en paramètre
         * 	
		 * @author Gabel Yanis <yanis.gabel@universite-paris-saclay.fr>
		 * @return tableau contenant le joueur correspondant à l'email passé en paramètre
		 * 					
		 */

        public function getJoueurByMail($mail){
            $requetePreparee = "SELECT * FROM Joueur WHERE login = :m_tag ;";
            $req_prep = Connexion::pdo()->prepare($requetePreparee);
            $valeurs = array("m_tag" => $mail);

            $req_prep->execute($valeurs);
            if ($req_prep->rowCount() == 0) { return false;}

            $req_prep->setFetchMode(PDO::FETCH_CLASS,"Joueur");
		    $tabJoueur = $req_prep->fetchAll();
		    return $tabJoueur;
        }

        /**
		 * Retourne une array contenant les informations passé en parametre
		 *
		 * @param Int $id correspondant à l'id du joueur
		 * @param String $mail correspondant au mail du joueur
		 * @param String $pass corespondant au mdp crypté du joueur
         * @param Date $dateInsc corespondant à la date d'inscription du joueur
         * @param String $nom corespondant au nom du joueur
         * @param String $pre corespondant au prenom du joueur
         * @param Int $thune corespondant à l'argent dans le jeu du joueur
         * @param Int $niv corespondant au niveau du joueur
		 * 
		 * @author Gabel Yanis <yanis.gabel@universite-paris-saclay.fr>
		 * @return bool true si le joueur a été inséré, sinon false
		 * 					
		 */

        public function insertJoueur($id, $mail, $pass, $dateInsc, $nom, $pre, $thune, $niv) {
            $passHash = util::hash($pass);
            $requetePreparee = "INSERT INTO Joueur (idJoueur, mail, password, dateInscription, nom, prenom, thunasse, niveau) 
            VALUES (:id_tag, :m_tag, :pass_tag, :insc_tag, :n_tag , :p_tag, :thune_tag, :niv_tag );"; 
            $req_prep = Connexion::pdo()->prepare($requetePreparee);
            $valeurs = array(
                "id_tag" => $id,
                "m_tag" => $mail,
                "pass_tag" => $passHash,
                "insc_tag" => $dateInsc,
                "n_tag" => $nom,
                "p_tag" => $pre,
                "t_tag" => $thune,
                "niv_tag" => $niv,
            );

            try {
                $req_prep->execute($valeurs);
                return true;
            }   catch (PDOException $e) {
            echo "erreur : " .$e->getMessage(). "<br>";
            return false;
            }
        }


        /**
		 * Update un joueur dans la base de donnée
		 *
		 * @param Int $id correspondant à l'id du joueur
		 * @param String $mail correspondant au mail du joueur
		 * @param String $pass corespondant au mdp crypté du joueur
         * @param String $nom corespondant au nom du joueur
         * @param String $pre corespondant au prenom du joueur
         * @param Int $thune corespondant à l'argent dans le jeu du joueur
         * @param Int $niv corespondant au niveau du joueur
		 * 
		 * @author Gabel Yanis <yanis.gabel@universite-paris-saclay.fr>
		 * @return Bool true si le joueur a bien été update, false sinon
		 * 					
		 */

        public function updateJoueur($id, $mail, $pass, $nom, $pre, $thune, $niv){
            $passHash = util::hash($pass);
            $requetePreparee = "UPDATE Joueur SET mail = :m_tag, password = :pass_tag, thunasse = :thune_tag, niveau = :niv_tag , nom = :n_tag , prenom = :p_tag 
            WHERE idJoueur = :id_tag";
            $req_prep = Connexion::pdo()->prepare($requetePreparee);
            $valeurs = array(
                "id_tag" => $id,
                "m_tag" => $mail,
                "pass_tag" => $passHash,
                "n_tag" => $nom,
                "p_tag" => $pre,
                "t_tag" => $thune,
                "niv_tag" => $niv,
            );

            try {
                $req_prep->execute($valeurs);
                return true;
            }   catch (PDOException $e) {
            echo "erreur : " .$e->getMessage(). "<br>";
            return false;
            }
        }

        /**
		 * Delete un joueur via son email
		 *
		 * @param String $mail 
		 * 
		 * @author Gabel Yanis <yanis.gabel@universite-paris-saclay.fr>
		 * @return Bool true si le joueur a bien été supprimé, false sinon  
		 * 					
		 */

        public function deleteJoueurByMail($mail){
            $requetePreparee = "DELETE FROM Joueur WHERE mail = :m_tag ;";
            $req_prep = Connexion::pdo()->prepare($requetePreparee);
            $valeurs = array("m_tag" => $mail);
        
            try {
                $req_prep->execute($valeurs);
                return true;
            }   catch (PDOException $e) {
            echo "erreur : " .$e->getMessage(). "<br>";
            return false;
            }
        }


        public function deleteJoueurByID($idJoueur){
            $requetePreparee = "DELETE FROM Joueur WHERE idJoueur = :i_tag ;";
            $req_prep = Connexion::pdo()->prepare($requetePreparee);
            $valeurs = array("i_tag" => $idJoueur);
        
            try {
                $req_prep->execute($valeurs);
                return true;
            }   catch (PDOException $e) {
            echo "erreur : " .$e->getMessage(). "<br>";
            return false;
            }
        }

        /**
		 * Retourne une array contenant les informations passé en parametre
		 *
		 * @param status code retour. Position [0].
		 * @param message message à transmettre . Position [1].
		 * @param data [facultatif] données facultatifs à inserer. Position [2...].
		 * 
		 * @author Gabel Yanis <yanis.gabel@universite-paris-saclay.fr>
		 * @return array contenant toutes les informations passé en paramètre  
		 * 					
		 */

        /**
		 * Vérifie si le mot de passe est bien celui inscrit sur la BDD
		 *
		 * @param Int $id correspondant à l'id du joueur
		 * @param String $pass corespondant au mdp crypté du joueur
		 * 
		 * @author Gabel Yanis <yanis.gabel@universite-paris-saclay.fr>
		 * @return Bool retourne vrai si le mdp passé en parametre correspopont bien à celui dans la base de donnée (crypté)
		 * 					
		 */

        public static function checkMDP($id,$m) {
            $requetePreparee = "SELECT * FROM Joueur WHERE idJoueur = :id_tag and password = :m_tag;";
            $req_prep = connexion::pdo()->prepare($requetePreparee);
            $valeurs = array("id_tag" => $id, "m_tag" => util::hash($m));
            $req_prep->execute($valeurs);
            $req_prep->setFetchMode(PDO::FETCH_CLASS,"utilisateur");
            $tabUtilisateurs = $req_prep->fetchAll();
            if (sizeof($tabUtilisateurs) == 1)
                return true;
            else
                return false;
        }



        public static function getLesParties($idJoueur){
            $requetePreparee = "SELECT * FROM Partie WHERE idPartie in (select idPartie from Participe WHERE idJoueur = :i_tag);";
            $req_prep = Connexion::pdo()->prepare($requetePreparee);
            $valeurs = array("i_tag" => $idJoueur);
            $req_prep->execute($valeurs);
            $resultat = $req_prep->fetchAll(PDO::FETCH_ASSOC);
            
            if ($req_prep->rowCount() == 0){
                return false;
            } else {
                $tab = array();
                foreach($resultat as $key => $val){
                    $tab[] = new Partie($val);
                }
                return $tab;
            }
        }
        public static function getPartieActuel($idJoueur){
            $requetePreparee = "SELECT * FROM Participe JOIN Partie ON Partie.idPartie = Participe.idPartie WHERE Participe.idJoueur = :i_tag and enCours = 1;";
            $req_prep = Connexion::pdo()->prepare($requetePreparee);
            $valeurs = array("i_tag" => $idJoueur);
            $req_prep->execute($valeurs);
            $resultat = $req_prep->fetch(PDO::FETCH_ASSOC);
            
            if ($req_prep->rowCount() == 0){
                return false;
            } else {
                return new Partie($resultat);
            }
        }


        public function getLesCompetencesDebloques($idJoueur)
        {
            $requetePreparee = " SELECT * FROM Competence WHERE idCompetence in (select idCompetence from ADebloque WHERE idJoueur = :i_tag);";
            $req_prep = Connexion::pdo()->prepare($requetePreparee);
            $valeurs = array("i_tag" => $idJoueur);

            $req_prep->execute($valeurs);
            $resultat = $req_prep->fetchAll(PDO::FETCH_ASSOC);
            
            if ($req_prep->rowCount() == 0){
                return false;
            } else {
                $tab = array();
                foreach($resultat as $key => $val){
                    $tab[] = new Competence($val);
                }
                return $tab;
            }
        }
        public function getLesCompetencesNonDebloques($idJoueur)
        {
            $requetePreparee = " SELECT * FROM Competence WHERE idCompetence not in (select idCompetence from ADebloque WHERE idJoueur = :i_tag);";
            $req_prep = Connexion::pdo()->prepare($requetePreparee);
            $valeurs = array("i_tag" => $idJoueur);

            $req_prep->execute($valeurs);
            $resultat = $req_prep->fetchAll(PDO::FETCH_ASSOC);
            
            if ($req_prep->rowCount() == 0){
                return false;
            } else {
                $tab = array();
                foreach($resultat as $key => $val){
                    $tab[] = new Competence($val);
                }
                return $tab;
            }
        }
        public function getLesCompetencesUtilise($idJoueur)
        {
            $requetePreparee = " SELECT * FROM Competence WHERE idCompetence in (select idCompetence from ADebloque WHERE idJoueur = :i_tag and utilise = 1);";
            $req_prep = Connexion::pdo()->prepare($requetePreparee);
            $valeurs = array("i_tag" => $idJoueur);

            $req_prep->execute($valeurs);
            $resultat = $req_prep->fetch(PDO::FETCH_ASSOC);
            
            if ($req_prep->rowCount() == 0){
                return false;
            } else {
                new Competence($resultat);
            }
        }
}