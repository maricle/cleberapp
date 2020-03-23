<?php

namespace App\Repository;

use App\Entity\Orden;
use App\Entity\Comprobante;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Orden|null find($id, $lockMode = null, $lockVersion = null)
 * @method Orden|null findOneBy(array $criteria, array $orderBy = null)
 * @method Orden[]    findAll()
 * @method Orden[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrdenRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Orden::class);
    }

    // /**
    //  * @return Orden[] Returns an array of Orden objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Orden
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    
     /**
      * @return factura Returns an Factura  object
      */
       public function GenerarFactura(Orden $orden): ?Comprobante
    {
           
           $factura= new Comprobante();
           $factura->setPersona($orden->getPersona());
           $factura->setFecha(date('Y-m-d'));
           $factura->setCompra(false);
           
        
    }
}