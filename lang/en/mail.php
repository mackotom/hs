<?php

return [

    'hello' => "Hi",
    'thanks' => "Thanks",

    'requestHours' => [

        'subject' => '[0,1] Hour overtime summary|[2,*] Hours overtime summary',

        'info' => '{0} None hour overtime|{1} I worked **:numberHours** hour overtime this month|[2,*] I worked **:numberHours** hours overtime this month',

        'table' => [
            'headers' => [
                'reason' => "Reason",
                'number' => "Number of hours",
                'date' => "Date",
            ],
        ]
    ]

];