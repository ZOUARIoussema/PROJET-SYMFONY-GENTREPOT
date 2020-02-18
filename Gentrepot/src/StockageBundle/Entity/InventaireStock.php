<?php

namespace StockageBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * InventaireStock
 *
 * @ORM\Table(name="inventaire_stock")
 * @ORM\Entity(repositoryClass="StockageBundle\Repository\InventaireStockRepository")
 */
class InventaireStock
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
     * @ORM\ManyToOne(targetEntity="AchatBundle\Entity\ProduitAchat")
     * @ORM\JoinColumn(name="ref_produit",referencedColumnName="reference")
     *
     */
    private $produit;

    /**
     * @return mixed
     */
    public function getProduit()
    {
        return $this->produit;
    }

    /**
     * @param mixed $produit
     */
    public function setProduit($produit)
    {
        $this->produit = $produit;
    }

    /**
     * @return mixed
     */
    public function getEmplacement()
    {
        return $this->emplacement;
    }

    /**
     * @param mixed $emplacement
     */
    public function setEmplacement($emplacement)
    {
        $this->emplacement = $emplacement;
    }



    /**
     * @ORM\ManyToOne(targetEntity="Emplacement")
     * @ORM\JoinColumn(name="id_emplacement",referencedColumnName="id")
     *
     */

    private $emplacement;


    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateCreation", type="date")
     */
    private $dateCreation;

    /**
     * @var int
     *
     * @ORM\Column(name="quantiteInventaire", type="integer")
     */
    private $quantiteInventaire;

    /**
     * @var int
     *
     * @ORM\Column(name="ecart", type="integer")
     */
    private $ecart;

    /**
     * @var int
     *
     * @ORM\Column(name="quantiteTheorique", type="integer")
     */
    private $quantiteTheorique;


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
     * Set dateCreation
     *
     * @param \DateTime $dateCreation
     *
     * @return InventaireStock
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
     * Set quantiteInventaire
     *
     * @param integer $quantiteInventaire
     *
     * @return InventaireStock
     */
    public function setQuantiteInventaire($quantiteInventaire)
    {
        $this->quantiteInventaire = $quantiteInventaire;

        return $this;
    }

    /**
     * Get quantiteInventaire
     *
     * @return int
     */
    public function getQuantiteInventaire()
    {
        return $this->quantiteInventaire;
    }

    /**
     * Set ecart
     *
     * @param integer $ecart
     *
     * @return InventaireStock
     */
    public function setEcart($ecart)
    {
        $this->ecart = $ecart;

        return $this;
    }

    /**
     * Get ecart
     *
     * @return int
     */
    public function getEcart()
    {
        return $this->ecart;
    }

    /**
     * Set quantiteTheorique
     *
     * @param integer $quantiteTheorique
     *
     * @return InventaireStock
     */
    public function setQuantiteTheorique($quantiteTheorique)
    {
        $this->quantiteTheorique = $quantiteTheorique;

        return $this;
    }

    /**
     * Get quantiteTheorique
     *
     * @return int
     */
    public function getQuantiteTheorique()
    {
        return $this->quantiteTheorique;
    }
}

