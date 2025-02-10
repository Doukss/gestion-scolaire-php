<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une Commande</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/remixicon@4.6.0/fonts/remixicon.min.css">
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center p-5">

    <div class="max-w-4xl w-full bg-white p-6 shadow-lg rounded-lg">
        <h1 class="text-2xl font-semibold text-center text-blue-500 mb-5">Ajouter une Commande</h1>

        <!-- Formulaire de recherche client -->
        <form action="<?= WEBROOT ?>controller=commande&page=ajouter_commande" method="GET" class="flex items-center space-x-2">
            <input type="hidden" name="controller" value="commande">
            <input type="hidden" name="page" value="ajouter_commande">
            <input type="text" name="telephone" placeholder="Téléphone..." class="border border-gray-300 rounded-lg p-2 w-full">
            <button type="submit" class="bg-blue-400 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition">OK</button>
        </form>

        <!-- Informations client -->
        <div class="grid grid-cols-3 gap-4 mt-4">
            <input type="text" readonly name="nom" placeholder="Nom" class="border border-gray-300 p-2 rounded-lg bg-gray-100" value="<?= $_SESSION["client"]['nom']?? ''?>">
            <input type="text" readonly name="prenom" placeholder="Prénom" class="border border-gray-300 p-2 rounded-lg bg-gray-100" value="<?= $_SESSION["client"]['prenom']?? ''?>">
        </div>

        <!-- Formulaire Ajout Produit -->
        <form action="<?= WEBROOT ?>controller=commande&page=ajouter_commande" method="POST" class="mt-6 space-y-2">
            <div class="grid grid-cols-3 gap-4">
                <input type="text" name="produit" placeholder="Produit" class="border border-gray-300 p-2 rounded-lg">
                <input type="number" name="prix" placeholder="Prix" class="border border-gray-300 p-2 rounded-lg">
                <input type="number" name="quantite" placeholder="Quantité" class="border border-gray-300 p-2 rounded-lg">
            </div>
            <button type="submit" class="bg-blue-400 rounded-lg text-white px-4 py-2 w-full hover:bg-blue-600 transition">Ajouter</button>
        </form>

        <!-- Tableau des commandes -->
        <div class="mt-6 overflow-x-auto">
            <table class="w-full border-collapse shadow-lg">
                <thead class="bg-blue-400 text-white">
                    <tr>
                        <th class="border p-2">Produits</th>
                        <th class="border p-2">Prix</th>
                        <th class="border p-2">Quantité</th>
                        <th class="border p-2">Montant</th>
                        <th class="border p-2">Action</th>  
                    </tr>
                </thead>
                <tbody class="bg-gray-100">
                    <?php if (!empty($_SESSION['commandes'])): ?>
                        <?php foreach ($_SESSION['commandes'] as $index => $commande): ?>
                            <tr class="border-b">
                                <td class="border p-2"><?= htmlspecialchars($commande['produit']) ?></td>
                                <td class="border p-2"><?= htmlspecialchars($commande['prix']) ?> f</td>
                                <td class="border p-2"><?= htmlspecialchars($commande['quantite']) ?></td>
                                <td class="border p-2 font-semibold"><?= $commande['prix'] * $commande['quantite'] ?> f</td>
                                <td class="border p-2 flex space-x-2 justify-center">
                                    <a href="<?= WEBROOT ?>controller=commande&page=modifier_commande&index=<?= $index ?>" class="text-blue-500 hover:text-blue-700"><i class="ri-edit-line text-xl"></i></a>
                                    <a href="<?= WEBROOT ?>controller=commande&page=supprimer_commande&index=<?= $index ?>" class="text-red-500 hover:text-red-700"><i class="ri-delete-bin-line text-xl"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="border p-2 text-center text-gray-500">Aucune commande ajoutée</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Total et Validation -->
        <div class="flex justify-between items-center mt-6">
            <p class="text-xl font-bold">Total : <?= array_sum(array_map(fn($c) => $c['prix'] * $c['quantite'], $_SESSION['commandes'] ?? [])) ?> FCFA</p>
            <button class="bg-green-500 rounded-lg text-white px-6 py-2 hover:bg-green-600 transition">Commander</button>
        </div>
    </div>

</body>
</html>
