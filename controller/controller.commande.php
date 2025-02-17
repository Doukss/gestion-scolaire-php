<?php
session_start();

// Récupère la page demandée ou définit une page par défaut
$page = isset($_GET["page"]) ? $_GET["page"] : "liste.commande";;

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

    case "liste.commande":
        ob_start();
        $commandes = getAllCommandes();
        require_once "../views/commande/liste.commande.php";
$content = ob_get_clean();
require_once "../views/layout/base.layout.php";
        break;

    //  Ajout d'une commande (via formulaire)
    case "ajout":
    
       
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            if (isset($_GET['telephone'])) {
            
                $telephone = trim($_GET['telephone']);
                $client = getClientByTelephone($telephone);
                $_SESSION["client"]=$client;
                if ($client) {
                    $nom = $client['nom'];
                    $prenom = $client['prenom']; 
                }
            }
            if (isset($_GET['delete'])) {
                $index = (int) $_GET['delete'];
                if (isset($_SESSION['produits'][$index])) {
                    unset($_SESSION['produits'][$index]);
                    $_SESSION['produits'] = array_values($_SESSION['produits']);
                }
                redirect("commande", "ajout");
                exit;
            }
            if (isset($_GET['edit'])) {
                $index = (int) $_GET['edit'];
                if (isset($_SESSION['produits'][$index])) {
                    $produitTrouver = $_SESSION['produits'][$index];
                }
            }
        }
       
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (!empty($_POST['nom']) && !empty($_POST['prix']) && !empty($_POST['quantite'])) {
                if (!isset($_SESSION['produits'])) {
                    $_SESSION['produits'] = [];
                }
        
                $nom = htmlspecialchars($_POST['nom']);
                $prix = (int)$_POST['prix'];
                $quantite = (int)$_POST['quantite'];
                $produitExiste = false;
        
                // Vérifier si le produit existe déjà
                foreach ($_SESSION['produits'] as $index => $produit) {
                    if ($produit['nom'] === $nom && $produit['prix'] === $prix) {
                        $_SESSION['produits'][$index]['quantite'] += $quantite;
                        $produitExiste = true;
                        break;
                    }
                }
        
                // Vérifier si c'est une modification
                if (isset($_POST["edit_index"]) && $_POST["edit_index"] !== "") {
                    $index = (int)$_POST["edit_index"]; 
                    if (isset($_SESSION['produits'][$index])) {
                        $_SESSION['produits'][$index]['nom'] = $nom;
                        $_SESSION['produits'][$index]['quantite'] = $quantite;
                        $_SESSION['produits'][$index]['prix'] = $prix;
                    }
                } elseif (!$produitExiste) {
                    $_SESSION['produits'][] = [
                        'nom' => $nom,
                        'prix' => $prix,
                        'quantite' => $quantite,
                    ];
                }
            }
        
            redirect("commande", "ajout");
            exit();
        }

        if (isset($_POST['commander'])) {
            if (empty($_SESSION['produits'])) {
                echo "<p>Aucune commande à valider.</p>";
            } else {
                $_SESSION['commande'][] = [
                    'client_id' => $_SESSION["client"]["id"],
                    'produits' => $_SESSION['produits'],
                    'total' => array_sum(array_map(fn($c) => $c['prix'] * $c['quantite'], $_SESSION['produits']))
                ];
                unset($_SESSION['produits']);
                header("Location: " . WEBROOT . "?controller=commande&page=liste.commande");
                exit();
            }
        }
        
        
        
        require_once "../views/commande/ajouter_commande.php";
        break;
    default:
        echo "Page introuvable !";
        exit();
}
?>


