<?php

namespace TresorerieBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LettreDeRelance
 *
 * @ORM\Table(name="lettre_de_relance")
 * @ORM\Entity(repositoryClass="TresorerieBundle\Repository\LettreDeRelanceRepository")
 */
class LettreDeRelance
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


    /**
     * @ORM\Column(type="date")
     */
    private $dateCreation;

    /**
     * @return mixed
     */
    public function getDateCreation()
    {
        return $this->dateCreation;
    }

    /**
     * @param mixed $dateCreation
     */
    public function setDateCreation($dateCreation)
    {
        $this->dateCreation = $dateCreation;
    }



    /**
     *
     * @ORM\ManyToOne(targetEntity="VenteBundle\Entity\FactureVente")
     * @ORM\JoinColumn(name="idF_factureVente",referencedColumnName="id")
     */
    private $factureVente;

    /**
     * @return mixed
     */
    public function getFactureVente()
    {
        return $this->factureVente;
    }

    /**
     * @param mixed $factureVente
     */
    public function setFactureVente($factureVente)
    {
        $this->factureVente = $factureVente;
    }





    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
}

