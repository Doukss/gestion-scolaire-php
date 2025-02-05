<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Client</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-200">
    <div class="bg-blue-400 text-white flex">
        <h1 class="text-xl font-bold">GESTION CLIENTS</h1>
        <div class="ml-10 flex gap-5">
            <a href="<?= WEBROOT ?>controller=client&page=liste_clients">Liste des Clients</a>
        </div>
    </div>

    <div class="bg-gray-400 text-center text-white">
        <h1 class="text-xl font-bold">AJOUTER UN CLIENT</h1>
    </div>

    <div class="bg-white shadow p-10 rounded mt-5 w-[50%] mx-auto">
        <?php if (isset($error)): ?>
            <p class="text-red-500"><?= $error ?></p>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="mb-4">
                <label class="block text-gray-700">Nom :</label>
                <input type="text" name="nom" class="w-full px-4 py-2 border rounded">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Prénom :</label>
                <input type="text" name="prenom" class="w-full px-4 py-2 border rounded">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Téléphone :</label>
                <input type="text" name="telephone" class="w-full px-4 py-2 border rounded">
            </div>

            <button type="submit" class="bg-blue-400 text-white px-4 py-2 rounded">Ajouter</button>
        </form>
    </div>

    <div class="mt-5 text-center">
        <a href="<?= WEBROOT ?>controller=client&page=liste" class="bg-gray-500 text-white px-4 py-2 rounded">Retour</a>
    </div>
</body>
</html>
