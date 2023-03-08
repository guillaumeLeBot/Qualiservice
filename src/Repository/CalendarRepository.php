<?php

namespace App\Repository;

use DateTimeInterface;
use App\Entity\Building;
use App\Entity\Calendar;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<Calendar>
 *
 * @method Calendar|null find($id, $lockMode = null, $lockVersion = null)
 * @method Calendar|null findOneBy(array $criteria, array $orderBy = null)
 * @method Calendar[]    findAll()
 * @method Calendar[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CalendarRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Calendar::class);
    }

    public function save(Calendar $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Calendar $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
    
    public function findOverlappingEvents(string $buildingName, \DateTime $startTime, \DateTime $endTime): array
    {
    $qb = $this->createQueryBuilder('c');
    $qb->join('c.building', 'b')
        ->andWhere('b.name = :buildingName')
        ->andWhere('c.start < :endTime')
        ->andWhere('c.end > :startTime')
        ->setParameter('buildingName', $buildingName)
        ->setParameter('startTime', $startTime)
        ->setParameter('endTime', $endTime);
    return $qb->getQuery()->getResult();
    }

    // public function findBuildingByOverlappingEvents(Building $building, \DateTime $startTime, \DateTime $endTime)
    
    // {
    //     $qb = $this->createQueryBuilder('c');
    //     $qb->select('c')
    //         ->join('c.building', 'b')
    //         ->where('b.name = :buildingName')
    //         ->andWhere('c.start < :endTime')
    //         ->andWhere('c.end > :startTime')
    //         ->setParameter('buildingName', (string)$building)
    //         ->setParameter('startTime', $startTime)
    //         ->setParameter('endTime', $endTime);

    //     $buildingsWithEvents = $qb->getQuery()->getResult();

    //     $qb = $this->getEntityManager()->createQueryBuilder();
    //     $qb->select('b.name')
    //         ->from(Building::class, 'b');

    //     if (!empty($buildingsWithEvents)) {
    //         $qb->where($qb->expr()->notIn('b', ':buildings'))
    //         ->setParameter('buildings', array_map(function ($event) {
    //             return $event->getBuilding();
    //         }, $buildingsWithEvents));
    //     }

    //     $buildingNames = array_map(function ($building) {
    //         return $building['name'];
    //     }, $qb->getQuery()->getResult());

    //     return $buildingNames;
    // }

    public function findByDateRange(DateTimeInterface $startDate, DateTimeInterface $endDate): array
    {
        $qb = $this->createQueryBuilder('c');
        
        $qb->andWhere($qb->expr()->between('c.start', ':start', ':end'))
        ->setParameter('start', $startDate->format('Y-m-d'))
        ->setParameter('end', $endDate->format('Y-m-d'));
        
        return $qb->getQuery()->getResult();
    }

    public function findLorealEventsByDate(\DateTimeInterface $startDate, \DateTimeInterface $endDate): array
    {
        $qb = $this->createQueryBuilder('e');

        $qb->leftJoin('e.customer', 'c')
            ->where('c.name = :customerName')
            ->andWhere('e.start >= :start')
            ->andWhere('e.end <= :end')
            ->setParameter('customerName', 'LOREAL')
            ->setParameter('start', $startDate)
            ->setParameter('end', $endDate)
            ->orderBy('e.start', 'ASC');

        return $qb->getQuery()->getResult();
    }
//    /**
//     * @return Calendar[] Returns an array of Calendar objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Calendar
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
