<?php

class Util {

    /**
     * Retourne True Si Les Arguments Passés En Paramètres Sont Présent Dans Le Get. Faux Dans Tout Les Autres Cas.
     *
     * @param args Arguments à vérifier.
     *
     * @author Gabel Yanis <yanis.gabel@universite-paris-saclay.fr>
     * @return Boolean
     *
     */

    public static function verifPostArgs(...$args){

        foreach ($args as $argu){
            if (!isset($_POST[$argu])){
                return false;
            }
        }
        return true;
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

    public static function formateReponse($status, $message , $data = NULL){

        $reponse = array();

        if (isset($data)) {
            $reponse[0] = "$status";
            $reponse[1]	= "$message";
            $reponse[2] = $data;
        } else {
            $reponse[0] = "$status";
            $reponse[1]	= "$message";
        }

        return $reponse;
    }


    /**
     * Retourne le texte en clair passé en paramètre crypté
     *
     * @param texteEnClair mot de passe ou texte à chiffrer
     *
     * @author Gabel Yanis <yanis.gabel@universite-paris-saclay.fr>
     * @return string correspondant au texteEnClair chiffré
     *
     */

    public static function hash($texteEnClair) {
        $chaineAleatoire = "kAgBjWf6K0";
        $texteAvecAjout = $chaineAleatoire.$texteEnClair;
        $texteHache = hash('sha256', $texteAvecAjout);
        return $texteHache;
    }

    /**
     * Retourne en fonction du code d'erreur un message indiquant le type, son code et des données suplémentaires
     *
     * @param message message à transmettre correspondant à ce que signifie le code erreur
     * @param data [facultatif] données facultatifs à inserer.
     *
     * @author Vaudour Théophile <theophile.vodour@universite-paris-saclay.fr>
     * @return array contenant toutes les informations passé en paramètre
     *
     */

    public static function reponseOk($message,$data = NULL){
        return Util::formateReponse(200,$message,$data);
    }
    public static function reponseCreer($message,$data = NULL){
        return Util::formateReponse(201,$message,$data);
    }
    public static function reponseAucunContenu(){
        return Util::formateReponse(204,"Ok");
    }
    public static function reponseMauvaiseRqt(){
        return Util::formateReponse(400,"Erreur Mauvaise Requête");
    }
    public static function reponseNonAutorise(){
        return Util::formateReponse(401,"Erreur Autorisation Impossible/Manquante");
    }
    public static function reponseInterdit(){
        return Util::formateReponse(403,"Erreur Accès Interdit");
    }
    public static function reponseNonTrouver(){
        return Util::formateReponse(404,"Erreur Ressource Introuvable");
    }
    public static function reponseNonValide(){
        return Util::formateReponse(405,"Erreur Méthode HTTP Non Valide");
    }
    public static function reponseConflit($message){
        return Util::formateReponse(409,$message);
    }
    public static function reponseErrServ(){
        return Util::formateReponse(500,"Erreur Serveur Interne");
    }
}
?>