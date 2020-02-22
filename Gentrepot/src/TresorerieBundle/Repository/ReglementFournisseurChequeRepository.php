<?php

namespace TresorerieBundle\Repository;

/**
 * ReglementFournisseurChequeRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ReglementFournisseurChequeRepository extends \Doctrine\ORM\EntityRepository
{


    public  function calculerTotal(){


        $qb=$this->getEntityManager()
            ->createQuery("SELECT sum (r.montant) 
                            FROM TresorerieBundle:ReglementFournisseurCheque r
                            ");

        return $qb->getSingleScalarResult();


    }
}
