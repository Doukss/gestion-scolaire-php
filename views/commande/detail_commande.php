<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détail Commande</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/remixicon@4.6.0/fonts/remixicon.min.css">
</head>
<body class="bg-gray-200">

    <!-- Header -->
    <div class="bg-blue-400 text-white flex gap-5">
        <h1 class="text-xl font-bold">GESTION CLIENTS</h1>
        <div class="flex gap-5">
            <a href="<?= WEBROOT ?>controller=client&page=liste">Clients</a>
            <a href="<?= WEBROOT ?>controller=commande&page=commande&client_id=<?= $_GET['client_id'] ?>">Commandes</a>
        </div>
    </div>

    <!-- Titre -->
    <div class="bg-gray-400 text-center text-white">
        <h1 class="text-xl font-bold">DÉTAIL DE LA COMMANDE</h1>
    </div>

    <!-- Vérification si la commande contient des produits -->
    <div class="bg-white shadow p-10 rounded mt-5 w-[60%] mx-auto">
        <?php if (!empty($commande['produits'])) : ?>
            <table class="w-full border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-400 text-white">
                        <th class="border border-gray-400 px-4 py-2">ID Produit</th>
                        <th class="border border-gray-400 px-4 py-2">Article</th>
                        <th class="border border-gray-400 px-4 py-2">Prix</th>
                        <th class="border border-gray-400 px-4 py-2">Quantité</th>
                        <th class="border border-gray-400 px-4 py-2">Montant</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($commande['produits'] as $produit) : ?>
                        <tr class="text-center hover:bg-gray-100 ">
                            <td class="border border-gray-400 px-4 py-2"><?= htmlspecialchars($produit['id']) ?></td>
                            <td class="border border-gray-400 px-4 py-2"><?= htmlspecialchars($produit['article']) ?></td>
                            <td class="border border-gray-400 px-4 py-2"><?= htmlspecialchars($produit['prix']) ?> FCFA</td>
                            <td class="border border-gray-400 px-4 py-2"><?= htmlspecialchars($produit['quantite']) ?></td>
                            <td class="border border-gray-400 px-4 py-2 font-bold"><?= htmlspecialchars($produit['prix'] * $produit['quantite']) ?> FCFA</td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <!-- Affichage du total général -->
            <div class="mt-5 text-right text-lg font-bold">
                <p>Total : 
                    <?php 
                        $total = array_sum(array_map(fn($p) => $p['prix'] * $p['quantite'], $commande['produits']));
                        echo htmlspecialchars($total);
                    ?> FCFA
                </p>
            </div>

        <?php else : ?>
            <p class="text-center text-red-500 font-bold">Aucun produit dans cette commande.</p>
        <?php endif; ?>
    </div>

    <!-- Bouton Retour -->
    <div class="mt-5 text-center">
        <a href="<?= WEBROOT ?>controller=commande&page=commande&client_id=<?= $_GET['client_id'] ?>" class="bg-blue-400 text-white px-4 py-2 rounded">
            Retour
        </a>
    </div>

</body>
</html>
