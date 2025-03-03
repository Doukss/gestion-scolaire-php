

 <main>
 <div class="bg-gray-400 text-center text-white">
        <h1 class="text-xl font-bold">LISTE DES COMMANDES</h1>
    </div>

    <div class="mt-20 ml-10 bg-blue-400 w-10  text-center rounded text-white">
        <a href="<?=WEBROOT?>page=liste" ><i class="ri-delete-back-2-fill"></i></a>
    </div>

    <div class="ml-[92%] mb-5 bg-blue-400 rounded w-20 h-6 rounded text-center text-white">
    <a href="<?= WEBROOT ?>controller=commande&page=ajout">Nouveau</a>
    </div>
    
    <div class="bg-white shadow p-10 rounded mt-5 w-[90%] mx-auto">
        <table class="w-full border-collapse">
            <thead class="text-white bg-blue-400">
                <tr>
                    <th class="px-4 py-2 border">ID COMMANDE</th>
                    <th class="px-4 py-2 border">CLIENT</th>
                    <th class="px-4 py-2 border">DATE</th>
                    <th class="px-4 py-2 border">MONTANT</th>
                    <th class="px-4 py-2 border">STATUT</th>
                    <th class="px-4 py-2 border">ACTION</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($commandes)): ?>
                    <?php foreach ($commandes as $commande): ?>
                        <tr class="hover:bg-gray-100">
                            <td class="px-4 py-2 border"><?= htmlspecialchars($commande['id']) ?></td>
                            <td class="px-4 py-2 border"><?= htmlspecialchars($commande['client_nom']) ?> <?= htmlspecialchars($commande['client_prenom']) ?></td>
                            <td class="px-4 py-2 border"><?= htmlspecialchars($commande['date']) ?></td>
                            <td class="px-4 py-2 border"><?= htmlspecialchars($commande['montant']) ?> FCFA</td>
                            <td class="px-4 py-2 border"><?= htmlspecialchars($commande['statut']) ?></td>
                            <td class="px-4 py-2 border">
                                <a href="<?= WEBROOT ?>controller=commande&page=detail_commande&client_id=<?= $commande['client_id'] ?>&commande_id=<?= $commande['id'] ?>" 
                                   class="bg-gray-300 text-black px-4 py-1 rounded">
                                    Détails
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="px-4 py-2 text-center border">Aucune commande trouvée.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>


 </main>