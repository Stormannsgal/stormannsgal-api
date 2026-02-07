<?php declare(strict_types=1);

return [
    'project' => [
        'uri' => 'https:\\dev.stormannsgal.de',
        'senderEmail' => 'no-replay@stormannsgal.de',
    ],
    'api' => [
        'access' => [
            'domain' => [
                'whitelist' => [
                    'build.stormannsgal.de',
                    'dev.stormannsgal.de',
                    'stormannsgal.de',
                ],
            ],
        ],
    ],
];
