<?php

namespace VenteBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FactureVente
 *
 * @ORM\Table(name="facture_vente")
 * @ORM\Entity(repositoryClass="VenteBundle\Repository\FactureVenteRepository")
 */
class FactureVente
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
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }



    /**
     *
     * @ORM\OneToOne(targetEntity="BonLivraison")
     * @ORM\JoinColumn(name="numeroBL_BonLivraison",referencedColumnName="id")
     */
    private $BonLivraison;

    /**
     * @return mixed
     */
    public function getBonLivraison()
    {
        return $this->BonLivraison;
    }

    /**
     * @param mixed $BonLivraison
     */
    public function setBonLivraison($BonLivraison)
    {
        $this->BonLivraison = $BonLivraison;
    }
}

