
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Clients</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/remixicon@4.6.0/fonts/remixicon.min.css">
</head>
<body class="bg-gray-200">
<div class="bg-blue-400  text-white flex ">
    <h1 class="text-xl font-bold">GESTION CLIENTS</h1>
    <div class="ml-10 flex gap-5">
    <a href="<?= WEBROOT ?>controller=client&page=liste">Clients</a>
    <a href="<?= WEBROOT ?>controller=commande&page=liste.commande">Commandes</a>
    </div>
    </div>
    <div class="bg-gray-400 text-center text-white">
    <h1 class="text-xl font-bold">LISTE DES CLIENTS</h1>
    </div>
    <div class="mt-20 rounded flex items-center justify-between">
        <form action="<?=WEBROOT?>page=controller" method="GET" class="flex gap-2 ml-14 mb-">
            <input type="text" name="search" placeholder="Recherche Téléphone..." 
                   value="<?= htmlspecialchars($_GET['search'] ?? '') ?>"
                   class="flex-1 h-10 bg-gray-50 px-4 rounded border border-gray-300">
            <button type="submit" class="bg-blue-400 text-white px-4 py-2 rounded shadow">Rechercher</button>
        </form>
    </div>
   
    <div class="ml-[92%] mb-5 bg-blue-400 rounded w-6 h-6 rounded text-center">
    <a href="<?= WEBROOT ?>controller=client&page=ajouter_client"><i class="ri-user-add-line text-black"></i></a>
    </div>
    
    <div class="w-[90%] bg-white shadow p-10 rounded mx-auto">
        <table class="w-full border-collapse"> 
            <thead class="text-white bg-blue-400">
                <tr>
                    <th class="px-4 py-2 border">NOM</th>
                    <th class="px-4 py-2 border">PRÉNOM</th>
                    <th class="px-4 py-2 border">TÉLÉPHONE</th>
                    <th class="px-4 py-2 border">ACTION</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($clientsPagines)): ?>
                    <?php foreach ($clientsPagines as $client): ?>
                        <tr class="hover:bg-gray-100">
                            <td class="px-4 py-2 border"><?= htmlspecialchars($client['nom']) ?></td>
                            <td class="px-4 py-2 border"><?= htmlspecialchars($client['prenom']) ?></td>
                            <td class="px-4 py-2 border"><?= htmlspecialchars($client['telephone']) ?></td>
                            <td class="px-4 py-2 border ">
                                <div class="bg-gray-300 w-[40%] text-center  rounded">
                                     <a href="<?=WEBROOT?>controller=commande&page=commande&client_id=<?= $client['id'] ?>" class="">Commande</a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="px-4 py-2 text-center border">Aucun client trouvé.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <div class="flex justify-center text-gray-800 mt-4">
                    <div class="flex items-center gap-1 ml-[80%]">
                        <?php if ($current_page > 1): ?>
                            <a href="?page=liste&p=<?= $current_page - 1 ?>" class="px-3 py-2 self-center rounded  border border-gray-300  hover:bg-gray-100">Précédent</a>
                        <?php endif; ?>

                        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                            <a href="?page=liste&p=<?= $i ?>" class="h-10 w-10 rounded flex items-center justify-center border border-gray-300  hover:bg-blue-400 hover:text-white <?= $i == $current_page ? 'bg-blue-300 text-white' : '' ?>">
                                <?= $i ?>
                            </a>
                        <?php endfor; ?>

                        <?php if ($current_page < $totalPages): ?>
                            <a href="?page=liste&p=<?= $current_page + 1 ?>" class="px-3 py-2 rounded self-center border border-gray-300 hover:bg-gray-100">Suivant</a>
                        <?php endif; ?>
                    </div>
      </div>
    </div>
</body>
</html>
