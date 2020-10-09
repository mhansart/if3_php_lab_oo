<?php 
    require_once("Connexion.php");
    class Entrainement extends Connexion 
    {
        public function createEvent($_date, $_adresse, $_heureStart, $_heureStop, $_type)
        {
            $requete = "INSERT INTO entrainements( entrainement_date, entrainement_adresse, entrainement_heure_debut, entrainement_heure_fin, entrainement_type) VALUES (:dateEvent,:adresse,:heureStart, :heureStop,:typeEvent)";          

            $tabChamps= array(
                ":dateEvent"=>$_date,
                ":adresse"=>$_adresse,
                ":heureStart"=>$_heureStart,
                ":heureStop"=>$_heureStop,
                ":typeEvent" =>$_type    
            );

            $this->execute($requete, $tabChamps);
        }

        public function createJoueurEvent($_joueurId, $_entrainementId, $_presence)
        {
            $requete = "INSERT INTO `joueurs_entrainements` (joueur_id,entrainement_id, presence)VALUES(:joueur_id, :entrainement_id, :presence)";

            $tabChamps= array(
                ":joueur_id" => $_joueurId,
                ":entrainement_id"=>$_entrainementId,
                ":presence"=>$_presence            
            );

            $this->execute($requete, $tabChamps);
        }

        public function readEvent()
        {
            $requete = "SELECT entrainement_id,CONCAT(DAY(entrainement_date),' ', CASE MONTH(entrainement_date) WHEN 1 THEN 'Janvier' WHEN 2 THEN 'Février' WHEN 3 THEN 'Mars' WHEN 4 THEN 'Avril' WHEN 5 THEN 'Mai' WHEN 6 THEN 'Juin' WHEN 7 THEN 'Juillet' WHEN 8 THEN 'Août' WHEN 9 THEN 'Septembre' WHEN 10 THEN 'Octobre' WHEN 11 THEN 'Novembre' WHEN 12 THEN 'Décembre' END,' ', YEAR(entrainement_date)) as 'format_date',
            entrainement_adresse,
            DAY(entrainement_date) as 'jour',
            CASE MONTH(entrainement_date) WHEN 1 THEN 'Janvier' WHEN 2 THEN 'Février' WHEN 3 THEN 'Mars' WHEN 4 THEN 'Avril' WHEN 5 THEN 'Mai' WHEN 6 THEN 'Juin' WHEN 7 THEN 'Juillet' WHEN 8 THEN 'Août' WHEN 9 THEN 'Septembre' WHEN 10 THEN 'Octobre' WHEN 11 THEN 'Novembre' WHEN 12 THEN 'Décembre' END as 'mois',
            CONCAT(DATE_FORMAT(entrainement_heure_debut, '%k'),'h',DATE_FORMAT(entrainement_heure_debut,'%i')) as 'debut',
            CONCAT(DATE_FORMAT(entrainement_heure_fin, '%k'),'h',DATE_FORMAT(entrainement_heure_fin,'%i')) as 'fin',entrainement_type,
            entrainement_date FROM entrainements ORDER BY entrainement_date" ;

            return $this->execute($requete);
        }


    }
?>