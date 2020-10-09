<?php 
    $coach_joueur="" ;
    if($_SESSION['role']=='Coach'){
    $coach_joueur= '<div>
            <h2 id="ajoutEvent">Ajouter un évènement</h2>
            <form method="post" id="formEvents" style="display:none">
                <h3 id="createEvent" class="titleContent">Créer un évènement</h3>
                <label>Type de l\'évènement?</label>
                <input type="text" placeholder="Entrainement, tournoi,..." name="typeEvent" required>
                <label>Date:</label>
                <input type="date" placeholder="YYYY-MM-DD" name="date" required>
                <label>Adresse:</label>
                <input type="text" name="adresse" required>
                <label>Heure de début:</label>
                <input placeholder="00:00:00" type="time" name="heureStart" required>
                <label>Heure de fin:</label>
                <input name="heureStop" type="time" id="role"required>
                <button type="submit">Créer l\'évènement</button>
            </form>
            </div>';
    }else{
        $coach_joueur='<img src="public/img/events.jpg" alt="event">';
    } 
    $listeEvents="" ;
    $p = new Entrainement();
    $tabEvents = $p->readEvent();
    // var_dump($tabPersonnes);
    // générer le tableau html
    $j = new Joueur();
    $tabJoueurs = $j->readJoueurEvent();
    // var_dump($tabJoueurs);
    // die;

    foreach ($tabEvents as $event) {
        $listeEvents.=
            "<div class='oneEvent'>
                <div class='date'><p class='bold jour'>".$event['jour']."</p><p class='mois'>".$event['mois']."</p></div>
                <div class='eventCard'>
                    <p class='bold nomPrenom'>".$event['entrainement_type']." du ".$event['format_date']."</p>
                    <p>".$event['entrainement_adresse']."</p>
                    <p> Rendez-vous à ".$event['debut']." jusqu'à ".$event['fin']."</p>
                </div>
                <div class='btnEvent'>
                    <form action='#' method='post'>
                    <input type='hidden' name='id' value='". $event['entrainement_id']."'>
                    <input type='submit' name='present' class='present' value='Présent'>
                    <input type='submit' name='absent' class='absent' value='Absent'></form>
                </div>
                <div><details><summary>Présents</summary><div>";
                foreach($tabJoueurs as $joueur){
                    if($event['entrainement_id'] == $joueur['entrainement_id'] && $joueur['presence'] == "1"){
                        $listeEvents.="<p>".$joueur['joueur_nom']." ".$joueur['joueur_prenom']."</p>";
                    }
                }
                $listeEvents.="</div></details></div><details><summary>Absents</summary><div>";
                foreach($tabJoueurs as $joueur){
                    if($event['entrainement_id'] == $joueur['entrainement_id'] && $joueur['presence'] == "0"){
                        $listeEvents.="<p>".$joueur['joueur_nom']." ".$joueur['joueur_prenom']."</p>";
                    }
                }
                $listeEvents.="</div></details></div>"; 
                  
        };
        
        if(isset($_POST['present']))       
         {
            $objetJoueurId=$j->joueurId($_SESSION['email']);
            // var_dump($objetJoueurId[0]['joueur_id']);
            // die;

            $e = new Entrainement();
            $e->createJoueurEvent($objetJoueurId[0]['joueur_id'],trim($_POST['id']),true);
            header("Location:?section=lesevents");
        }elseif(isset($_POST['absent'])){
            $objetJoueurId=$j->joueurId($_SESSION['email']);

            $e = new Entrainement();
            $e->createJoueurEvent($objetJoueurId[0]['joueur_id'],trim($_POST['id']),false);
            header("Location:?section=lesevents");
        }                
        if(isset($_POST["typeEvent"],$_POST["date"],$_POST["adresse"],$_POST["heureStart"],$_POST["heureStop"]))
        {      
                $p = new Entrainement();
                $p->createEvent($_POST["date"],$_POST["adresse"],$_POST["heureStart"],$_POST["heureStop"],$_POST["typeEvent"]);

                header("Location:?section=lesevents");
        }


    require_once("view/page/lesevents.php");
?>