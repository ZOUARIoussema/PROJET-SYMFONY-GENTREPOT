<?php

namespace TresorerieBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use StockageBundle\Entity\CommandeDAprovisionnement;

/**
 * FactureAchat
 *
 * @ORM\Table(name="facture_achat")
 * @ORM\Entity(repositoryClass="TresorerieBundle\Repository\FactureAchatRepository")
 */
class FactureAchat
{

    /**
     * @var int
     *
     * @ORM\Column(name="numeroF", type="integer")
     * @ORM\Id
     *
     */
    private $numeroF;

    /**
     * @ORM\Column(type="date")
     */
    private $dateCreation;
    /**
     * @ORM\Column(type="date")
     */
    private $dateEchaillancePaiement;
    /**
     * @ORM\Column(type="float")
     */
    private $totalTTC;
    /**
     * @ORM\Column(type="string")
     */
    private $etat;
    /**
     * @ORM\Column(type="float")
     */
    private $totalPaye;
    /**
     * @ORM\Column(type="float")
     */
    private $resteAPaye;


    /**
     * @ORM\Column(type="float")
     */
    private $timbreFiscale;
    /**
     * @ORM\Column(type="float")
     */
    private $fraisTransport;

    /**
     * @return int
     */
    public function getNumeroF()
    {
        return $this->numeroF;
    }

    /**
     * @param int $numeroF
     */
    public function setNumeroF($numeroF)
    {
        $this->numeroF = $numeroF;
    }

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
     * @return mixed
     */
    public function getDateEchaillancePaiement()
    {
        return $this->dateEchaillancePaiement;
    }

    /**
     * @param mixed $dateEchaillancePaiement
     */
    public function setDateEchaillancePaiement($dateEchaillancePaiement)
    {
        $this->dateEchaillancePaiement = $dateEchaillancePaiement;
    }

    /**
     * @return mixed
     */
    public function getTotalTTC()
    {
        return $this->totalTTC;
    }

    /**
     * @param mixed $totalTTC
     */
    public function setTotalTTC($totalTTC)
    {
        $this->totalTTC = $totalTTC;
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
    public function getTotalPaye()
    {
        return $this->totalPaye;
    }

    /**
     * @param mixed $totalPaye
     */
    public function setTotalPaye($totalPaye)
    {
        $this->totalPaye = $totalPaye;
    }

    /**
     * @return mixed
     */
    public function getResteAPaye()
    {
        return $this->resteAPaye;
    }

    /**
     * @param mixed $resteAPaye
     */
    public function setResteAPaye($resteAPaye)
    {
        $this->resteAPaye = $resteAPaye;
    }

    /**
     * @return mixed
     */
    public function getTimbreFiscale()
    {
        return $this->timbreFiscale;
    }

    /**
     * @param mixed $timbreFiscale
     */
    public function setTimbreFiscale($timbreFiscale)
    {
        $this->timbreFiscale = $timbreFiscale;
    }

    /**
     * @return mixed
     */
    public function getFraisTransport()
    {
        return $this->fraisTransport;
    }

    /**
     * @param mixed $fraisTransport
     */
    public function setFraisTransport($fraisTransport)
    {
        $this->fraisTransport = $fraisTransport;
    }

    /**
     *
     * @ORM\OneToOne(targetEntity="StockageBundle\Entity\CommandeDAprovisionnement")
     * @ORM\JoinColumn(name="numeroC_commandeAp",referencedColumnName="numeroC")
     */
    private $commandeAp;

    /**
     * @return mixed
     */
    public function getCommandeAp()
    {
        return $this->commandeAp;
    }

    /**
     * @param mixed $commandeAp
     */
    public function setCommandeAp($commandeAp)
    {
        $this->commandeAp = $commandeAp;
    }

    public function __toString()
    {
        return (String)$this->numeroF;
    }


}

