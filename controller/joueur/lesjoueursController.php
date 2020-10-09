<?php 
    // récupérer les personnes et afficher
    $p = new Joueur();
    $tabJoueurs = $p->read();
    // var_dump($tabPersonnes);
    // générer le tableau html
    $listeJoueurs = "";
    foreach($tabJoueurs as $joueur){
        if($_SESSION['role'] == 'Coach')
        {
            $button = "<form action='#' method='post'>
            <input type='hidden' name='name' value='". $joueur['joueur_id']."'>
            <input type='submit' name='submit' class='deleteJoueur' value='Supprimer ce joueur'></form>";
        }
        else 
        {
            $button ="";
        };
        $listeJoueurs.=
        "<div class='oneJoueur'>
                <p class='initiales'>".$joueur['joueur_initiales']."</p>
                <div class='propriete'>
                    <p class='bold nomPrenom'>".$joueur['joueur_prenom']." ".$joueur['joueur_nom']."</p>
                </div>
                <div class='propriete'>
                    <p>Nom d'utlisateur:</p> <p class='bold'>".$joueur['joueur_nom_user']."</p>
                </div>
                <div class='propriete'>
                    <p>E-mail: </p><p class='bold'>".$joueur['joueur_email']."</p>
                </div>
                <div class='propriete'>
                    <p>Sur le terrain: </p><p class='bold'>".$joueur['joueur_position']."</p>
                </div>
                <div class='propriete'>
                    <p>Niveau: </p><p class='bold'>".$joueur['joueur_niveau']."</p>
                </div>
                <div class='propriete'>
                    <p>Rôle: </p><p class='bold'>".$joueur['joueur_role']."</p>
                </div>
                <div class='joueur-delete'>
                    ".$button."
                </div>
        </div>";  
    };
    if(isset($_POST['name']))       
         {            
            $id = trim($_POST['name']);
            $p = new Joueur();
            $p->deleteJoueur($id);          

            
        header("Location:?section=lesjoueurs");        
        }


    // appeler la vue
    require_once("view/page/lesjoueurs.php");
?>