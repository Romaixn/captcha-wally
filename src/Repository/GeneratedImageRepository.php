<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\GeneratedImage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<GeneratedImage>
 *
 * @method GeneratedImage|null find($id, $lockMode = null, $lockVersion = null)
 * @method GeneratedImage|null findOneBy(array $criteria, array $orderBy = null)
 *
 * @psalm-method list<GeneratedImage> findAll()
 *
 * @method GeneratedImage[] findAll()
 *
 * @psalm-method list<GeneratedImage> findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 *
 * @method GeneratedImage[] findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GeneratedImageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GeneratedImage::class);
    }

    public function save(GeneratedImage $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(GeneratedImage $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return GeneratedImage[] Returns an array of GeneratedImage objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('g')
//            ->andWhere('g.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('g.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?GeneratedImage
//    {
//        return $this->createQueryBuilder('g')
//            ->andWhere('g.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
