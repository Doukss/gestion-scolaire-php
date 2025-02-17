<?php

function paginate($items, $perPage = 5, $currentPage = 1)
{
    $totalItems = count($items);
    $totalPages = ceil($totalItems / $perPage);
    $start = ($currentPage - 1) * $perPage;
    $pagedItems = array_slice($items, $start, $perPage);

    return [
        'items' => $pagedItems,
        'total_pages' => $totalPages,
        'current_page' => $currentPage
    ];
}


$page = isset($_GET["page"]) ? $_GET["page"] : "liste";

    if($page == "ajouter_client") {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nom = $_POST['nom'] ?? '';
            $prenom = $_POST['prenom'] ?? '';
            $telephone = $_POST['telephone'] ?? '';

            if (!empty($nom) && !empty($prenom) && !empty($telephone)) {
                addClient($nom, $prenom, $telephone);
                header("Location: " . WEBROOT . "controller=client&page=liste");
                exit;
            } else {
                $error = "Tous les champs sont obligatoires.";
            }
        }
        require_once "../views/client/ajouter_client.php";
    }else if($page == "liste"){
        $clientId = $_GET['client_id'] ?? null;
        $search = $_GET['search'] ?? '';
        $clients = getClients($search);
        $currentPage = isset($_GET['p']) ? (int)$_GET['p'] : 1;
        $paginationResult = paginate($clients, 2, $currentPage);
        $clientsPagines = $paginationResult['items'];
        $totalPages = $paginationResult['total_pages'];
        $current_page = $paginationResult['current_page'];

if ($clientId) {
    $client = getClientById($clientId);
}
renderView("client/listeClient.html.php",["clientsPagines"=>$clientsPagines,"current_page"=>$current_page,"totalPages"=>$totalPages]);

// ob_start();
// require_once "../views/client/listeClient.html.php";
// $content = ob_get_clean();
// require_once "../views/layout/base.layout.php";
}