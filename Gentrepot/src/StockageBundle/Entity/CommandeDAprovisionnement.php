<?php

namespace StockageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CommandeDAprovisionnement
 *
 * @ORM\Table(name="commande_d_aprovisionnement")
 * @ORM\Entity(repositoryClass="StockageBundle\Repository\CommandeDAprovisionnementRepository")
 */
class CommandeDAprovisionnement
{
    /**
     * @var int
     *
     * @ORM\Column(name="numeroC", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $numeroC;

    /**
     * @ORM\Column(type="float")
     */
    private $totalC;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateCreation", type="date")
     */
    private $dateCreation;

    /**
     * @ORM\Column(type="string")
     */
    private $etat;

    /**
     * @ORM\Column(type="float")
     */
    private $tauxRemise;


    /**
     * @return mixed
     */
    public function getTotalC()
    {
        return $this->totalC;
    }

    /**
     * @param mixed $totalC
     */
    public function setTotalC($totalC)
    {
        $this->totalC = $totalC;
    }



    /**
     * @return int
     */
    public function getNumeroC()
    {
        return $this->numeroC;
    }

    /**
     * @param int $numeroC
     */
    public function setNumeroC($numeroC)
    {
        $this->numeroC = $numeroC;
    }

    /**
     * @ORM\Column(type="float")
     */
    private $totalTVA;

    /**
     * Set dateCreation
     *
     * @param \DateTime $dateCreation
     *
     * @return CommandeDAprovisionnement
     */
    public function setDateCreation($dateCreation)
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    /**
     * Get dateCreation
     *
     * @return \DateTime
     */
    public function getDateCreation()
    {
        return $this->dateCreation;
    }

    /**
     * @return mixed
     */
    public function getTotalTVA()
    {
        return $this->totalTVA;
    }

    /**
     * @param mixed $totalTVA
     */
    public function setTotalTVA($totalTVA)
    {
        $this->totalTVA = $totalTVA;
    }

    /**
     * @return mixed
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * @param mixed $etat
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;
    }

    /**
     * @return mixed
     */
    public function getTauxRemise()
    {
        return $this->tauxRemise;
    }

    /**
     * @param mixed $tauxRemise
     */
    public function setTauxRemise($tauxRemise)
    {
        $this->tauxRemise = $tauxRemise;
    }

    public function __toString()
    {
        return(String) $this->numeroC;
    }


}

