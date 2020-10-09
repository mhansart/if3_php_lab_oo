<?php 
    if(isset($_GET["section"]))
    {
        switch ($_GET["section"]) {
            case 'accueil':
                require_once("controller/joueur/accueilController.php");
                break;
            case 'lultimate':
                require_once("controller/joueur/lultimateController.php");
                break;
            case 'leclub':
                require_once("controller/joueur/leclubController.php");
                break;
            case 'lesentrainements':
                require_once("controller/joueur/lesentrainementsController.php");
                break;
            case 'contact':
                require_once("controller/joueur/contactController.php");
                break;
            case 'inscription':
                require_once("controller/joueur/inscriptionController.php");
                break;
            case 'connexion':
                require_once("controller/connexion/connexion.php");
                break;
            case 'deconnexion':
                require_once("controller/joueur/deconnexionController.php");
                break;
            case 'moncompte':
                require_once("controller/joueur/moncompteController.php");
                break;
            case 'lesjoueurs':
                require_once("controller/joueur/lesjoueursController.php");
                break;
            case 'lesevents':
                require_once("controller/joueur/leseventsController.php");
                break;
            case 'comptebloque':
                require_once("controller/joueur/comptebloqueController.php");
                break;
            default:
                require_once("view/error/404.php");
                break;
        }
    }
    else
    {
        require_once("view/page/accueil.php");
    }
?>