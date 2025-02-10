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
       
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (!empty($_POST['produit']) && !empty($_POST['prix']) && !empty($_POST['quantite'])) {
                $produit = htmlspecialchars($_POST['produit']);
                $prix = (int) $_POST['prix'];
                $quantite = (int) $_POST['quantite'];
                $trouve = false;
        
                foreach ($_SESSION['commandes'] as $index => $commande) {
                    if ($commande['produit'] === $produit && $commande['prix'] === $prix) {
                        // Mise à jour de la quantité si le produit existe déjà
                        $_SESSION['commandes'][$index]['quantite'] += $quantite;
                        $_SESSION['commandes'][$index]['prix'] = $prix;
                        $trouve = true;
                        break;
                    }
                }
        
                if (!$trouve) {
                    $_SESSION['commandes'][] = [
                        'produit' => $produit,
                        'prix' => $prix,
                        'quantite' => $quantite,
                    ];
                }
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

    case "modifier_commande":
        if (isset($_GET['index']) && isset($_POST['produit']) && isset($_POST['quantite']) && isset($_POST['prix'])) {
            $index = (int) $_GET['index'];
        
            if (isset($_SESSION['commandes'][$index])) {
                    $_SESSION['commandes'][$index]['produit'] = $_POST['produit'];
                    $_SESSION['commandes'][$index]['quantite'] = (int) $_POST['quantite'];
                    $_SESSION['commandes'][$index]['prix'] = (float) $_POST['prix'];
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
