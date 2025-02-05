<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une Commande</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/remixicon@4.6.0/fonts/remixicon.min.css">
</head>
<body class="bg-gray-200 p-5">

    <div class="max-w-4xl mx-auto bg-white p-5 shadow-lg rounded">
        <h1 class="text-xl font-bold text-center text-blue-400">Ajouter une Commande</h1>

        <!-- Formulaire -->
        <form action="<?= WEBROOT ?>controller=commande&page=ajouter_commande" method="GET" class="mt-5">
            <div class="flex space-x-2">
                <input type="hidden" name="controller" value="commande">
                <input type="hidden" name="page" value="ajouter_commande">
                <input type="text" name="telephone" placeholder="Téléphone..." class="border p-2 w-96">
                <button type="submit" class="bg-blue-400 text-white px-4 py-2">OK</button>
            </div>
        </form>
        
            <div class="grid grid-cols-4 mt-6 gap-12">
                <input type="text" name="nom" placeholder="Nom" class="border p-2 " value="<?= $_SESSION["client"]['nom']?? ''?>">
                <input type="text" name="prenom" placeholder="Prenom" class="border p-2" value="<?= $_SESSION["client"]['prenom']?? ''?>">
            </div>
       

        <!-- Formulaire Ajout Produit -->
        <form action="<?= WEBROOT ?>controller=commande&page=ajouter_commande" method="POST" class="mt-5">
            <div class="grid grid-cols-3 gap-2">
                <input type="text" name="produit" placeholder="Produit" class="border p-2">
                <input type="number" name="prix" placeholder="Prix" class="border p-2">
                <input type="number" name="quantite" placeholder="Quantité" class="border p-2">
            </div>
            <button type="submit" class="bg-blue-400 rounded text-white px-4 py-2 mt-2">Ajouter</button>
        </form>

        <!-- Tableau des commandes -->
        <div class="mt-5">
            <table class="w-full border-collapse">
                <thead class="bg-gray-400 text-white">
                    <tr>
                        <th class="border p-2">Produits</th>
                        <th class="border p-2">Prix</th>
                        <th class="border p-2">Quantité</th>
                        <th class="border p-2">Montant</th>
                        <th class="border p-2">Action</th>  
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($_SESSION['commandes'])): ?>
                        <?php foreach ($_SESSION['commandes'] as $index => $commande): ?>
                            <tr class="bg-gray-200">
                                <td class="border p-2"><?= htmlspecialchars($commande['produit']) ?></td>
                                <td class="border p-2"><?= htmlspecialchars($commande['prix']) ?>f</td>
                                <td class="border p-2"><?= htmlspecialchars($commande['quantite']) ?></td>
                                <td class="border p-2"><?= $commande['prix'] * $commande['quantite'] ?>f</td>
                                <td class="border p-2">
                                    <a href="<?= WEBROOT ?>controller=commande&page=modifier_commande&index=<?= $index ?>" class="text-blue-400"><i class="ri-edit-line"></i></a>
                                    <a href="<?= WEBROOT ?>controller=commande&page=supprimer_commande&index=<?= $index ?>" class="text-red-400"><i class="ri-delete-bin-line"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="border p-2 text-center">Aucune commande ajoutée</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="flex justify-between items-center mt-5">
            <p class="text-lg font-bold">Total : <?= array_sum(array_map(fn($c) => $c['prix'] * $c['quantite'], $_SESSION['commandes'] ?? [])) ?>f</p>
            <button class="bg-blue-400 rounded text-white px-6 py-2">Commander</button>
        </div>
    </div>

</body>
</html>
