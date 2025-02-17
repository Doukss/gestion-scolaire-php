<?php require_once '../layout/healpers.php'; ?>

    <main>
    <div class="bg-gray-400 text-center text-white">
    <h1 class="text-xl font-bold">LES COMMANDES DU CLIENT</h1>
    </div>
    <div class="mt-20 ml-10 bg-blue-400 w-10  text-center rounded text-white">
        <a href="<?=WEBROOT?>page=liste" ><i class="ri-delete-back-2-fill"></i></a>
    </div>

    <div class="bg-white shadow p-10 rounded mt-5 w-[90%] mx-auto">
        <table class="w-full border-collapse">
            <thead class="text-white bg-blue-400">
                <tr>
                    <th class="px-4 py-2 border">ID COMMANDE</th>
                    <th class="px-4 py-2 border">DATE</th>
                    <th class="px-4 py-2 border">MONTANT</th>
                    <th class="px-4 py-2 border">STATUT</th>
                    <th class="px-4 py-2 border">ACTION</th>
                </tr>
            </thead>
            <tbody>
                <?php  if (!empty($commandes)): ?>
                    <?php foreach ($commandes as $commande): ?>
                        <tr class="hover:bg-gray-100">
                            <td class="px-4 py-2 border"><?= htmlspecialchars($commande['id']) ?></td>
                            <td class="px-4 py-2 border"><?= htmlspecialchars($commande['date']) ?></td>
                            <td class="px-4 py-2 border"><?= htmlspecialchars($commande['montant']) ?> FCFA</td>
                            <td class="px-4 py-2 border"><?= htmlspecialchars($commande['statut']) ?></td>
                            <td class="px-4 py-2 border ">
                            <div class="w-20 bg-gray-300 text-center rounded">
                               <a href="<?= WEBROOT ?>controller=commande&page=detail_commande&client_id=<?= $clientId ?>&commande_id=<?= $commande['id'] ?>">
                                 Détails
                                </a>
                            </div>
                            </td>

                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="px-4 py-2 text-center border">Aucune commande trouvée.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    </main>





   


