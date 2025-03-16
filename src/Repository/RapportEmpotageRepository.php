<?php

namespace App\Repository;

use App\Entity\RapportEmpotage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<RapportEmpotage>
 *
 * @method RapportEmpotage|null find($id, $lockMode = null, $lockVersion = null)
 * @method RapportEmpotage|null findOneBy(array $criteria, array $orderBy = null)
 * @method RapportEmpotage[]    findAll()
 * @method RapportEmpotage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RapportEmpotageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RapportEmpotage::class);
    }

    public function save(RapportEmpotage $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(RapportEmpotage $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return RapportEmpotage[] Returns an array of RapportEmpotage objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('r.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

    public function findNbre()
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.contenu != :val')
            ->setParameter('val', '')
            ->getQuery()
            ->getResult();
    }
    public function findNbreNon()
    {
        return $this->createQueryBuilder('r')
            ->getQuery()
            ->getResult();
    }
    public function countByDate()
   {
        return $this->createQueryBuilder('r')
            ->select('SUBSTRING(r.date, 1,10) as nbrejour, COUNT(r) as count')
            ->andWhere('r.contenu != :val')
            ->groupby('nbrejour')
            ->setParameter('val', '')
            ->getquery()
            ->getResult();
   }
   
}
