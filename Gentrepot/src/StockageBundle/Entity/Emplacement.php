<?php

namespace StockageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Emplacement
 *
 * @ORM\Table(name="emplacement")
 * @ORM\Entity(repositoryClass="StockageBundle\Repository\EmplacementRepository")
 */
class Emplacement
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
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=255)
     */
    private $adresse;

    /**
     * @var int
     *
     * @ORM\Column(name="capaciteStockage", type="integer")
     */
    private $capaciteStockage;

    /**
     * @var int
     *
     * @ORM\Column(name="quantiteStocker", type="integer")
     */
    private $quantiteStocker;

    /**
     * @var string
     *
     * @ORM\Column(name="classe", type="string", length=255)
     */
    private $classe;


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
     * Set adresse
     *
     * @param string $adresse
     *
     * @return Emplacement
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set capaciteStockage
     *
     * @param integer $capaciteStockage
     *
     * @return Emplacement
     */
    public function setCapaciteStockage($capaciteStockage)
    {
        $this->capaciteStockage = $capaciteStockage;

        return $this;
    }

    /**
     * Get capaciteStockage
     *
     * @return int
     */
    public function getCapaciteStockage()
    {
        return $this->capaciteStockage;
    }

    /**
     * Set quantiteStocker
     *
     * @param integer $quantiteStocker
     *
     * @return Emplacement
     */
    public function setQuantiteStocker($quantiteStocker)
    {
        $this->quantiteStocker = $quantiteStocker;

        return $this;
    }

    /**
     * Get quantiteStocker
     *
     * @return int
     */
    public function getQuantiteStocker()
    {
        return $this->quantiteStocker;
    }

    /**
     * Set classe
     *
     * @param string $classe
     *
     * @return Emplacement
     */
    public function setClasse($classe)
    {
        $this->classe = $classe;

        return $this;
    }

    /**
     * Get classe
     *
     * @return string
     */
    public function getClasse()
    {
        return $this->classe;
    }

    /**
     *
     * @ORM\OneToOne(targetEntity="Entrepot")
     * @ORM\JoinColumn(name="matriculeFiscal_Entrepot",referencedColumnName="matriculeFiscal")
     */
    private $entrepot;

    /**
     * @return mixed
     */
    public function getEntrepot()
    {
        return $this->entrepot;
    }

    /**
     * @param mixed $entrepot
     */
    public function setEntrepot($entrepot)
    {
        $this->entrepot = $entrepot;
    }









    
}

