<?php
session_start();

// Vérifie si la variable session 'commandes' existe sinon l'initialise
if (!isset($_SESSION['commandes'])) {
    $_SESSION['commandes'] = [];
}

// Récupère la page demandée ou définit une page par défaut
$page = $_GET["page"] ?? "ajouter_commande";

switch ($page) {

    //  Gestion des commandes d'un client
    case "commande":
        $clientId = $_GET['client_id'] ?? null;
        $commandes = getAllcommadeByclient($clientId);
        require_once "../views/commande/commande.php";
        break;

    //  Détail d'une commande spécifique
    case "detail_commande":
        $clientId = $_GET['client_id'] ?? null;
        $commandeId = $_GET['commande_id'] ?? null;
        $commande = getCommandeById($clientId, $commandeId);

        if (!$commande) {
            echo "Commande introuvable !";
            exit;
        }

        require_once "../views/commande/detail_commande.php";
        break;

    //  Ajout d'un client
    case "ajouter_client":
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nom = $_POST['nom'] ?? '';
            $prenom = $_POST['prenom'] ?? '';
            $telephone = $_POST['telephone'] ?? '';

            if (!empty($nom) && !empty($prenom) && !empty($telephone)) {
                addClient($nom, $prenom, $telephone);
                header("Location: " . WEBROOT . "controller=client&page=liste_clients");
                exit;
            } else {
                $error = "Tous les champs sont obligatoires.";
            }
        }
        require_once "../views/client/ajouter_client.php";
        break;

    //  Liste de toutes les commandes
    case "liste.commande":
        $commandes = getAllCommandes();
        require_once "../views/commande/liste.commande.php";
        break;

    //  Ajout d'une commande (via formulaire)
    case "ajouter_commande":
      
        $commandes = $_SESSION['commandes'];
        
        // Recherche d'un client par téléphone
        if (!empty($_GET['telephone'])) {
            
            $telephone = trim($_GET['telephone']);
            
            $client = getClientByTelephone($telephone);
            $_SESSION["client"]=$client;
            if ($client) {
                $nom = $client['nom'];
                $prenom = $client['prenom'];
            }
        }
       
        
        // Ajout d'un produit à la commande
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (!empty($_POST['produit']) && !empty($_POST['prix']) && !empty($_POST['quantite'])) {
                $_SESSION['commandes'][] = [
                    'produit' => htmlspecialchars($_POST['produit']),
                    'prix' => (int) $_POST['prix'],
                    'quantite' => (int) $_POST['quantite'],
                ];
            }
            header("Location: " . WEBROOT . "controller=commande&page=ajouter_commande");
            exit();
        }
        
        require_once "../views/commande/ajouter_commande.php";
        break;

    case "supprimer_commande":
        if (isset($_GET['index'])) {
            $index = (int) $_GET['index'];
            if (isset($_SESSION['commandes'][$index])) {
                unset($_SESSION['commandes'][$index]);
                $_SESSION['commandes'] = array_values($_SESSION['commandes']);
            }
        }
        header("Location: " . WEBROOT . "controller=commande&page=ajouter_commande");
        exit();
        break;
    
    default:
        echo "Page introuvable !";
        exit();
}
?>
