<?php declare(strict_types=1);

namespace Stormannsgal\App\DTO;

readonly class ClientIdentification
{
    public function __construct(
        public ClientIdentificationData $clientIdentificationData,
        public string $identificationHash
    ) {
    }

    public static function create(ClientIdentificationData $clientIdentificationData, string $identificationHash): self
    {
        return new self($clientIdentificationData, $identificationHash);
    }
}
