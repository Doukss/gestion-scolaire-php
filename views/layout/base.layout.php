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

<main>
    <?=$content?>;
</main>

</body>
</html>