<?php

return [
    'adminEmail' => 'admin@example.com',
    'EuroSourcesList' => [
        [
            'url' => 'http://www.ecb.europa.eu/stats/eurofxref/eurofxref-daily.xml',
            'strategy' => 'EuroBank',
        ],
        [
            'url' => 'https://www.cbr-xml-daily.ru/daily_json.js',
            'strategy' => 'RussianBank',
        ],
    ],
];
