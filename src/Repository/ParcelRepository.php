<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Parcel;
use App\Exception\ParcelNotFoundException;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Parcel>
 *
 * @method Parcel|null find($id, $lockMode = null, $lockVersion = null)
 * @method Parcel|null findOneBy(array $criteria, array $orderBy = null)
 * @method Parcel[]    findAll()
 * @method Parcel[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ParcelRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Parcel::class);
    }

    public function getParcelById(int $id): Parcel
    {
        $parcel = $this->find($id);

        if (null === $parcel) {
            throw new ParcelNotFoundException();
        }

        return $parcel;
    }

    /**
     * @return Parcel[]
     */
    public function findParcelsBySenderPhone(string $phone): array
    {
        return $this->createQueryBuilder('p')
            ->where('p.sender.phone = :phone')
            ->setParameter('phone', $phone)
            ->getQuery()
            ->getResult();
    }

    /**
     * @return Parcel[]
     */
    public function findParcelsByReceiverFullName(string $fullName): array
    {
        $fullNameWithSpace = preg_replace('/([a-z])([A-Z])/', '$1 $2', $fullName);

        [$firstName, $lastName] = explode(' ', $fullNameWithSpace);

        return $this->createQueryBuilder('p')
            ->where('p.recipient.fullName.firstName = :firstName')
            ->andWhere('p.recipient.fullName.lastName = :lastName')
            ->setParameters([
                'firstName' => $firstName,
                'lastName' => $lastName,
            ])
            ->getQuery()
            ->getResult();
    }

    public function saveAndFlush(Parcel $parcel): void
    {
        $this->getEntityManager()->persist($parcel);
        $this->getEntityManager()->flush();
    }

    public function removeAndFlush(Parcel $parcel): void
    {
        $this->getEntityManager()->remove($parcel);
        $this->getEntityManager()->flush();
    }
}
