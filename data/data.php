<?php
$clients = [
    [
        'id' => 1,
        'nom' => 'khady',
        'prenom' => 'Camara',
        'telephone' => '77',
        'commande' => [
            [
                'id' => 1, 
                'date' => '10-05-2025', 
                'montant' => 50, 
                'statut' => 'Payé',
                'produits' => [
                    ['id' =>1, 'article' => 'Lait', 'prix' => 25, 'quantite' => 2],
                    ['id' =>2, 'article' => 'Pain', 'prix' => 5, 'quantite' => 2],
                ],
            ],
            [
                'id' => 2, 
                'date' => '17-05-2025', 
                'montant' => 20, 
                'statut' => 'Impayé',
                'produits' => [
                    ['id' => 103, 'article' => 'Riz', 'prix' => 10, 'quantite' => 2],
                ],
            ],
        ],
    ],
    [
        'id' => 2,
        'nom' => 'Fall',
        'prenom' => 'Marie',
        'telephone' => '787654321',
        'commande' => [
            [
                'id' => 3, 
                'date' => '2025-01-12', 
                'montant' => 90, 
                'statut' => 'Payé',
                'produits' => [
                    ['id' => 104, 'article' => 'Huile', 'prix' => 30, 'quantite' => 3],
                ],
            ],
        ],
    ],
    [
        'id' => 3,
        'nom' => 'Diop',
        'prenom' => 'Fall',
        'telephone' => '766789079',
        'commande' => [],
    ],
];
?>
