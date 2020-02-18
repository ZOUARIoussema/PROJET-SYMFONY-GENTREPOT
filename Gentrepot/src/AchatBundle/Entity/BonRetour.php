<?php

namespace AchatBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BonRetour
 *
 * @ORM\Table(name="bon_retour")
 * @ORM\Entity(repositoryClass="AchatBundle\Repository\BonRetourRepository")
 */
class BonRetour
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
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date")
     */
    private $date;

    /**
     *
     * @ORM\OneToOne(targetEntity="StockageBundle\Entity\CommandeDAprovisionnement")
     * @ORM\JoinColumn(name="numeroC_commandeAp",referencedColumnName="numeroC")
     */
    private $numeroC_commandeAp;

    /**
     * @var string
     *
     * @ORM\Column(name="motifDeRetour", type="string", length=255)
     */
    private $motifDeRetour;

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
     * @return BonRetour
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
     * Set motifDeRetour
     *
     * @param string $motifDeRetour
     *
     * @return BonRetour
     */
    public function setMotifDeRetour($motifDeRetour)
    {
        $this->motifDeRetour = $motifDeRetour;

        return $this;
    }

    /**
     * Get motifDeRetour
     *
     * @return string
     */
    public function getMotifDeRetour()
    {
        return $this->motifDeRetour;
    }
}

