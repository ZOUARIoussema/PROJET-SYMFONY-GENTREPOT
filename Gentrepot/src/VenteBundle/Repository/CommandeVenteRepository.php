<?php

namespace VenteBundle\Repository;

/**
 * CommandeVenteRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CommandeVenteRepository extends \Doctrine\ORM\EntityRepository
{
    public function findByTotal()
    {


        $qb=$this->getEntityManager()
            ->createQuery("SELECT sum (c.totalC)
                            FROM VenteBundle:CommandeVente c
                            ");

        return $qb->getSingleScalarResult();
    }

     public function findByMax(){

         $qb=$this->getEntityManager()
             ->createQuery("SELECT max (c.id)
                            FROM VenteBundle:CommandeVente c
                            ");

         return $qb->getScalarResult();
     }
    public function findCommande()
    {


        $qb=$this->getEntityManager()
            ->createQuery("SELECT (c.totalC) ,(c.etat)
                            FROM VenteBundle:CommandeVente c
                            ");

        return $qb->getScalarResult();
    }

}
