<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Client</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <div class="mt-10 ml-10">
        <h1 class="text-xl font-bold">Ajouter un Nouveau Client</h1>
        <a href="index.php" class="text-blue-500 underline">Retour</a>
    </div>

    <form action="controller.php?action=add" method="POST" class="mt-5 ml-10 max-w-md bg-white shadow p-5 rounded">
        <div class="mb-4">
            <label for="nom" class="block font-bold mb-2">Nom</label>
            <input type="text" name="nom" id="nom" required class="w-full border px-4 py-2 rounded">
        </div>
        <div class="mb-4">
            <label for="prenom" class="block font-bold mb-2">Prénom</label>
            <input type="text" name="prenom" id="prenom" required class="w-full border px-4 py-2 rounded">
        </div>
        <div class="mb-4">
            <label for="telephone" class="block font-bold mb-2">Téléphone</label>
            <input type="text" name="telephone" id="telephone" required class="w-full border px-4 py-2 rounded">
        </div>
        <button type="submit" class="bg-blue-700 text-white px-4 py-2 rounded shadow">Ajouter</button>
    </form>
</body>
</html>
