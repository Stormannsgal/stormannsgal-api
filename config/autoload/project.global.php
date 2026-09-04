<?php declare(strict_types=1);

use Core\Clock\Duration;

return [
    'project' => [
        'uri' => 'https:\\dev.stormannsgal.de',
        'senderEmail' => 'no-replay@stormannsgal.de',
        'version' => 'v0.1.0',
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
    'swagger_ui' => [
        'index_file' => __DIR__ . '/../../public/api/docs/index.html',
    ],
];
