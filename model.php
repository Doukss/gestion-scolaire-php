<?php
 require_once "../data/data.php";

 function getClients($search = '') {
    global $clients; //  Utiliser "global" pour accéder à la variable définie à l'extérieur

    if (!empty($search)) {
        $filteredClients = [];
        foreach ($clients as $client) {
            if (strpos($client['telephone'], $search) !== false) {
                $filteredClients[] = $client;
            }
        }
        return $filteredClients;
    }
    return $clients;
}

function getClientByTelephone($telephone) {
    $clients= $GLOBALS["clients"];
      

   foreach ($clients as $client) {
       if ($client['telephone'] == $telephone) {
           return $client;
       }
   }
   return null;
}

function getClientById($id) {
     $clients= $GLOBALS["clients"];
       
     if (!isset($clients) || !is_array($clients)) {
        return null; // Retournez null si $clients est invalide
    }


    foreach ($clients as $client) {
        if ($client['id'] == $id) {
            return $client;
        }
    }
    return null;
}

function getAllcommadeByclient($id){
   $client=getClientById($id);
   return $client["commande"];
}

function getAllCommandes() {
    global $clients;
    $commandes = [];

    foreach ($clients as $client) {
        foreach ($client['commande'] as $commande) {
            $commande['client_nom'] = $client['nom']; // Ajouter le nom du client à la commande
            $commande['client_prenom'] = $client['prenom'];
            $commande['client_id'] = $client['id'];
            $commandes[] = $commande;
        }
    }
    return $commandes;
}


function getCommandeById($clientId, $commandeId) {
    global $clients;
    foreach ($clients as $client) {
        if ($client['id'] == $clientId) {
            foreach ($client['commande'] as $commande) {
                if ($commande['id'] == $commandeId) {
                    return $commande;
                }
            }
        }
    }
    return null;
}


function addClient($nom, $prenom, $telephone) {
    global $clients;
    
    // Générer un nouvel ID unique
    $newId = count($clients) + 1;

    // Nouveau client
    $newClient = [
        'id' => $newId,
        'nom' => $nom,
        'prenom' => $prenom,
        'telephone' => $telephone,
        'commande' => [] // Aucune commande au début
    ];

    // Ajouter au tableau des clients
    $clients[] = $newClient;
    
    return true;
}








