<?php declare(strict_types=1);

namespace Stormannsgal\App\Hydrator;

use DateTimeImmutable;
use Exception;
use Stormannsgal\App\Entity\AccountAccessAuth;
use Stormannsgal\App\Entity\AccountAccessAuthCollection;
use Stormannsgal\Core\Entity\AccountAccessAuthCollectionInterface;
use Stormannsgal\Core\Entity\AccountAccessAuthInterface;

readonly class AccountAccessAuthHydrator implements AccountAccessAuthHydratorInterface
{
    /**
     * @throws Exception
     */
    public function hydrate(array $data): AccountAccessAuthInterface
    {
        return new AccountAccessAuth(
            $data['id'],
            $data['userId'],
            $data['label'],
            $data['refreshToken'],
            $data['userAgent'],
            $data['clientIdentHash'],
            new DateTimeImmutable($data['createdAt']),
        );
    }

    /**
     * @throws Exception
     */
    public function hydrateCollection(array $data): AccountAccessAuthCollection
    {
        $collection = new AccountAccessAuthCollection();

        foreach ($data as $entity) {
            $collection[] = $this->hydrate($entity);
        }

        return $collection;
    }

    public function extract(AccountAccessAuthInterface $object): array
    {
        return [
            'id' => $object->getId(),
            'userId' => $object->getUserId(),
            'label' => $object->getLabel(),
            'refreshToken' => $object->getRefreshToken(),
            'userAgent' => $object->getUserAgent(),
            'clientIdentHash' => $object->getClientIdentHash(),
            'createdAt' => $object->getCreatedAt()->format('Y-m-d H:i:s'),
        ];
    }

    public function extractCollection(AccountAccessAuthCollectionInterface $collection): array
    {
        $data = [];

        foreach ($collection as $entity) {
            $data[] = $this->extract($entity);
        }

        return $data;
    }
}
