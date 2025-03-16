<?php

namespace App\Repository;

use App\Entity\AgentVisite;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<AgentVisite>
 *
 * @method AgentVisite|null find($id, $lockMode = null, $lockVersion = null)
 * @method AgentVisite|null findOneBy(array $criteria, array $orderBy = null)
 * @method AgentVisite[]    findAll()
 * @method AgentVisite[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AgentVisiteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AgentVisite::class);
    }

    public function save(AgentVisite $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(AgentVisite $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return AgentVisite[] Returns an array of AgentVisite objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

 
}
