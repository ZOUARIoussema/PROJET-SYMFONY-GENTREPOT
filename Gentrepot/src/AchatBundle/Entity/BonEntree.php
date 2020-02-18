<?php

namespace AchatBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BonEntree
 *
 * @ORM\Table(name="bon_entree")
 * @ORM\Entity(repositoryClass="AchatBundle\Repository\BonEntreeRepository")
 */
class BonEntree
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
     *
     * @ORM\OneToOne(targetEntity="StockageBundle\Entity\CommandeDAprovisionnement")
     * @ORM\JoinColumn(name="numeroC_commandeAp",referencedColumnName="numeroC")
     */
    private $numeroC_commandeAp;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date")
     */
    private $date;

    /**
     * @return mixed
     */
    public function getNumeroCCommandeAp()
    {
        return $this->numeroC_commandeAp;
    }

    /**
     * @param mixed $numeroC_commandeAp
     */
    public function setNumeroCCommandeAp($numeroC_commandeAp)
    {
        $this->numeroC_commandeAp = $numeroC_commandeAp;
    }

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateProduction", type="date")
     */
    private $dateProduction;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateExpiration", type="date")
     */
    private $dateExpiration;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return BonEntree
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set dateProduction
     *
     * @param \DateTime $dateProduction
     *
     * @return BonEntree
     */
    public function setDateProduction($dateProduction)
    {
        $this->dateProduction = $dateProduction;

        return $this;
    }

    /**
     * Get dateProduction
     *
     * @return \DateTime
     */
    public function getDateProduction()
    {
        return $this->dateProduction;
    }

    /**
     * Set dateExpiration
     *
     * @param \DateTime $dateExpiration
     *
     * @return BonEntree
     */
    public function setDateExpiration($dateExpiration)
    {
        $this->dateExpiration = $dateExpiration;

        return $this;
    }

    /**
     * Get dateExpiration
     *
     * @return \DateTime
     */
    public function getDateExpiration()
    {
        return $this->dateExpiration;
    }
}

