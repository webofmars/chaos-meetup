<?php

namespace App\Repository;

use App\Entity\PollVotes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method PollVotes|null find($id, $lockMode = null, $lockVersion = null)
 * @method PollVotes|null findOneBy(array $criteria, array $orderBy = null)
 * @method PollVotes[]    findAll()
 * @method PollVotes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PollVotesRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, PollVotes::class);
    }

//    /**
//     * @return PollVotes[] Returns an array of PollVotes objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PollVotes
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
