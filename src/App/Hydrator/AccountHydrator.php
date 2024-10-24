<?php declare(strict_types=1);

namespace Stormannsgal\App\Hydrator;

use DateTimeImmutable;
use Exception;
use Ramsey\Uuid\Uuid;
use Stormannsgal\App\Entity\Account;
use Stormannsgal\App\Entity\AccountCollection;
use Stormannsgal\Core\Entity\AccountCollectionInterface;
use Stormannsgal\Core\Entity\AccountInterface;
use Stormannsgal\Core\Type\Email;

readonly class AccountHydrator implements AccountHydratorInterface
{
    /**
     * @throws Exception
     */
    public function hydrate(array $data): AccountInterface
    {
        return new Account(
            $data['id'],
            Uuid::fromString($data['uuid']),
            $data['name'],
            $data['password'],
            new Email($data['email']),
            new DateTimeImmutable($data['registeredAt']),
            new DateTimeImmutable($data['lastActionAt']),
        );
    }

    /**
     * @throws Exception
     */
    public function hydrateCollection(array $data): AccountCollectionInterface
    {
        $collection = new AccountCollection();

        foreach ($data as $entity) {
            $collection[] = $this->hydrate($entity);
        }

        return $collection;
    }

    public function extract(AccountInterface $object): array
    {
        return [
            'id' => $object->getId(),
            'uuid' => $object->getUuid()->getHex()->toString(),
            'name' => $object->getName(),
            'password' => $object->getPasswordHash(),
            'email' => $object->getEMail()->toString(),
            'registeredAt' => $object->getRegisteredAt()->format('Y-m-d H:i:s'),
            'lastActionAt' => $object->getLastActionAt()->format('Y-m-d H:i:s'),
        ];
    }

    public function extractCollection(AccountCollectionInterface $collection): array
    {
        $data = [];

        foreach ($collection as $entity) {
            $data[] = $this->extract($entity);
        }

        return $data;
    }
}
