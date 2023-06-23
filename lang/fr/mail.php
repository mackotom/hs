<?php

return [

    'hello' => "Bonjour",
    'thanks' => "Merci",

    'requestHours' => [

        'subject' => "[0,1] Récapitulatif heure supplémentaire |[2,*] Récapitulatif heures supplémentaires",

        'info' => "{0} Aucune heure supplémentaire.|{1} J'ai travaillé **:numberHours** heure supplémentaire ce mois-ci|[2,*] Voici le récapitulatif de mes heures supplémentaires, en tout **:numberHours** heures ce mois-ci",

        'table' => [
            'headers' => [
                'reason' => "Raison",
                'number' => "Nombre d'heures",
                'date' => "Date",
            ],
        ]
    ]

];
